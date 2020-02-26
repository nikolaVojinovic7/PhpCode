<?php

$config = [
    'MODEL_PATH' => APPLICATION_PATH . DS . 'model' . DS,
    'VIEW_PATH' => APPLICATION_PATH . DS . 'view' . DS,
    'LIB_PATH' => APPLICATION_PATH . DS .  'lib' . DS,
    'DATA_PATH' => APPLICATION_PATH . DS .  'data' . DS,
];

$conn = new mysqli("localhost", "f9181089_person",
    "person","f9181089_mydatabase");
if($conn->connect_error) {
    die(mysqli_error($conn));
}

require $config['LIB_PATH'] . 'functions.php';

echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source</a>";