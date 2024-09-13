<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

/**
 * Citation content model.
 */
#[Model(
  id: 'citation',
  uri: 'info:fedora/ir:citationCModel',
)]
class Citation extends AbstractBaseModel {

  /**
   * {@inheritDoc}
   */
  protected function doGetMapping(): array {
    return [
      'PDF' => [
        'media_type' => 'document',
        'media_use' => 'http://pcdm.org/use#OriginalFile',
      ],
    ];
  }

}
