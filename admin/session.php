<?php
session_start();
if (!isset($_SESSION['id_admin']) || (trim($_SESSION['id_admin']) == '')) {
    header("location: index");
    exit();
}
$session_id=$_SESSION['id_admin'];

?>