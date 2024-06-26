<?

namespace MyCms;

use \League\Plates\Engine;

declare(strict_types=1);

final class Router {
  public function __construct(private Engine $viewEngine) {}

  public function route(): void {
    # code...
  }
}
