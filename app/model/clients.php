<!-- These are the cases for clients, relating the views to the text files and obtaining the right fields-->
<?php
require_once 'Client.php';
require_once '../app/model/Log.php';
require_once '../app/config/config.php';
$current_view = $config['VIEW_PATH'] . 'clients' . DS;


switch (get('action')){
    case 'view':{
        $log1 = new Log($_SESSION['username'] , 'clients', 'view', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $clients = getAllClients($conn);
        $view = $current_view . 'view.phtml';
        break;
    }

    case 'archive_activate_view':{
        $view = $current_view . 'archive_activate_view.phtml';
        $clients = getAllClients($conn);
        break;
    }

    case 'archive':{
        $view = $current_view . 'archive.phtml';
        $id = filter_input(INPUT_GET, "id");
        $log2 = new Log($_SESSION['username'] , 'clients', 'archive', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log2);
        $client = getClient($conn, $id);
        break;
    }

    case 'doArchive':{
        $companyName = get('companyName');
        $businessNum = get("businessNum");
        $firstName = get("firstName");
        $lastName = get("lastName");
        $phoneNum = get("phoneNum");
        $cellNum = get("cellNum");
        $website = get("website");
        $status = get('status');

        $id = get( "id");

        updateClient($conn, new Client($companyName, $businessNum, $firstName, $lastName, $phoneNum, $cellNum, $website, $status, $id));
        $view = $current_view.'archive_activate_view.phtml';
        $clients = getAllClients($conn);
        break;
    }

    case 'activate':{
        $view = $current_view . 'activate.phtml';
        $id = filter_input(INPUT_GET, "id");
        $log2 = new Log($_SESSION['username'] , 'clients', 'activate', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log2);
        $client = getClient($conn, $id);
        break;
    }


    case 'doActivate':{
        $companyName = get('companyName');
        $businessNum = get("businessNum");
        $firstName = get("firstName");
        $lastName = get("lastName");
        $phoneNum = get("phoneNum");
        $cellNum = get("cellNum");
        $website = get("website");
        $status = get("status");

        $id = get( "id");

        updateClient($conn, new Client($companyName, $businessNum, $firstName, $lastName, $phoneNum, $cellNum, $website, $status, $id));
        $view = $current_view.'archive_activate_view.phtml';
        $clients = getAllClients($conn);
        break;
    }

    case 'edit_view':{
        $view = $current_view . 'edit_view.phtml';
        $clients = getAllClients($conn);
        break;
    }

    case 'edit':{
        $view = $current_view . 'edit.phtml';
        $id = filter_input(INPUT_GET, "id");
        $log2 = new Log($_SESSION['username'] , 'clients', 'update', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log2);
        $client = getClient($conn, $id);
        break;
    }
    case 'doEdit':{
        $id = get('id');
        $status = get('status');
        if (empty($companyName)){
            $companyName = 'No Company Name given';
        }
        $businessNum = get('businessNum');
        if (empty($businessNum)){
            $businessNum = 'No Business Number was given';
        }
        $firstName = get('firstName');
        if (empty($firstName)){
            $firstName = 'No First Name given';
        }
        $lastName = get('lastName');
        if (empty($lastName)){
            $lastName = 'No Last Name given';
        }
        $phoneNum = get('phoneNum');
        if (empty($phoneNum)){
            $phoneNum = 'No Phone Number was given';
        }
        $cellNum = get('cellNum');
        if (empty($cellNum)){
            $cellNum = 'No Cell number was given';
        }
        $website = get('website');
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
            $website = "Invalid/No URL";
        }

        $companyName = get('companyName');
        $businessNum = get("businessNum");
        $firstName = get("firstName");
        $lastName = get("lastName");
        $phoneNum = get("phoneNum");
        $cellNum = get("cellNum");
        $website = get("website");
        $status = get("status");

        $id = get( "id");

        updateClient($conn, new Client($companyName, $businessNum, $firstName, $lastName, $phoneNum, $cellNum, $website, $status, $id));
        $view = $current_view.'edit_view.phtml';
        $clients = getAllClients($conn);
        break;
    }

    case 'add':{
        $view = $current_view . 'add.phtml';
        $log2 = new Log($_SESSION['username'] , 'clients', 'add', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log2);
        break;
    }
    case 'doAdd':{
        $view = $current_view . 'add.phtml';
        $id = get('id');

        $companyName = get('companyName');
        if (empty($companyName)){
            $companyName = "No Name was given";
        }
        $businessNum = get('businessNum');
        if (empty($businessNum)){
            $businessNum = 'No Business Number was given';
        }
        $firstName = get('firstName');
        if (empty($firstName)){
            $firstName = 'No First Name given';
        }
        $lastName = get('lastName');
        if (empty($lastName)){
            $lastName = 'No Last Name given';
        }
        $phoneNum = get('phoneNum');
        if (empty($phoneNum)){
            $phoneNum = 'No Phone Number was given';
        }
        $cellNum = get('cellNum');
        if (empty($cellNum)){
            $cellNum = 'No Cell number was given';
        }
        $website = get('website');
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
            $website = "Invalid/No URL";
        }
        $companyName = get('companyName');
        $businessNum = get("businessNum");
        $firstName = get("firstName");
        $lastName = get("lastName");
        $phoneNum = get("phoneNum");
        $cellNum = get("cellNum");
        $website = get("website");
        $status = get("status");

        $id = get( "id");

        addClient($conn, new Client($companyName, $businessNum, $firstName, $lastName, $phoneNum, $cellNum, $website, $status, $id));
        $view = $current_view.'view.phtml';
        $clients = getAllClients($conn);
        break;
    }

    case 'search':{
        $view = $current_view . 'search.phtml';
        break;
    }
}
echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source</a>";