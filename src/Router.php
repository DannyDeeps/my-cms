<?php declare(strict_types=1);

namespace MyCms;

use \League\Plates\Engine;

final class Router {
  private array $uriParts;

  public function __construct(
    private Engine $viewEngine,
    private string $uri
  ) {
    $this->uriParts = explode('/', $this->uri);
  }

  public function route(): void {
    # code...
  }
}
