<?php
session_start();

$_SESSION["name"]="yamazaki";
$_SESSION["email"]="test@test.jp";
$_SESSION["item"]="PHP基礎";

echo session_id();

?>