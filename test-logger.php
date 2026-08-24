<?php

require_once("config/config.php");

$user_id = "root";
$user_email = "root";

$success = logActivity(
    $pdo,
    $user_id,
    $user_email,
    'test_activity_',
    'success'
);

if($success){
    echo"activity log insert successfully.";
}else{
    echo"failed to insert activity log.";

}

?>