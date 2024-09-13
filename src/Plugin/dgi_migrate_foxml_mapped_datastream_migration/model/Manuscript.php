<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;

/**
 * Manuscript content model.
 */
#[Model(
  id: 'manuscript',
  uri: 'info:fedora/islandora:manuscriptCModel'
)]
class Manuscript extends Book {

  /**
   * {@inheritDoc}
   */
  public function doGetMapping(): array {
    return array_merge_recursive(
      parent::doGetMapping(),
      [
        'TEI' => [
          'media_type' => 'file',
          'media_use' => 'http://pcdm.org/use#OriginalFile',
        ],
      ],
    );
  }

}
