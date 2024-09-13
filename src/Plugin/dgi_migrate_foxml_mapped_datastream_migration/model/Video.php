<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\traits\FitsTrait;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\traits\ThumbnailTrait;

/**
 * Video content model.
 */
#[Model(
  id: 'video',
  uri: 'info:fedora/islandora:sp_videoCModel',
)]
class Video extends AbstractBaseModel {

  use FitsTrait {
    FitsTrait::doGetMapping as fitsDoGetMapping;
  }
  use ThumbnailTrait {
    ThumbnailTrait::doGetMapping as tnDoGetMapping;
  }

  /**
   * {@inheritDoc}
   */
  protected function doGetMapping(): array {
    return array_merge_recursive(
      $this->fitsDoGetMapping(),
      $this->tnDoGetMapping(),
      [
        'MP4' => [
          'media_type' => 'video',
          'media_use' => 'http://pcdm.org/use#ServiceFile',
        ],
        'OBJ' => [
          'media_type' => 'video',
          'media_use' => 'http://pcdm.org/use#OriginalFile',
        ],
      ],
    );
  }

}
