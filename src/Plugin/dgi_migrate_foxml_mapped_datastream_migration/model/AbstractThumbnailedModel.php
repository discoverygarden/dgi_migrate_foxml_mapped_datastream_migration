<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model;

use Drupal\dgi_migrate_foxml_mapped_datastream_migration\Plugin\dgi_migrate_foxml_mapped_datastream_migration\model\traits\ThumbnailTrait;

/**
 * Abstract base class for models wanting thumbnails.
 */
abstract class AbstractThumbnailedModel extends AbstractBaseModel {

  use ThumbnailTrait;

}
