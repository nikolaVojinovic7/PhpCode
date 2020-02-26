<!-- These are the cases for clients, relating the views to the text files and obtaining the right fields-->
<?php

use http\Header;

require_once '../app/model/Log.php';
require_once 'User.php';
require_once '../app/config/config.php';

$current_view = $config['VIEW_PATH'] . 'users' . DS;

switch (get('action')){
    case 'view':{
        $log1 = new Log($_SESSION['username'] , 'users', 'view', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $users = getAllUsers($conn);
        $view = $current_view . 'view.phtml';
        break;
    }

    case 'archive_activate_view':{
        $view = $current_view . 'archive_activate_view.phtml';
        $users = getAllUsers($conn);
        break;
    }

    case 'suspend':{
        $view = $current_view . 'suspend.phtml';
        $id = filter_input(INPUT_GET, "id");
        // adding log here
        $log1 = new Log($_SESSION['username'] , 'users', 'suspend', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $user = getUser($conn, $id);
        break;
    }

    case 'doSuspend':{
        $userFirstName = get('userFirstName');
        $userLastName = get("userLastName");
        $userEmail = get("userEmail");
        $userCellNum = get("userCellNum");
        $userPos = get("userPos");
        $username = get("username");
        $password = get("password");
        $userPic = get("userPic");
        $userStatus = get("userStatus");
        $id = get( "id");

        updateUser($conn, new User($userFirstName, $userLastName, $userEmail, $userCellNum, $userPos, $username, $password, $userStatus, $userPic, $id));
        $view = $current_view.'archive_activate_view.phtml';
        $users = getAllUsers($conn);
        break;
    }

    case 'activate':{
        $view = $current_view . 'activate.phtml';
        $id = filter_input(INPUT_GET, "id");
        $log1 = new Log($_SESSION['username'] , 'users', 'activate', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $user = getUser($conn, $id);
        break;
    }


    case 'doActivate':{
        $userFirstName = get('userFirstName');
        $userLastName = get("userLastName");
        $userEmail = get("userEmail");
        $userCellNum = get("userCellNum");
        $userPos = get("userPos");
        $username = get("username");
        $password = get("password");
        $userPic = get("userPic");
        $userStatus = 'Active';
        $id = get( "id");

        updateUser($conn, new User($userFirstName, $userLastName, $userEmail, $userCellNum, $userPos, $username, $password, $userStatus, $userPic, $id));
        $view = $current_view.'archive_activate_view.phtml';
        $users = getAllUsers($conn);
        break;
    }

    case 'update_view':{
        $view = $current_view . 'update_view.phtml';
        $users = getAllUsers($conn);
        break;
    }

    case 'update':{
        $view = $current_view . 'update.phtml';
        $id = get('id');
        $user = getUser($conn, $id);
        break;
    }
    case 'doUpdate':{
        $userFirstName = get('userFirstName');
        $userLastName = get("userLastName");
        $userEmail = get("userEmail");
        $userCellNum = get("userCellNum");
        $userPos = get("userPos");
        $username = get("username");
        $password = get("password");
        $userPic = get("userPic");
        $userStatus = get("userStatus");
        $id = get( "id");

        updateUser($conn, new User($userFirstName, $userLastName, $userEmail, $userCellNum, $userPos, $username, $password, $userStatus, $userPic, $id));
        $view = $current_view . 'update_view.phtml';
        $users = getAllUsers($conn);
        break;
    }

    case 'add':{
        if(!isset($_SESSION['username'])){
            $_SESSION['username'] = 'New User';
        }
        $log1 = new Log($_SESSION['username'] , 'users', 'add', date("Y-m-d h:i:sa"), $_SERVER['REMOTE_ADDR']);
        addLog($conn , $log1);
        $view = $current_view . 'add.phtml';
        break;
    }
    case 'doAdd':{
        $id = get('id');

        $img_type = array(
            'image/jpeg' => '.jpg',
            'image/png' => '.png',
            'image/gif' => '.gif'
        );

        $userFirstName = get('userFirstName');
        $userLastName = get("userLastName");
        $userEmail = get("userEmail");
        $userCellNum = get("userCellNum");
        $userPos = get("userPos");
        $username = get("username");
        $password = get("password");
        $userStatus = 'Suspended';
        $id = get( "id");
        $profileImage = time(). '_' . $_FILES['profileImage']['name'];




        if(empty($_FILES['profileImage']['name'])){
            $profileImage = 'defaultpic.jpg';
            addUser($conn, new User($userFirstName, $userLastName, $userEmail, $userCellNum, $userPos, $username, $password, $userStatus, $profileImage, $id));
            $view = $current_view . 'view.phtml';
            $users = getAllUsers($conn);
            break;
        }
        else{
            $profileImage = time(). '_' . $_FILES['profileImage']['name'];
            $target = '../app/data/images'.DS.$profileImage;
            addUser($conn, new User($userFirstName, $userLastName, $userEmail, $userCellNum, $userPos, $username, $password, $userStatus, $profileImage, $id));


            move_uploaded_file($_FILES['profileImage']['tmp_name'], $target);

            @header('Content-type: image/jpeg');
            $percent = 0.05;


            list($width, $height) = getimagesize($target);

            $newWidth= $width * $percent;
            $newHeight = $height * $percent;


            $thumb = imagecreatetruecolor($newWidth , $newHeight);
            $source = imagecreatefromjpeg($target);

            $copyImage = imagecopyresized($thumb , $source , 0 , 0 ,0 ,0 ,$newWidth, $newHeight, $width ,$height);
            move_uploaded_file($copyImage , $target);

            if(!empty($_FILES['profileImage']['name'])) {
                ?><script type="text/javascript">
                    window.location.href = 'https://f9181089.gblearn.com/comp1230/assignment/assignment2/public/?page=users&action=view';
                    </script><?php
                break;
            }


        }
        break;
    }

    case 'search':{
        $view = $current_view . 'search.phtml';
        break;
    }

    case 'logIn':{
        $username = get('username');
        $password = get('password');

        if(verifyUser($conn , $username , $password)){
            $userLoggedIn = verifyUser($conn , $username , $password);
            $_SESSION['username'] = $userLoggedIn -> getUsername();
            $_SESSION['password'] = $userLoggedIn -> getPassword();
            $_SESSION['position'] = $userLoggedIn -> getUserPosition();
            $_SESSION['picture'] = $userLoggedIn -> getUserPic();
            $view = $config['VIEW_PATH'].'home.phtml';
        }
        else{
            $view = $config['VIEW_PATH'].'logIn.phtml';
        }

        break;
    }

    case 'logout':{
            $_SESSION['username'] = null;
            $_SESSION['password'] = null;
            $_SESSION['position'] = null;
            $_SESSION['picture'] = null;
            $view = $config['VIEW_PATH'].'logIn.phtml';
        break;
    }
}
echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source</a>";
