<?php
/**
 * The database settings. These get merged with the global settings.
 */

return array(
  'default' => array(
    'type'   => 'mysqli',
    'connection' => array(
      'hostname'   => 'localhost',
      'database'   => 'admin_dds',
      'username'   => 'yossy',
      'password'   => 'yossy',
      'persistent' => false,
      'compress' => false,
    ),
    'table_prefix' => '',
    'charset'   => 'utf8',
    'enable_cache' => true,
    'caching'   => false,
    'profiling' => true,
  ),
);
