<?php

declare(strict_types=1);

namespace MyCms\Database;

final class QueryBuilder {
  private string $type = 'select';
  private array $columns = ['*'];
  private array $joins = [];
  private array $where = [];
  private array $inserts = [];
  private array $bindings = [];
  private array $groupBy = [];
  private array $orderBy = [];
  private int $limit;
  private string $sql = '';

  public function __construct(private string $table) {}

  public function table(string $table): self {
    $this->table = $table;
    return $this;
  }

  public function select(array $columns): self {
    $this->columns = $columns;
    return $this;
  }

  public function insert(array $insert): self {
    $this->type = 'insert';
    $this->inserts[] = $insert;
    return $this;
  }

  public function update(array $bindings): self {
    $this->type = 'update';
    $this->bindings = $bindings;
    return $this;
  }

  public function delete(array $wheres): void {
    $this->type = 'delete';
    foreach ($wheres as [$col, $op, $val]) {
      $this->where[] = "$col $op ?";
      $this->bindings[] = $val;
    }
  }

  public function join(string $table, string $localKey, string $foreignKey, string $type = 'LEFT'): self {
    $this->joins[] = "$type JOIN $table ON $this->table.$localKey = $table.$foreignKey";
    return $this;
  }

  public function where(string $column, string $operator, mixed $value): self {
    $this->where[] = "$column $operator ?";
    $this->bindings[] = $value;
    return $this;
  }

  public function groupBy(array $columns): self {
    $this->groupBy = $columns;
    return $this;
  }

  public function orderBy(string $column, string $direction = 'ASC'): self {
    $this->orderBy[] = "$column $direction";
    return $this;
  }

  public function limit(int $limit): self {
    $this->limit = $limit;
    return $this;
  }

  protected function buildJoins(): string {
    return !empty($this->joins) ? ' ' . implode(' ', $this->joins) : '';
  }

  protected function buildWhere(): string {
    return !empty($this->where) ? ' WHERE ' . implode(' AND ', $this->where) : '';
  }

  protected function buildGroupBy(): string {
    return !empty($this->groupBy) ? ' GROUP BY ' . implode(', ', $this->groupBy) : '';
  }

  protected function buildOrderBy(): string {
    return !empty($this->orderBy) ? ' ORDER BY ' . implode(', ', $this->orderBy) : '';
  }

  protected function buildLimit(): string {
    return isset($this->limit) ? ' LIMIT ' . $this->limit : '';
  }

  public function buildSql(): string {
    $this->sql = match($this->type) {
      'insert' => $this->buildInsertQuery(),
      'select' => $this->buildSelectQuery(),
      'update' => $this->buildUpdateQuery(),
      'delete' => $this->buildDeleteQuery()
    };
    print_r($this->bindings) . PHP_EOL;
    return $this->sql;
  }

  private function buildInsertQuery(): string {
    $inserts = [];

    foreach ($this->bindings as $binding) {
      $cols = implode(', ', array_keys($this->bindings));
      $placeholders = implode(', ', array_fill(0, count($this->bindings), '?'));
      $this->bindings[] = array_values($this->bindings);
      return "INSERT INTO $this->table ($cols) VALUES ($placeholders)";
    }

  }

  private function buildSelectQuery(): string {
    return 
      'SELECT ' . implode(', ', $this->columns)
      . ' FROM ' . $this->table
      . $this->buildJoins()
      . $this->buildWhere()
      . $this->buildGroupBy()
      . $this->buildOrderBy()
      . $this->buildLimit();
  }

  private function buildUpdateQuery(): void {
    
  }

  private function buildDeleteQuery(): void {
    
  }
}
