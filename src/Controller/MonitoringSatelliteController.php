<?php

declare(strict_types=1);

namespace MarcoSimbuerger\MonitoringSatelliteBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Class MonitoringSatelliteController.
 *
 * @package MarcoSimbuerger\MonitoringSatelliteBundle\Controller
 */
class MonitoringSatelliteController {

  /**
   * Get the app data.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   The app data as JSON response.
   */
  public function get(): JsonResponse {
    return new JsonResponse([
      'app' => 'Symfony',
      'versions' => [
        'app' => Kernel::VERSION,
        'php' => phpversion(),
      ],
    ]);
  }

}
