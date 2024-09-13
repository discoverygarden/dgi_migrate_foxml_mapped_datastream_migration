<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;

/**
 * Large image content model.
 */
#[Model(
  id: 'large_image',
  uri: 'info:fedora/islandora:sp_large_image_cmodel',
)]
class LargeImage extends BasicImage {

  /**
   * {@inheritDoc}
   */
  protected function doGetMapping(): array {
    return array_merge_recursive(
      parent::doGetMapping(),
      [
        'JP2' => [
          'media_type' => 'image',
          'media_use' => 'http://pcdm.org/use#ServiceFile',
        ],
      ],
    );
  }

}
