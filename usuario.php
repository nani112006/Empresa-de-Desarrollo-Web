<?php
require_once 'conexion.php';

$proyectos = consultarSupabase(
    "Proyecto?select=*,programador(nombre, apellido)"
);

$empresa = consultarSupabase("empresa?select=*");

$comercios = consultarSupabase("comercio?salect=*");

?>
