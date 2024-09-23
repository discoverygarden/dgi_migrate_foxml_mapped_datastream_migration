<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;

/**
 * Binary object content model.
 */
#[Model(
  id: 'binary_object',
  uri: 'info:fedora/islandora:binaryObjectCModel',
)]
class BinaryObject extends AbstractThumbnailedModel {

  /**
   * {@inheritDoc}
   */
  public function doGetMapping(): array {
    return array_merge_recursive(
      parent::doGetMapping(),
      [
        'OBJ' => [
          'media_type' => 'file',
          'media_use' => 'http://pcdm.org/use#OriginalFile',
        ],
      ],
    );
  }

}
