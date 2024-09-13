<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;

/**
 * Compound object content model.
 */
#[Model(
  id: 'compound',
  uri: 'info:fedora/islandora:compoundCModel',
)]
class Compound extends AbstractThumbnailedModel {

}
