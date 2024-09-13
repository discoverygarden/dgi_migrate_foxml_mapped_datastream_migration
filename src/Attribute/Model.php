<?php

namespace Drupal\dgi_migrate_foxml_mapped_datastream_migration\Attribute;

use Drupal\Component\Plugin\Attribute\AttributeBase;

/**
 * Model plugin attribute definition.
 *
 * Represents mappings from Islandora 7/Fedora 3 content models.
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
final class Model extends AttributeBase {

  /**
   * Constructor.
   */
  public function __construct(
    string $id,
    public readonly ?string $uri = NULL,
  ) {
    parent::__construct($id);
  }

}
