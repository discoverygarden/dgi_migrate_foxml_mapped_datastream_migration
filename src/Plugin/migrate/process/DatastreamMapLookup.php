<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\migrate\process;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\dgi_migrate\Plugin\migrate\process\MissingBehaviorTrait;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\ModelPluginManagerInterface;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\Unknown;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Plugin\MigrationInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Lookup media migration info from a map.
 *
 * @MigrateProcessPlugin(
 *   id = "dgi_migrate_foxml_mapped_datastream_migration.process.datastream_map_lookup"
 * )
 */
class DatastreamMapLookup extends ProcessPluginBase implements ContainerFactoryPluginInterface {

  use MissingBehaviorTrait;

  /**
   * The model plugin manager service.
   *
   * @var \Drupal\dgi_migrate_foxml_mapped_datastream_migration\ModelPluginManagerInterface
   */
  protected ModelPluginManagerInterface $modelPluginManager;

  /**
   * {@inheritDoc}
   *
   * @throws \Drupal\migrate\MigrateException
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition, ?MigrationInterface $migration = NULL) {
    $instance = new static($configuration, $plugin_id, $plugin_definition);

    $instance->modelPluginManager = $container->get('plugin.manager.dgi_migrate_foxml_mapped_datastream_migration.model');

    $instance->missingBehaviorInit();

    return $instance;
  }

  /**
   * {@inheritDoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    // Given a two-tuple comprised of:
    // - the model(s?)
    // - a datastream to be mapped
    // fetch a media use and type to be applied; skipping the row if none.
    [$model_uris, $datastream_id] = $value;
    foreach ((array) $model_uris as $model_uri) {
      $model = $this->modelPluginManager->getModelByUri($model_uri);
      if ($model instanceof Unknown) {
        continue;
      }
      $mapping = $model->getMapping();
      if (!isset($mapping[$datastream_id])) {
        continue;
      }
      return $mapping[$datastream_id];
    }

    throw $this->getMissingException(strtr('No mapping present for model(s) "{models}" with datastream ID {dsid}.', [
      '{models}' => var_export($model_uris, TRUE),
      '{dsid}' => $datastream_id,
    ]));
  }

  /**
   * {@inheritDoc}
   */
  public function getDefaultMissingBehavior() {
    return 'skip_row';
  }

}
