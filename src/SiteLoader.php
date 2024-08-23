<?php declare(strict_types=1);

namespace MyCms;

final class SiteLoader {
  private $loaded = false;

  public function __construct(
    private Database $db
  ) {}

  

  public function loadFromHost(string $hostName): void {
    $siteEntry = $this->getSiteEntryByHostName($hostName);
    die('<pre>' . print_r($siteEntry, true) . '</pre>');
  }

  private function getSiteEntryByHostName(string $hostName): array {
    return $this->db->query('SELECT * FROM sites');
  }
}