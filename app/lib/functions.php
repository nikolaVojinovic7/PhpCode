<?php
require_once '../app/model/Client.php';
require_once '../app/model/User.php';
require_once '../app/model/Notification.php';
require_once '../app/model/ClientEvent.php';
require_once  '../app/config/config.php';

function get($name, $def='')
{
    return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $def;
}


function getID(){
    $file_name = 'ids';
    if(!file_exists($file_name)){
        touch($file_name);
        $handle = fopen($file_name , 'r');
        $id = 0;
    }
    else{
        $handle = fopen($file_name , 'r+');
        $id = fread($handle , filesize($file_name));
        settype($id , "integer");
    }
    rewind($handle);
    fwrite($handle, ++$id);

    fclose($handle);
    return $id;
}

function getAllClients($conn){

    $sql = "SELECT  client_id, company_name, 
business_number, first_name, last_name, phone_number, 
cell_number, website, status  FROM client";
    $clients = array();
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while($row = $res->fetch_array()){
            $c = new Client($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[0]);
            $clients[] = $c;
        }
    }
    $conn->close();
    return $clients;
}

function getClient($conn, $id){

    $sql = "SELECT  client_id, company_name, 
business_number, first_name, last_name, phone_number, 
cell_number, website, status  FROM client WHERE client_id = ".$id;
    $client = null;
    if($res = $conn->query($sql)) {
        if ($res->num_rows == 1) {
            while ($row = $res->fetch_array()) {
                $c = new Client($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[0]);
                $client = $c;
            }
        }
    }
    $conn->close();
    return $client;
}

function searchClient($conn, $input){

    $sql = "SELECT  *  FROM client WHERE client_id = '".$input."' || company_name = '"
        .$input."' || business_number = '".$input."' || first_name = '".$input."' || last_name = '"
        .$input."' || phone_number = '".$input."' || cell_number = '".$input."' || website = '".$input."' || status = '".$input."'";
    $clientsSearched = array();
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while($row = $res->fetch_array()){
            $c = new Client($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[0]);
            $clientsSearched[] = $c;
        }
    }
    $conn->close();
    return $clientsSearched;
}

function addClient($conn, $client){
    $sql = "INSERT INTO client (company_name, business_number, first_name, last_name, phone_number, cell_number, website, status) 
            VALUES ('".$client->getCompanyName()
        ."', '".$client->getBusinessNumber()."', '".$client->getFirstName()
        ."', '".$client->getLastName()."', '".$client->getPhoneNumber()
        ."', '".$client->getCellNumber()."', '".$client->getWebsite()."', '".$client->getStatus()."') ";
    $conn->query($sql);
}

function updateClient($conn, $client){
    $sql = "UPDATE client SET
                company_name = '".$client->getCompanyName()."',
                business_number = '".$client->getBusinessNumber() ."',
                first_name = '".$client->getFirstName()."',
                last_name = '".$client->getLastName()."',
                phone_number = '".$client->getPhoneNumber()."',
                cell_number = '".$client->getCellNumber()."',
                website = '".$client->getWebsite()."',
                status = '".$client->getStatus()."'
         WHERE client_id = ".$client->getId();
    if(!$conn->query($sql)){
        echo $conn->mysqli_error($conn);//last error in SQL
    }
}

function getAllNotifications($conn){

    $sql = "SELECT  *  FROM notifications";
    $notifications = array();
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while($row = $res->fetch_array()){
            $n = new Notification($row[1], $row[2], $row[3], $row[0]);
            $notifications[] = $n;
        }
    }
    $conn->close();
    return $notifications;
}

function getNotification($conn, $id){

    $sql = "SELECT  *  FROM notifications WHERE notification_id = ".$id;
    $notification = null;
    if($res = $conn->query($sql)) {
        if ($res->num_rows == 1) {
            while ($row = $res->fetch_array()) {
                $n = new Notification($row[1], $row[2], $row[3], $row[0]);
                $notification = $n;
            }
        }
    }
    $conn->close();
    return $notification;
}

function searchNotification($conn, $input){

    $sql = "SELECT  *  FROM notifications WHERE notification_id = '".$input."' || notification_name = '"
        .$input."' || notification_type = '".$input."' || notification_status = '".$input."'";
    $notificationsSearched = array();
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while($row = $res->fetch_array()){
            $n = new Notification($row[1], $row[2], $row[3], $row[0]);
            $notificationsSearched[] = $n;
        }
    }
    $conn->close();
    return $notificationsSearched;
}

function addNotification($conn, $notification){
    $sql = "INSERT INTO notifications (notification_name, notification_type, notification_status) 
            VALUES ('".$notification->getName()
        ."', '".$notification->getType()."', '".$notification->getStatus()."') ";
    $conn->query($sql);
}

function updateNotification($conn, $notification){
    $sql = "UPDATE notifications SET
                notification_name = '".$notification->getName()."',
                notification_type = '".$notification->getType() ."',
                notification_status = '".$notification->getStatus()."'
         WHERE notification_id = ".$notification->getId();
    if(!$conn->query($sql)){
        echo $conn->mysqli_error($conn);//last error in SQL
    }
}

function getAllClientEvents($conn){

    $sql = "SELECT  *  FROM clientnotifications";
    $clientEvents = array();
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while($row = $res->fetch_array()){
            $cE = new ClientEvent($row[1], $row[2], $row[3], $row[4], $row[5], $row[0]);
            $clientEvents[] = $cE;
        }
    }
    $conn->close();
    return $clientEvents;
}

function getClientEvent($conn, $id){

    $sql = "SELECT  *  FROM clientnotifications WHERE client_event_id = ".$id;
    $clientEvent = null;
    if($res = $conn->query($sql)) {
        if ($res->num_rows == 1) {
            while ($row = $res->fetch_array()) {
                $cE = new ClientEvent($row[1], $row[2], $row[3], $row[4], $row[5], $row[0]);
                $clientEvent = $cE;
            }
        }
    }
    $conn->close();
    return $clientEvent;
}

function searchClientEvent($conn, $input){

    $sql = "SELECT  *  FROM clientnotifications WHERE client_event_id = '".$input."' || client_id = '"
        .$input."' || notification_id = '".$input."' || start_date = '".$input."' || frequency = '"
        .$input."' || client_event_status = '".$input."'";

    $clientEventsSearch = array();
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while($row = $res->fetch_array()){
            $cE = new ClientEvent($row[1], $row[2], $row[3], $row[4], $row[5], $row[0]);
            $clientEventsSearch[] = $cE;
        }
    }
    $conn->close();
    return $clientEventsSearch;
}

function addClientEvent($conn, $clientEvent){
    $sql = "INSERT INTO clientnotifications (client_id, notification_id, start_date, frequency, client_event_status) 
            VALUES ('".$clientEvent->getClientID()
        ."', '".$clientEvent->getNotificationID()."', '".$clientEvent->getStartDate()
        ."', '".$clientEvent->getFrequency()."', '".$clientEvent->getStatus()."') ";
    $conn->query($sql);
}

function updateClientEvent($conn, $clientEvent){
    $sql = "UPDATE clientnotifications SET
                client_id = '".$clientEvent->getClientID()."',
                notification_id = '".$clientEvent->getNotificationID() ."',
                start_date = '".$clientEvent->getStartDate()."',
                frequency = '".$clientEvent->getFrequency()."',
                client_event_status = '".$clientEvent->getStatus()."'
         WHERE client_event_id = ".$clientEvent->getMessageID();
    if(!$conn->query($sql)){
        echo $conn->mysqli_error($conn);//last error in SQL
    }
}

function getAllUsers($conn){

    $sql = "SELECT  *  FROM users";
    $users = array();
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while($row = $res->fetch_array()){
            $u = new User($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[0]);
            $users[] = $u;
        }
    }
    $conn->close();
    return $users;
}

function getUser($conn, $id){

    $sql = "SELECT  *  FROM users WHERE user_id = '".$id."'";
    $user = null;
    if($res = $conn->query($sql)) {
        if ($res->num_rows == 1) {
            while ($row = $res->fetch_array()) {
                $u = new User($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[0]);
                $user = $u;
            }
        }
    }
    $conn->close();
    return $user;
}

function searchUser($conn, $input){

    $sql = "SELECT  *  FROM users WHERE user_id = '".$input."' || user_first_name = '"
        .$input."' || user_last_name = '".$input."' || user_email = '".$input."' || user_cell_number = '"
        .$input."' || user_position = '".$input."' || username = '".$input."' || password = '".$input."' || user_status = '".$input."'";
    $usersSearched = array();
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while($row = $res->fetch_array()){
            $u = new User($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[0]);
            $usersSearched[] = $u;
        }
    }
    $conn->close();
    return $usersSearched;
}

function addUser($conn, $user){
    $sql = "INSERT INTO users (user_first_name, user_last_name, user_email, user_cell_number, user_position, username, password, user_status, user_picture) 
            VALUES ('".$user->getUserFirstName()
        ."', '".$user->getUserLastName()."', '".$user->getUserEmail()
        ."', '".$user->getUserCellNumber()."', '".$user->getUserPosition()
        ."', '".$user->getUsername()."', '".$user->getPassword()."', '".$user->getStatus()."', '".$user->getUserPic()."') ";
    $conn->query($sql);
}

function updateUser($conn, $user){
    $sql = "UPDATE users SET
                user_first_name = '".$user->getUserFirstName()."',
                user_last_name = '".$user->getUserLastName() ."',
                user_email = '".$user->getUserEmail()."',
                user_cell_number = '".$user->getUserCellNumber()."',
                user_position = '".$user->getUserPosition()."',
                username = '".$user->getUsername()."',
                password = '".$user->getPassword()."',
                user_status = '".$user->getStatus()."',
                user_picture = '".$user->getUserPic()."'
         WHERE user_id = ".$user->getId();
    if(!$conn->query($sql)){
        echo $conn->mysqli_error($conn);//last error in SQL
    }
}

function verifyUser($conn, $username, $password){

    $sql = "SELECT  *  FROM users WHERE username = '".$username."' && password = '".$password."' && user_status = 'Active'";
    $user = null;
    $u = null;
    if($res = $conn->query($sql)) {
        if ($res->num_rows == 1) {
            while ($row = $res->fetch_array()) {
                if($row[7] == $password && $row[6] == $username)
                    $u = new User($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[0]);
                    $user = $u;
                    return $user;
            }
        }
    }
    $conn->close();
    return false;
}

function addLog($conn, $log){
    $sql = "INSERT INTO logs (username, chosen_module, action_taken, date_time, ip_address) 
            VALUES ('".$log->getUsername()
        ."', '".$log->getModuleName()."', '".$log->getActionDone()
        ."', '".$log->getDateTime()."', '".$log->getIpAddress()."') ";
    $conn->query($sql);
}


function getAllLogs($conn){

    $sql = "SELECT  *  FROM logs";
    $logs = array();
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while($row = $res->fetch_array()){
            $l = new Log($row[1], $row[2], $row[3], $row[4], $row[5], $row[0]);
            $logs[] = $l;
        }
    }
    $conn->close();
    return $logs;
}

function getLog($conn, $id){

    $sql = "SELECT  *  FROM logs WHERE log_id = '".$id."'";
    $log = null;
    if($res = $conn->query($sql)) {
        if ($res->num_rows == 1) {
            while ($row = $res->fetch_array()) {
                $l = new Log($row[1], $row[2], $row[3], $row[4], $row[5], $row[0]);
                $log = $l;
            }
        }
    }
    return $log;
}


function backup_database( $directory, $outname , $dbhost, $dbuser, $dbpass ,$dbname ) {

    // check mysqli extension installed
    if( ! function_exists('mysqli_connect') ) {
        die(' This scripts need mysql extension to be running properly ! please resolve!!');
    }
    $mysqli = @new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if( $mysqli->connect_error ) {
        print_r( $mysqli->connect_error );
        return false;
    }
    $dir = $directory;
    $result = '<p> Could not create backup directory on :'.$dir.' Please Please make sure you have set Directory on 755 or 777 for a while.</p>';
    $res = true;
    if( ! is_dir( $dir ) ) {
        if( ! @mkdir( $dir, 755 )) {
            $res = false;
        }
    }
    $n = 1;
    if( $res ) {
        $name     = $outname;
        # counts
        if( file_exists($dir.'/'.$name.'.sql.gz' ) ) {
            for($i=1;@count( file($dir.'/'.$name.'_'.$i.'.sql.gz') );$i++){
                $name = $name;
                if( ! file_exists( $dir.'/'.$name.'_'.$i.'.sql.gz') ) {
                    $name = $name.'_'.$i;
                    break;
                }
            }
        }
        $fullname = $dir.'/'.$name.'.sql.gz'; # full structures
        if( ! $mysqli->error ) {
            $sql = "SHOW TABLES";
            $show = $mysqli->query($sql);
            while ( $r = $show->fetch_array() ) {
                $tables[] = $r[0];
            }
            if( ! empty( $tables ) ) {
                //cycle through
                $return = '';
                foreach( $tables as $table )
                {
                    $result     = $mysqli->query('SELECT * FROM '.$table);
                    $num_fields = $result->field_count;
                    $row2       = $mysqli->query('SHOW CREATE TABLE '.$table );
                    $row2       = $row2->fetch_row();
                    $return    .=
                        "\n
-- ---------------------------------------------------------
--
-- Table structure for table : `{$table}`
--
-- ---------------------------------------------------------
".$row2[1].";\n";
                    for ($i = 0; $i < $num_fields; $i++)
                    {
                        $n = 1 ;
                        while( $row = $result->fetch_row() )
                        {

                            if( $n++ == 1 ) { # set the first statements
                                $return .=
                                    "
--
-- Dumping data for table `{$table}`
--
";
                                /**
                                 * Get structural of fields each tables
                                 */
                                $array_field = array(); #reset ! important to resetting when loop
                                while( $field = $result->fetch_field() ) # get field
                                {
                                    $array_field[] = '`'.$field->name.'`';

                                }
                                $array_f[$table] = $array_field;
                                // $array_f = $array_f;
                                # endwhile
                                $array_field = implode(', ', $array_f[$table]); #implode arrays
                                $return .= "INSERT INTO `{$table}` ({$array_field}) VALUES\n(";
                            } else {
                                $return .= '(';
                            }
                            for($j=0; $j<$num_fields; $j++)
                            {

                                $row[$j] = str_replace('\'','\'\'', preg_replace("/\n/","\\n", $row[$j] ) );
                                if ( isset( $row[$j] ) ) { $return .= is_numeric( $row[$j] ) ? $row[$j] : '\''.$row[$j].'\'' ; } else { $return.= '\'\''; }
                                if ($j<($num_fields-1)) { $return.= ', '; }
                            }
                            $return.= "),\n";
                        }
                        # check matching
                        @preg_match("/\),\n/", $return, $match, false, -3); # check match
                        if( isset( $match[0] ) )
                        {
                            $return = substr_replace( $return, ";\n", -2);
                        }
                    }

                    $return .= "\n";
                }
                $return =
                    "-- ---------------------------------------------------------
--
-- SIMPLE SQL Dump
-- 
-- nawa (at) yahoo (dot) com
--
-- Host Connection Info: ".$mysqli->host_info."
-- Generation Time: ".date('F d, Y \a\t H:i A ( e )')."
-- PHP Version: ".PHP_VERSION."
--
-- ---------------------------------------------------------\n\n
SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
SET time_zone = \"+00:00\";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
".$return."
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
# end values result
                @ini_set('zlib.output_compression','Off');
                $gzipoutput = gzencode( $return, 9);
                if(  @ file_put_contents( $fullname, $gzipoutput  ) ) { # 9 as compression levels

                    $result = $name.'.sql.gz'; # show the name

                } else { # if could not put file , automatically you will get the file as downloadable
                    $result = false;
                    // various headers, those with # are mandatory
                    //header('Content-Type: application/x-gzip'); // change it to mimetype
                    //header("Content-Description: File Transfer");
                    header('Content-Encoding: gzip'); #
                    header('Content-Length: '.strlen( $gzipoutput ) ); #
                    //header('Content-Disposition: attachment; filename="'.$name.'.sql.gz'.'"');
                    //header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
                    //header('Connection: Keep-Alive');
                    //header("Content-Transfer-Encoding: binary");
                    //header('Expires: 0');
                    //header('Pragma: no-cache');

                    echo $gzipoutput;
                }
            } else {
                $result = '<p>Error when executing database query to export.</p>'.$mysqli->error;

            }
        }
    } else {
        $result = '<p>Wrong mysqli input</p>';
    }

    if( $mysqli && ! $mysqli->error ) {
        @$mysqli->close();
    }
    return $result;
}



/**
 * Function to build SQL /Importing SQL DATA
 *
 * @param string $args as the queries of sql data , yopu could use file get contents to read data args
 * @param string $dbhost database host
 * @param string $dbuser database user
 * @param string $dbpass database password
 * @param string $dbname database name
 *
 * @return string complete if complete
 */
function mysqli_import_sql( $args , $dbhost, $dbuser, $dbpass ,$dbname ) {
    // check mysqli extension installed
    if( ! function_exists('mysqli_connect') ) {
        die(' This scripts need mysql extension to be running properly ! please resolve!!');
    }
    $mysqli = @new mysqli( $dbhost, $dbuser, $dbpass, $dbname );
    if( $mysqli->connect_error ) {
        print_r( $mysqli->connect_error );
        return false;
    }
    $querycount = 11;
    $queryerrors = '';
    $lines = (array) $args;
    if( is_string( $args ) ) {
        $lines =  array( $args ) ;
    }
    if ( ! $lines ) {
        return '' . 'cannot execute ' . $args;
    }
    $scriptfile = false;
    foreach ($lines as $line) {
        $line = trim( $line );
        // if have -- comments add enters
        if (substr( $line, 0, 2 ) == '--') {
            $line = "\n" . $line;
        }
        if (substr( $line, 0, 2 ) != '--') {
            $scriptfile .= ' ' . $line;
            continue;
        }
    }
    $queries = explode( ';', $scriptfile );
    foreach ($queries as $query) {
        $query = trim( $query );
        ++$querycount;
        if ( $query == '' ) {
            continue;
        }
        if ( ! $mysqli->query( $query ) ) {
            $queryerrors .= '' . 'Line ' . $querycount . ' - ' . $mysqli->error . '<br>';
            continue;
        }
    }
    if ( $queryerrors ) {
        return '' . 'There was an error on File: ' . $scriptfile . '<br>' . $queryerrors;
    }

    if( $mysqli && ! $mysqli->error ) {
        @$mysqli->close();
    }
    return 'complete dumping database !';
}
echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source</a>";
