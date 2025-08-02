<?php declare(strict_types=1);

namespace MyCms\Database;

final class Database {
  private static ?\PDO $pdo = null;

  public static function connect(): ?\PDO {
    if (self::$pdo === null) {
      $dsn = match(getenv('DB_TYPE')) {
        'sqlite' => 'sqlite:' . __DIR__ . '/../../db/mycms.db',
        'mysql' => 'mysql:host=localhost;dbname=mydatabase;charset=utf8',
        'pgsql' => 'pgsql:host=localhost;dbname=mydatabase'
      };

      self::$pdo = new \PDO($dsn);
    }

    return self::$pdo;
  }
}