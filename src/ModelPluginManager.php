<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute\Model;

class ModelPluginManager extends DefaultPluginManager implements ModelPluginManagerInterface {

  protected array $datastreamIds;

  /**
   * Constructor.
   */
  public function __construct(
    \Traversable $namespaces,
    CacheBackendInterface $cache_backend,
    ModuleHandlerInterface $module_handler,
    protected string $mapperClass = ModelPluginMapper::class,
  ) {
    parent::__construct(
      'Plugin/dgi_migrate_foxml_mapped_datastream_migration/model',
      $namespaces,
      $module_handler,
      ModelInterface::class,
      Model::class,
    );

    $this->initMapper();
    $this->alterInfo('dgi_migrate_foxml_mapped_datastream_migration_model_plugin_info');
    $this->setCacheBackend($cache_backend, 'dgi_migrate_foxml_mapped_datastream_migration_model_plugin_info');
  }

  /**
   * {@inheritDoc}
   */
  public function getDatastreamIds(): array {
    if (!isset($this->datastreamIds)) {
      $ids = [];

      foreach ($this->getDefinitions() as $definition) {
        /** @var \Drupal\dgi_migrate_foxml_mapped_datastream_migration\ModelInterface $instance */
        $instance = $this->createInstance($definition['id']);
        $ids[] = array_keys($instance->getMapping());
      }

      $this->datastreamIds = array_unique(array_merge(...$ids));
    }

    return $this->datastreamIds;
  }

  /**
   * {@inheritDoc}
   */
  public function getMappingByUri(string $uri): array {
    return $this->getModelByUri($uri)->getMapping();
  }

  /**
   * {@inheritDoc}
   */
  public function getModelByUri(string $uri): ModelInterface {
    return $this->getInstance(['uri' => $uri]);
  }

  /**
   * {@inheritDoc}
   */
  public function clearCachedDefinitions() {
    parent::clearCachedDefinitions();
    unset($this->datastreamIds);
    $this->initMapper();
  }

  /**
   * (Re-)init our mapper.
   */
  protected function initMapper() : void {
    $this->mapper = new $this->mapperClass($this);
  }

  /**
   * {@inheritDoc}
   */
  protected function getFallbackPluginId($plugin_id, array $configuration = []) {
    return 'unknown_model';
  }

}
