<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration;

use Drupal\Component\Plugin\PluginManagerInterface;

/**
 * Model plugin manager service interface.
 */
interface ModelPluginManagerInterface extends PluginManagerInterface {

  /**
   * Get listing of all the registered/mappable datastream IDs.
   *
   * @return string[]
   *   The array of datastream IDs.
   */
  public function getDatastreamIds() : array;

  /**
   * Given a model URI, retrieve the datastream mappings.
   *
   * @param string $uri
   *   The datastream URI to lookup.
   *
   * @return array
   *   The mapping as an associative array, mapping datastream IDs to
   *   associative arrays containing:
   *   - media_use: The media use URI for this term; and,
   *   - media_type: The type of media to create (its "bundle").
   */
  public function getMappingByUri(string $uri) : array;

  /**
   * Given a model URI, retrieve the model mapping plugin.
   *
   * @param string $uri
   *   A model URI.
   *
   * @return \Drupal\dgi_migrate_foxml_mapped_datastream_migration\ModelInterface
   *   The model mapping definition.
   */
  public function getModelByUri(string $uri) : ModelInterface;

}
