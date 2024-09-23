<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\traits;

/**
 * Common FITS mapping.
 */
trait FitsTrait {

  /**
   * Get mapping for objects bearing FITS technical metadata.
   *
   * @return array[]
   *   The mapping for FITS, as per ModelInterface::getMapping().
   */
  public function doGetMapping() : array {
    return [
      'TECHMD' => [
        'media_type' => 'fits_technical_metadata',
        'media_use' => 'https://projects.iq.harvard.edu/fits',
      ],
    ];
  }

}
