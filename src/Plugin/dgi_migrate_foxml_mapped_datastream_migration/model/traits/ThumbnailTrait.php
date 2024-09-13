<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\traits;

/**
 * Common thumbnail mapping.
 */
trait ThumbnailTrait {

  /**
   * Get mapping for objects bearing thumbnails.
   *
   * @return array[]
   *   The mapping for thumbnails, as per ModelInterface::getMapping().
   */
  public function doGetMapping() : array {
    return [
      'TN' => [
        'media_type' => 'image',
        'media_use' => 'http://pcdm.org/use#ThumbnailImage',
      ],
    ];
  }

}
