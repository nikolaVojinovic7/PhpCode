<?php

$directory = $config['DATA_PATH'].'databaseBackups'.DS;

backup_database($directory, 'backup' , 'localhost' , 'admin' , 'Vacation5' , 'mydatabase');
$blah = $config['VIEW_PATH'] . 'restoreDatabase' . DS;

$backupNum = 22;

$files = scandir($directory , SCANDIR_SORT_DESCENDING);
$newest_file = $files[0];


@$args = file_get_contents($newest_file);

mysqli_import_sql($args, 'localhost' , 'admin' , 'Vacation5' , 'mydatabase');

$view = $blah . 'restoreDatabaseSuccess.phtml';