<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;

/**
 * Newspaper page content model.
 */
#[Model(
  id: 'newspaper_page',
  uri: 'info:fedora/islandora:newspaperPageCModel',
)]
class NewspaperPage extends Page {

}
