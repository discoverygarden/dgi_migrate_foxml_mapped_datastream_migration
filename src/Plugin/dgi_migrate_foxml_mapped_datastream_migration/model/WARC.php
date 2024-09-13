<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\traits\FitsTrait;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\traits\ThumbnailTrait;

/**
 * Web archive content model.
 */
#[Model(
  id: 'warc',
  uri: 'info:fedora/islandora:sp_web_archive',
)]
class WARC extends AbstractBaseModel {
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
        'PDF' => [
          'media_type' => 'document',
          'media_use' => 'http://pcdm.org/use#ServiceFile',
        ],
        'OBJ' => [
          'media_type' => 'file',
          'media_use' => 'http://pcdm.org/use#OriginalFile',
        ],
      ],
    );
  }

}
