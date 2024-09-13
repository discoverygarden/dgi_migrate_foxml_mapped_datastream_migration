<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\traits\FitsTrait;

/**
 * Basic image content model.
 */
#[Model(
  id: 'basic_image',
  uri: 'info:fedora/islandora:sp_basic_image'
)]
class BasicImage extends AbstractBaseModel {

  use FitsTrait {
    doGetMapping as fitsDoGetMapping;
  }

  /**
   * {@inheritDoc}
   */
  protected function doGetMapping(): array {
    return array_merge_recursive(
      $this->fitsDoGetMapping(),
      [
        'OBJ' => [
          'media_type' => 'image',
          'media_use' => 'http://pcdm.org/use#OriginalFile',
        ],
      ],
    );
  }

}
