<?php

require_once 'config/config.php';
require_once 'includes/activity-logger.php';

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $action = tria($_POST['action']??'');

    if($action === '')
}