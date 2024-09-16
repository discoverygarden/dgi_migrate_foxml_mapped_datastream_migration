<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;
use Drupal\migrate_plus\Plugin\migrate\process\EntityLookup;

/**
 * Caching entity lookup.
 *
 * This should only really be used for things that are few in number but
 * frequently referenced, such as "media use" terms.
 *
 * @MigrateProcessPlugin(
 *   id = "dgi_migrate_foxml_mapped_datastream_migration.process.cached_entity_lookup"
 * )
 */
class CachedEntityLookup extends EntityLookup {

  /**
   * The cache.
   *
   * @var array
   */
  protected array $cache = [];

  /**
   * {@inheritDoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    // If non-scalar, it can't be used as a key of an array, so let's avoid in
    // terms of attempting to cache.
    return is_scalar($value) ?
      ($this->cache[$value] ??= parent::transform($value, $migrate_executable, $row, $destination_property)) :
      parent::transform($value, $migrate_executable, $row, $destination_property);
  }

}
