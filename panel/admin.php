<?php
session_start();

if (!isset($_SESSION['admin.php'])){
    header('Location: login.php');
    exit;
    
}
require_once 'conexion.php';
?>