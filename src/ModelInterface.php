<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Model interface definition.
 */
interface ModelInterface extends PluginInspectionInterface {

  /**
   * Get the mapping.
   *
   * @return array
   *   Get the mapping, as an associative array mapping datastream IDs to
   *   associative arrays containing:
   *   - media_use: The media use URI for this term; and,
   *   - media_type: The type of media to create (its "bundle").
   */
  public function getMapping() : array;

}
