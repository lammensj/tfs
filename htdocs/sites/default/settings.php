<?php

$databases = [];
$config_directories = [];

$settings['hash_salt'] = 'SwHnUWpj4RZNRqKoYh3kysmHwjOoQ6xeoSJywKIkvx98xly6cmKrPQgKrnJtmpuRI11w25lCXQ';
$settings['update_free_access'] = FALSE;
$settings['container_yamls'][] = __DIR__ . '/services.yml';
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

$settings['install_profile'] = 'minimal';
$config_directories['sync'] = 'sites/default/config/sync';

if (file_exists(__DIR__ . '/settings.local.php')) {
  include __DIR__ . '/settings.local.php';
}

