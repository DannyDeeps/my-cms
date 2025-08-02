<?php

declare(strict_types=1);

namespace MyCms\Models;

final class PageKit extends AbstractModel {
  protected static string $table = 'page_kits';

  public int $id;
  public int $siteId;
}