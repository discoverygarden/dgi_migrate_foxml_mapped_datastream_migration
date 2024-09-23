<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\traits\FitsTrait;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\traits\ThumbnailTrait;

/**
 * Audio content model.
 */
#[Model(
  id: 'audio',
  uri: 'info:fedora/islandora:sp-audioCModel',
)]
class Audio extends AbstractBaseModel {

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
        'PROXY_MP3' => [
          'media_type' => 'audio',
          'media_use' => 'http://pcdm.org/use#ServiceFile',
        ],
        'OBJ' => [
          'media_type' => 'audio',
          'media_use' => 'http://pcdm.org/use#OriginalFile',
        ],
      ],
    );
  }

}
