<?php

include_once 'shell_util.php';
include_once 'constants.php';

    $ip = $_GET['ipaddr'];
    $adminuser = "admin";  //Get these details from DB
    $adminpwd = "PlsletmeIN@123";
    $user = $_GET['user'];
    $userpwd = $_GET['pwd'];

    $fname = "/tmp/" . date("d-m-Y") . ".log";

    $log = "IP is " . $ip . " User name to create is " . $user . " Password is " . $userpwd;
    addLog($log);
   
    $cmd = "echo \"$adminpwd\" | sudo -Sk useradd -m -s /bin/bash $user";
    $cmd_toexec = "sshpass -p \"$adminpwd\" ssh -tt -o StrictHostKeyChecking=no $adminuser@$ip \"$cmd\" 2>&1 >> $fname";
    executeCmd($cmd_toexec);

    $cmd = "echo \"$adminpwd\" | sudo -Sk bash -c 'echo \"$user:$userpwd\" | sudo chpasswd'";
    $cmd_toexec = "sshpass -p \"$adminpwd\" ssh -tt -o StrictHostKeyChecking=no $adminuser@$ip \"$cmd\" 2>&1 >> $fname";
    executeCmd($cmd_toexec);

?>

