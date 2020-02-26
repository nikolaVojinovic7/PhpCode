<?php
require_once '../app/model/Log.php';
require_once '../app/config/config.php';

$current_view = $config['VIEW_PATH'] . 'logs' . DS;

switch (get('action')) {
    case 'view':
    {
        $log = getLog($conn, null);
        $view = $current_view . 'viewLogs.phtml';
        $logs = getAllLogs($conn);
        break;
    }
}