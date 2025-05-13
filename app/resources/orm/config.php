<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once(__DIR__ . "/../env.php");

$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion(2);
$serviceContainer->setAdapterClass('default', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle('default');
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=' . $env['sql_uri'] . ';port=' . $env['sql_port'] . ';dbname=' . $env['sql_db'],
  'user' => $env['sql_user'],
  'password' => $env['sql_password'],
  'options' => array (
    'MYSQL_ATTR_INIT_COMMAND' => 'SET NAMES utf8',
    'MYSQL_ATTR_SSL_CA' => $env['sql_cert'],
    'MYSQL_ATTR_SSL_VERIFY_SERVER_CERT' => false
  ),
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
    ),
  ),
  'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$serviceContainer->setConnectionManager($manager);
$serviceContainer->setDefaultDatasource('default');
require_once __DIR__ . '/./loadDatabase.php';

?>