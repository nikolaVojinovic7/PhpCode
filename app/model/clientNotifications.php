<!-- These are the cases for client notifications, relating the views to the text files and obtaining the right fields-->
<?php
require_once 'ClientEvent.php';
require_once '../app/model/Log.php';
require_once '../app/config/config.php';

$current_view = $config['VIEW_PATH'] . 'clientNotifications' . DS;
$file =  $config['DATA_PATH'] . 'clientEventData.txt';

switch (get('action')){
    case 'viewClientNotification':{
        $log1 = new Log($_SESSION['username'] , 'client events', 'view', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $clientEvents = getAllClientEvents($conn);
        $view = $current_view . 'viewClientNotification.phtml';
        break;
    }

    case 'editClientNotification':{
        $view = $current_view . 'editClientNotification.phtml';
        $id = filter_input(INPUT_GET, "id");
        $log1 = new Log($_SESSION['username'] , 'client events', 'update', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $clientEvent = getClientEvent($conn, $id);
        break;
    }
    case 'doClientNotificationEdit':{
        $status = get('status');
        $clientID = get('clientID');
        if (empty($clientID)){
            $clientID = "No Client ID was given";
        }

        $notificationID = get('notificationID');
        if (empty($notificationID)){
            $notificationID = 'No Notification ID was given';
        }

        $startDate = get('startDate');
        if (empty($startDate)){
            $startDate = 'No Start Date/Time given';
        }

        $frequency = get('frequency');
        if (empty($frequency)){
            $frequency = 'No frequency given';
        }

        $clientID = get('clientID');
        $notificationID = get("notificationID");
        $startDate = get("startDate");
        $frequency = get("frequency");
        $status = get("status");

        $id = get( "id");


        updateClientEvent($conn, new ClientEvent($clientID, $notificationID, $startDate, $frequency, $status, $id));
        $view = $current_view.'editClientNotificationView.phtml';
        $clientEvents = getAllClientEvents($conn);
        break;
    }

    case 'editClientNotificationView':{
        $view = $current_view . 'editClientNotificationView.phtml';
        $clientEvents = getAllClientEvents($conn);
        break;
    }

    case 'addClientNotification':{
        $view = $current_view . 'addClientNotification.phtml';
        $log1 = new Log($_SESSION['username'] , 'client events', 'add', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        break;
    }
    case 'doAddClientNotification':{


        $clientID = get('clientID');
        $notificationID = get("notificationID");
        $startDate = get("startDate");
        $frequency = get("frequency");
        $status = get("status");

        $clientID = get('clientID');
        if (empty($clientID)){
            $clientID = "No Client ID was given";
        }

        $notificationID = get('notificationID');
        if (empty($notificationID)){
            $notificationID = 'No Notification ID was given';
        }

        $startDate = get('startDate');
        if (empty($startDate)){
            $startDate = 'No Start Date/Time given';
        }

        $frequency = get('frequency');
        if (empty($frequency)){
            $frequency = 'No frequency given';
        }

        $id = get( "id");

        addClientEvent($conn, new ClientEvent($clientID, $notificationID, $startDate, $frequency,  $status, $id));
        $view = $current_view.'viewClientNotification.phtml';
        $clientEvents = getAllClientEvents($conn);
        break;
    }

    case 'archiveActivateViewClientNotification':{
        $view = $current_view . 'archiveActivateViewClientNotification.phtml';
        $clientEvents = getAllClientEvents($conn);
        break;
    }

    case 'archiveClientNotification':{
        $view = $current_view . 'archiveClientNotification.phtml';
        $id = filter_input(INPUT_GET, "id");
        $log1 = new Log($_SESSION['username'] , 'client events', 'archive', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $clientEvent = getClientEvent($conn, $id);
        break;
    }

    case 'doClientNotificationArchive':{
        $clientID = get('clientID');
        $notificationID = get("notificationID");
        $startDate = get("startDate");
        $frequency = get("frequency");
        $status = get("status");

        $id = get( "id");

        updateClientEvent($conn, new ClientEvent($clientID, $notificationID, $startDate, $frequency, $status, $id));
        $view = $current_view.'archiveActivateViewClientNotification.phtml';
        $clientEvents = getAllClientEvents($conn);
        break;
    }

    case 'activateClientNotification':{
        $view = $current_view . 'activateClientNotification.phtml';
        $id = filter_input(INPUT_GET, "id");
        $log1 = new Log($_SESSION['username'] , 'client events', 'activate', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $clientEvent = getClientEvent($conn, $id);
        break;
    }


    case 'doActivateClientNotification':{
        $clientID = get('clientID');
        $notificationID = get("notificationID");
        $startDate = get("startDate");
        $frequency = get("frequency");
        $status = 'active';

        $id = get( "id");

        updateClientEvent($conn, new ClientEvent($clientID, $notificationID, $startDate, $frequency, $status, $id));
        $view = $current_view.'archiveActivateViewClientNotification.phtml';
        $clientEvents = getAllClientEvents($conn);
        break;
    }

    case 'searchClientNotification':{
        $view = $current_view . 'searchClientNotification.phtml';
        break;
    }
}
echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source</a>";