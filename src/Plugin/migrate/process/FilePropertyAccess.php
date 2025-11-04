<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\migrate\process;

use Drupal\Core\Database\Connection;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\migrate\MigrateException;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Plugin\MigrationInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Given a file ID, lookup a property from the file_managed table.
 *
 * @MigrateProcessPlugin(
 *   id = "dgi_migrate_foxml_mapped_datastream_migration.process.file_property"
 * )
 */
class FilePropertyAccess extends ProcessPluginBase implements ContainerFactoryPluginInterface {

  /**
   * Database connection service with which to look up.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected Connection $database;

  /**
   * The property to look up.
   *
   * @var string
   */
  protected string $property;

  /**
   * {@inheritDoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    $query = $this->database->select('file_managed', 'f')
      ->fields('f', [$this->property])
      ->condition('fid', $value);

    return $query->execute()->fetchField();
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition, ?MigrationInterface $migration = NULL) {
    $instance = new static($configuration, $plugin_id, $plugin_definition, $migration);

    $instance->database = $container->get('database');
    $instance->property = $configuration['property'];

    if (!isset($instance->property)) {
      throw new MigrateException('No property to look up?');
    }

    return $instance;
  }

}
