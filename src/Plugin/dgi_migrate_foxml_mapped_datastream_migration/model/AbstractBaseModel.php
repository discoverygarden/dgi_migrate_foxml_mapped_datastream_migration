<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Plugin\PluginBase;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\ModelInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Abstract model plugin base class.
 */
abstract class AbstractBaseModel extends PluginBase implements ModelInterface, ContainerFactoryPluginInterface {

  /**
   * Memoized mapping, in case things get merged in various ways.
   *
   * @var array
   */
  protected array $mapping;

  /**
   * {@inheritDoc}
   */
  public function getMapping(): array {
    return $this->mapping ??= $this->doGetMapping();
  }

  /**
   * Build out the mapping as per ::getMapping().
   *
   * We expect that this might merge together the results of various methods.
   *
   * @return array
   *   Get the built-out mapping.
   */
  abstract protected function doGetMapping() : array;

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) : static {
    return new static($configuration, $plugin_id, $plugin_definition);
  }

}
