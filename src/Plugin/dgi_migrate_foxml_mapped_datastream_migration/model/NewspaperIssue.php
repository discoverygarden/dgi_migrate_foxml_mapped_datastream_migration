<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

/**
 * Newspaper issue content model.
 */
#[Model(
  id: 'newspaper_issue',
  uri: 'info:fedora/islandora:newspaperIssueCModel'
)]
class NewspaperIssue extends Book {

}
