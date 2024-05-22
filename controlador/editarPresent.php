<?php
include '../modelo/modeloPresent.php';
$presentacion = new Presentacion();

$id = $_POST['id'];
$descripcion = $_POST['descripcion'];


$presentacion->editar($id, $descripcion);