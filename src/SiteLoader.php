<?php declare(strict_types=1);

namespace MyCms;

final class SiteLoader {
  private $loaded = false;

  public function load(string $hostName): void {
    // TODO: Create database query
    switch ($hostName) {
      case 'demositeone.com':
      case 'demositetwo.com':
      case 'demositethree.com':
      case 'panel.demositeone.com':
        $this->loaded = true;
        break;

      default:
        break;
    }
  }
}