<?php

$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMapFromDumps(array (
  'default' => 
  array (
    'tablesByName' => 
    array (
      'cfa' => '\\Art\\Map\\CfaTableMap',
      'pieces' => '\\Art\\Map\\PiecesTableMap',
      'registry' => '\\Art\\Map\\RegistryTableMap',
      'users' => '\\Art\\Map\\UsersTableMap',
    ),
    'tablesByPhpName' => 
    array (
      '\\Cfa' => '\\Art\\Map\\CfaTableMap',
      '\\Pieces' => '\\Art\\Map\\PiecesTableMap',
      '\\Registry' => '\\Art\\Map\\RegistryTableMap',
      '\\Users' => '\\Art\\Map\\UsersTableMap',
    ),
  ),
));

?>