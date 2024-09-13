<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration;

use Drupal\Component\Plugin\PluginInspectionInterface;

interface ModelInterface extends PluginInspectionInterface {

  public function getMapping() : array;

}
