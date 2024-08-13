<?php declare(strict_types=1);

namespace MyCms;

use \League\Plates\Engine;

final class Router {
  public function __construct(private Engine $viewEngine) {}

  public function route(): void {
    # code...
  }
}
