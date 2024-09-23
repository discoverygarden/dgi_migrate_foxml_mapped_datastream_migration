<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Plugin\PluginBase;
use Drupal\dgi_migrate_foxml_mapped_datastream_migration\ModelInterface;
use Psr\Log\LoggerInterface;
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
   * Entity type bundle info service.
   *
   * @var \Drupal\Core\Entity\EntityTypeBundleInfoInterface
   */
  protected EntityTypeBundleInfoInterface $entityTypeBundleInfo;

  /**
   * Logger service.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected LoggerInterface $logger;

  /**
   * {@inheritDoc}
   */
  public function getMapping(): array {
    $media_type_exists = function ($mapping, $key) {
      $exists = isset($this->entityTypeBundleInfo->getBundleInfo('media')[$mapping['media_type']]);

      if (!$exists) {
        $this->logger->warning('Media type "{type}" does not exist; skipping mapping of "{datastream_id}" for "{model_plugin_id}".', [
          'type' => $mapping['media_type'],
          'datastream_id' => $key,
          'model_plugin_id' => $this->getPluginId(),
        ]);
      }

      return $exists;
    };
    return $this->mapping ??= array_filter($this->doGetMapping(), $media_type_exists, ARRAY_FILTER_USE_BOTH);
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
    $instance = new static($configuration, $plugin_id, $plugin_definition);

    $instance->entityTypeBundleInfo = $container->get('entity_type.bundle.info');
    $instance->logger = $container->get('logger.channel.dgi_migrate_foxml_mapped_datastream_migration');

    return $instance;
  }

}
