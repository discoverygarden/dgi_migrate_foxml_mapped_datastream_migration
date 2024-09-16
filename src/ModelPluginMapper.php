<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration;

/**
 * Model plugin mapper.
 */
class ModelPluginMapper implements CachedMapperInterface {

  /**
   * Memoized mapping of mappings.
   *
   * @var array
   */
  protected array $stash = [];

  /**
   * Constructor.
   */
  public function __construct(
    protected ModelPluginManagerInterface $modelPluginManager,
  ) {
  }

  /**
   * {@inheritDoc}
   */
  public function getInstance(array $options) {
    if (isset($options['id'])) {
      return $this->getById($options['id']);
    }

    if (isset($options['uri'])) {
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
    /** @var \Drupal\dgi_migrate_foxml_mapped_datastream_migration\ModelInterface $model */
    $model = $this->stash['id'][$id] ??= $this->modelPluginManager->createInstance($id);
    $this->stash['uri'][$model->getPluginDefinition()['uri']] = $model;
    return $model;
  }

  /**
   * Helper; map and memoize plugin instances.
   *
   * @param string $uri
   *   The model URI of which to fetch a model instance.
   *
   * @return \Drupal\dgi_migrate_foxml_mapped_datastream_migration\ModelInterface
   *   The built model object.
   */
  protected function getByUri(string $uri) : ModelInterface {
    if (!isset($this->stash['uri'][$uri])) {
      $models = array_filter($this->modelPluginManager->getDefinitions(), static function (array $def) use ($uri) {
        return $def['uri'] === $uri;
      });
      $model_id = $models ? array_keys($models)[0] : 'unknown_model';
      return $this->getById($model_id);
    }

    return $this->stash['uri'][$uri];
  }

  /**
   * {@inheritDoc}
   */
  public function clearCacheMappings(): void {
    $this->stash = [];
  }

}
