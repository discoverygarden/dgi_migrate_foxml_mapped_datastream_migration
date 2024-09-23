<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;

/**
 * Page (of book) content model.
 */
#[Model(
  id: 'page',
  uri: 'info:fedora/islandora:pageCModel',
)]
class Page extends LargeImage {

  /**
   * {@inheritDoc}
   */
  protected function doGetMapping(): array {
    return array_merge_recursive(
      parent::doGetMapping(),
      [
        'OCR' => [
          'media_type' => 'extracted_text',
          'media_use' => 'http://pcdm.org/use#ExtractedText',
        ],
        'HOCR' => [
          'media_type' => 'file',
          'media_use' => 'https://discoverygarden.ca/use#hocr',
        ],
      ],
    );
  }

}
