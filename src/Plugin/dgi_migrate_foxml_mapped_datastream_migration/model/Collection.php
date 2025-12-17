<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;

/**
 * Collection content model.
 */
#[Model(
  id: 'collection',
  uri: 'info:fedora/islandora:collectionCModel',
)]
class Collection extends AbstractThumbnailedModel {

}
