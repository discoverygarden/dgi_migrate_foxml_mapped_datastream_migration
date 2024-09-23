<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;

/**
 * Fallback to represent unknown models.
 */
#[Model(
  id: 'unknown_model',
)]
class Unknown extends AbstractBaseModel {

  /**
   * {@inheritDoc}
   */
  protected function doGetMapping(): array {
    return [];
  }

}
