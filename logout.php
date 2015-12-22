<?php
session_start();
unset($_SESSION);
session_destroy();

$referrer = mysql_real_escape_string($_SERVER['HTTP_REFERER']);
header('location:' . $referrer);