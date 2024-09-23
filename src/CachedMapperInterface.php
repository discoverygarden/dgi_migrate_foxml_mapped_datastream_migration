<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration;

use Drupal\Component\Plugin\Mapper\MapperInterface;

/**
 * Extended mapper interface to forward cache clears.
 */
interface CachedMapperInterface extends MapperInterface {

  /**
   * Clear cached mappings.
   */
  public function clearCacheMappings() : void;

}
