<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;

/**
 * Manuscript page content model.
 */
#[Model(
  id: 'manuscript_page',
  uri: 'info:fedora/islandora:manuscriptPageCModel',
)]
class ManuscriptPage extends Page {

}
