<?php

require_once '../bootstrap.php';

//Connect to database
db_connect();

//get information
session_start();
$session_id = session_id();
$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_SERVER['HTTP_USER_AGENT'])) { $user_agent = $_SERVER['HTTP_USER_AGENT']; } else { $user_agent = ''; }
$time = time(); //Curent time
$timeout = $time - 300; //5 minutes

//add or update user in online list
if(mysql_num_rows(mysql_query("SELECT `session_id` FROM `online` WHERE `session_id` = '".$session_id."'"))) {
	//update last active time
	mysql_query("UPDATE `online` SET `time` = '".$time."' WHERE `session_id` = '".$session_id."'");
}
else {
	//add users session to databse
	mysql_query("INSERT INTO `online` VALUES ('".$session_id."', '".$ip."', '".$user_agent."', '".$time."')");
}

//delete sessions that have been inactive for timeout period
mysql_query("DELETE FROM `online` WHERE `time` < '".$timeout."'");

//Get number online
$online = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `online`"));
echo number_format($online[0]);
