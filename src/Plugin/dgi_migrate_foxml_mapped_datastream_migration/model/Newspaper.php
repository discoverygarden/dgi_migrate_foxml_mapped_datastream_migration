<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;

/**
 * Newspaper content model.
 */
#[Model(
  id: 'newspaper',
  uri: 'info:fedora/islandora:newspaperCModel',
)]
class Newspaper extends AbstractThumbnailedModel {

}
