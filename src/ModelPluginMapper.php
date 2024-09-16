<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration;

use Drupal\Component\Plugin\Mapper\MapperInterface;

/**
 * Model plugin mapper.
 */
class ModelPluginMapper implements MapperInterface {

  /**
   * Memoized mapping of mappings.
   *
   * @var array
   */
  protected array $stash;

  /**
   * Constructor.
   */
  public function __construct(
    protected ModelPluginManagerInterface $modelPluginManager,
  ) {}

  /**
   * {@inheritDoc}
   */
  public function getInstance(array $options) {
    if (isset($options['id'])) {
      return $this->getById($options['id']);
    }
    elseif (isset($options['uri'])) {
      return $this->getByUri($options['uri']);
    }
  }

  /**
   * Helper; map and memoize plugin instances.
   *
   * @param string $id
   *   The plugin ID to fetch.
   *
   * @return \Drupal\dgi_migrate_foxml_mapped_datastream_migration\ModelInterface
   *   The built model object.
   */
  protected function getById(string $id) : ModelInterface {
    return $this->stash['id'][$id] ??= $this->modelPluginManager->createInstance($id);
  }

}
