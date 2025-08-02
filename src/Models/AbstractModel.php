<?php

declare(strict_types=1);

namespace MyCms\Models;

use MyCms\Database\{ Database, QueryBuilder };

abstract class AbstractModel {
  protected static string $table;
  protected array $with = [];

  public static function with(array $relations): self {
    $instance = new static;
    $instance->with = $relations;
    return $instance;
  }

  public static function find(int $id): ?self {
    $qb = (new QueryBuilder(static::$table));

    foreach (self::$with as $relation) {
      if (isset($this->relations[$relation])) {
        # code...
      }
    }

    $db = Database::connect();
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    $record = $stmt->fetch(\PDO::FETCH_ASSOC);

    return $record ? new static($record) : null;
  }

  abstract protected static function addSelectFields(&$query): void;
  abstract protected static function addJoin(&$query, string $foreignKey): void;
  abstract protected static function parseFromRow(array $row): ?self;
}
