<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\migrate\source;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\migrate\MigrateException;
use Drupal\migrate\Plugin\migrate\source\SourcePluginBase;
use Drupal\migrate\Plugin\MigrateSourceInterface;
use Drupal\migrate\Plugin\MigrationInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Iterate over a migration, introducing additional keying.
 *
 * @MigrateSource(
 *   id = "dgi_migrate_foxml_mapped_datastream_migration.source.mapped_datastream_source"
 * )
 *
 * Accepts:
 * - Optionally, one of:
 *   - datastreams: An array of datastreams for which to generate additional
 *     rows.
 *   - datastream_service: A service implementing
 *     \Drupal\dgi_migrate_foxml_mapped_datastream_migration\ModelPluginManagerInterface
 *     which gives the datastreams instead.
 *   - defaults to fetching datastreams from
 *     plugin.manager.dgi_migrate_foxml_mapped_datastream_migration.model.
 * - wrapped: A hash describing all the parameters/configuration for another
 *   migration source that we are going to use.
 * - datastream_key: A string identifying the value we will add to the rows we
 *   generate, for each of the datastreams from datastreams/datastream_service.
 *   Defaults to 'datastream'.
 */
class MappedDatastreamSource extends SourcePluginBase implements ContainerFactoryPluginInterface {

  /**
   * The array of datastreams for each of which to generate additional rows.
   *
   * @var array
   */
  protected array $datastreamIds;

  /**
   * The wrapped migration source instance.
   *
   * @var \Drupal\migrate\Plugin\MigrateSourceInterface
   */
  protected MigrateSourceInterface $wrapped;

  /**
   * The key under which we should add the datastream ID to our rows.
   *
   * @var string
   */
  protected string $datastreamKey;

  /**
   * {@inheritDoc}
   *
   * @throws \Drupal\Component\Plugin\Exception\PluginException
   * @throws \Drupal\migrate\MigrateException
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition, ?MigrationInterface $migration = NULL) {
    $instance = new static($configuration, $plugin_id, $plugin_definition, $migration);

    if (isset($configuration['datastreams'])) {
      $instance->datastreamIds = $configuration['datastreams'];
    }
    elseif (isset($configuration['datastream_service'])) {
      $datastream_service = $container->get($configuration['datastream_service']);
      $instance->datastreamIds = $datastream_service->getDatastreamIds();
    }
    else {
      /** @var \Drupal\dgi_migrate_foxml_mapped_datastream_migration\ModelPluginManagerInterface $datastream_service */
      $datastream_service = $container->get('plugin.manager.dgi_migrate_foxml_mapped_datastream_migration.model');
      $instance->datastreamIds = $datastream_service->getDatastreamIds();
    }

    if (!isset($instance->datastreamIds)) {
      throw new MigrateException('Missing datastream ID listing.');
    }

    /** @var \Drupal\migrate\Plugin\MigratePluginManagerInterface $source_plugin_manager */
    $source_plugin_manager = $container->get('plugin.manager.migrate.source');

    $instance->wrapped = $source_plugin_manager->createInstance(
      $configuration['wrapped']['plugin'],
      $configuration['wrapped'] ?? [],
      $migration
    );

    $instance->datastreamKey = $configuration['datastream_key'] ?? 'datastream';
    $wrapped_ids = $instance->wrapped->getIds();
    if (isset($wrapped_ids[$instance->datastreamKey])) {
      throw new MigrateException(strtr("The key {datastream_key} is already provided by the wrapped migration.", [
        '{datastream_key}' => $instance->datastreamKey,
      ]));
    }

    return $instance;
  }

  /**
   * {@inheritDoc}
   */
  public function fields() {
    return $this->wrapped->fields() + [
      $this->datastreamKey => $this->t('Datastream ID to attempt to process.'),
    ];
  }

  /**
   * {@inheritDoc}
   */
  public function __toString() {
    return "datastream context wrapping of '{$this->wrapped}'";
  }

  /**
   * {@inheritDoc}
   */
  public function getIds() {
    return $this->wrapped->getIds() + [
      $this->datastreamKey => [
        'type' => 'string',
      ],
    ];
  }

  /**
   * {@inheritDoc}
   */
  protected function initializeIterator() {
    return $this->generateAugmentedRows();
  }

  /**
   * Generate the rows derived from wrapped migration source.
   *
   * @return \Generator
   *   The rows of the wrapped migration source have the `::$datastreamKey`
   *   property bearing the given datastream ID added to them before they are
   *   yielded.
   */
  protected function generateAugmentedRows() {
    /**
     * @var string|int $id
     * @var \Drupal\migrate\Row $wrapped_row
     */
    foreach ($this->wrapped as $id => $wrapped_row) {
      $info = $wrapped_row->getSource();
      foreach ($this->datastreamIds as $datastream_id) {
        yield "{$id}__{$datastream_id}" => ($info + [
          $this->datastreamKey => $datastream_id,
        ]);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function rewind() {
    // XXX: "rewind()" by recreating the underlying iterator, since we make
    // use of the generator business.
    unset($this->iterator);
    $this->next();
  }

  /**
   * {@inheritdoc}
   */
  public function __sleep() {
    $vars = parent::__sleep();

    $to_suppress = [
      // XXX: Avoid serializing some things can't be natively serialized.
      'iterator',
    ];
    foreach ($to_suppress as $value) {
      $key = array_search($value, $vars);
      if ($key !== FALSE) {
        unset($vars[$key]);
      }
    }

    return $vars;
  }

}
