<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;

/**
 * Book content model.
 */
#[Model(
  id: 'book',
  uri: 'info:fedora/islandora:bookCModel',
)]
class Book extends AbstractThumbnailedModel {

  /**
   * {@inheritDoc}
   */
  public function doGetMapping() : array {
    return array_merge_recursive(
      parent::doGetMapping(),
      [
        'PDF' => [
          'media_type' => 'document',
          'media_use' => 'http://pcdm.org/use#ServiceFile',
        ],
      ],
    );
  }

}
