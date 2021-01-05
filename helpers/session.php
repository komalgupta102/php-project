<?php
session_start();
if(isset($_GET['user_id'])){
	$_SESSION['user_id'] = $_GET['user_id'];
}
return true;