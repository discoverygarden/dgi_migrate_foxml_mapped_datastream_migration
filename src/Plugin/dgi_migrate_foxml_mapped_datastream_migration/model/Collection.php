<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\src\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\AbstractThumbnailedModel;

/**
 * Collection content model.
 */
#[Model(
  id: 'collection',
  uri: 'info:fedora/islandora:collectionCModel',
)]
class Collection extends AbstractThumbnailedModel {

}
