<?php
require_once '../app/config/config.php';
$directory = $config['DATA_PATH'].'databaseBackups'.DS;

backup_database($directory, 'backup' , 'localhost' , 'f9181089_person' , 'person' , 'f9181089_mydatabase');
$blah = $config['VIEW_PATH'] . 'backupDatabase' . DS;
$view = $blah . 'successView.phtml';



