<?php

/**
 * @file
 * Hooks provided by the System module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Define additional parameters to the google maps API url.
 *
 * @return array
 *   Parameters
 */
function hook_geolocation_google_maps_parameters() {
  return [
    'libraries' => [
      'places',
    ],
  ];
}

/**
 * @} End of "addtogroup hooks".
 */
