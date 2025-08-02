<?php

declare(strict_types=1);

namespace MyCms\Models;

final class Site extends AbstractModel {
  protected static string $table = 'sites';

  public int $id;
  public string $name;
  public string $domain;

  protected static function addSelectFields(&$query): void {
    $query .= ', GROUP_CONCAT(sites.id) AS site_ids, GROUP_CONCAT(sites.name) AS site_names, GROUP_CONCAT(sites.domain) AS site_domains';
  }

  protected static function addJoin(&$query, string $foreignKey): void {
    $query .= ' LEFT JOIN sites ON sites.id = ' . $foreignKey;
  }

  protected static function parseFromRow(array $row): ?Site {
    
  }

  protected array $relations = [
    'page_kit' => PageKit::class
  ];
}
