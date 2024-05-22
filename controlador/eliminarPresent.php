<?php
include '../modelo/modeloPresent.php';
$presentacion = new Presentacion();

$id = $_POST['id'];
$presentacion->eliminar($id);