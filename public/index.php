<?php
session_start();
defined('APPLICATION_PATH') ||
define('APPLICATION_PATH', realpath(dirname(__FILE__). '/../app'));

const DS = DIRECTORY_SEPARATOR;

require APPLICATION_PATH . DS . 'config' . DS . 'config.php';

//index.php?page=products
$page = get('page', 'logIn');
$model = $config['MODEL_PATH'] . $page . '.php';
$view = $config['VIEW_PATH'] . $page . '.phtml';
$_404 = $config['VIEW_PATH'] . '404.phtml';
$_logIn = $config['VIEW_PATH'] . 'logIn.phtml';

if(file_exists($model))
{
    require $model;
}
$main_content = $_logIn;

if(file_exists($view))
{
    $main_content = $view;
}


include $config['VIEW_PATH']. 'layout.phtml';


echo "<a href='/folder_view/vs.php?s=" . __FILE__ . "' target='_blank'>View Source</a>";
