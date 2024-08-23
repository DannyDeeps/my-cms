<?php declare(strict_types=1);

namespace MyCms;

final class Database {
  private $pdo;

  private function connect(): ?\PDO {
    if ($this->pdo === null) {
      try {
        $this->pdo = new \PDO('sqlite:../db/mycms.db');
      } catch (\PDOException $e) {
        // TODO: Log system error
        echo $e->getMessage();
        $this->pdo = null;
      }
    }

    return $this->pdo;
  }

  public function query(string $sql): array {
    $this->connect();
    $query = $this->pdo->query($sql);
    return $query->fetchAll();
  }
}