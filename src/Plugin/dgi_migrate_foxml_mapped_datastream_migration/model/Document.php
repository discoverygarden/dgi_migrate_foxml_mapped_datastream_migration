<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\traits\FitsTrait;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\traits\ThumbnailTrait;

/**
 * Document content model.
 */
#[Model(
  id: 'document',
  uri: 'info:fedora/islandora:sp_document',
)]
class Document extends AbstractBaseModel {

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
        'FULL_TEXT' => [
          'media_type' => 'file',
          'media_use' => 'https://lib.uconn.edu/find/connecticut-digital-archive:maintainedOcr',
        ],
        'PREVIEW' => [
          'media_type' => 'image',
          'media_use' => 'http://pcdm.org/use#ServiceFile',
        ],
        'OBJ' => [
          'media_type' => 'document',
          'media_use' => 'http://pcdm.org/use#OriginalFile',
        ],
      ],
    );
  }

}
