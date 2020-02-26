<!-- These are the cases for notifications, relating the views to the text files and obtaining the right fields-->
<?php
require_once 'Notification.php';
require_once '../app/model/Log.php';
require_once '../app/config/config.php';

$current_view = $config['VIEW_PATH'] . 'notifications' . DS;
$file =  $config['DATA_PATH'] . 'notificationData.txt';

switch (get('action')){
    case 'viewNotification':{
        $log1 = new Log($_SESSION['username'] , 'notifications', 'view', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $notifications = getAllNotifications($conn);
        $view = $current_view . 'viewNotification.phtml';
        break;
    }
    case 'enableDisableNotificationView':{
        $view = $current_view . 'enableDisableNotificationView.phtml';
        $notifications = getAllNotifications($conn);
        break;
    }
    case 'disableNotification':{
        $view = $current_view . 'disableNotification.phtml';
        $id = filter_input(INPUT_GET, "id");
        $log1 = new Log($_SESSION['username'] , 'notifications', 'disable', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $notification= getNotification($conn, $id);
        break;
    }

    case 'doDisableNotification':{
        $notificationName = get('notificationName');
        $notificationType = get("notificationType");
        $status = 'disabled';

        $id = get( "id");

        updateNotification($conn, new Notification($notificationName, $notificationType, $status, $id));
        $view = $current_view.'enableDisableNotificationView.phtml';
        $notifications = getAllNotifications($conn);
        break;
    }

    case 'enableNotification':{
        $view = $current_view . 'enableNotification.phtml';
        $id = filter_input(INPUT_GET, "id");
        $log1 = new Log($_SESSION['username'] , 'notifications', 'enable', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $notification= getNotification($conn, $id);
        break;
    }

    case 'doEnableNotification':{
        $notificationName = get('notificationName');
        $notificationType = get("notificationType");
        $status = 'enabled';

        $id = get( "id");

        updateNotification($conn, new Notification($notificationName, $notificationType, $status, $id));
        $view = $current_view.'enableDisableNotificationView.phtml';
        $notifications = getAllNotifications($conn);
        break;
    }

    case 'editNotificationView':{
        $view = $current_view . 'editNotificationView.phtml';
        $notifications = getAllNotifications($conn);
        break;
    }

    case 'editNotification':{
        $view = $current_view . 'editNotification.phtml';
        $id = filter_input(INPUT_GET, "id");
        $log1 = new Log($_SESSION['username'] , 'notifications', 'update', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $notification = getNotification($conn, $id);
        break;
    }

    case 'doEditNotification':{
        $notificationName = get('notificationName');
        $notificationName = get('notificationName');
        $notificationType = get("notificationType");
        if (empty($notificationName)){
            $notificationName = 'No Notification Name given';
        }
        $notificationType = get('notificationType');
        if (empty($notificationType)){
            $notificationType = 'No Notification Type was given';
        }
        $status = get("status");
        $id = get( "id");

        updateNotification($conn, new Notification($notificationName, $notificationType, $status, $id));
        $view = $current_view.'editNotificationView.phtml';
        $notifications = getAllNotifications($conn);
        break;
    }

    case 'addNotification':{
        $log1 = new Log($_SESSION['username'] , 'notifications', 'add', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $view = $current_view . 'addNotification.phtml';
        break;
    }
    case 'doAddNotification':{
        $notificationName = get('notificationName');
            if (empty($notificationName)){
                $notificationName = 'No Notification Name given';
            }

        $notificationType = get('notificationType');
            if (empty($notificationType)){
                $notificationType = 'No Notification Type was given';
            }

        $status = get("status");

        $id = get( "id");

        addNotification($conn, new Notification($notificationName, $notificationType, $status, $id));
        $view = $current_view.'viewNotification.phtml';
        $notifications = getAllNotifications($conn);
        break;
    }

    case 'searchNotification':{
        $view = $current_view . 'searchNotification.phtml';
        break;
    }


}

echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source</a>";