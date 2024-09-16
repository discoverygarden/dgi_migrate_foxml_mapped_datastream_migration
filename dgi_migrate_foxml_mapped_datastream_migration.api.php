<?php

/**
 * @file
 * API documentation.
 */

/**
 * Model plugin definition alter hook.
 *
 * @param array $plugins
 *   Associative array of plugin definitions, keyed by ID, passed by reference
 *   to allow mutation.
 */
function hook_dgi_migrate_foxml_mapped_datastream_migration_model_plugin_info_alter(array &$plugins) : void {
  // Possibly selecting individual plugins to override/extend the specified
  // classes?
}
