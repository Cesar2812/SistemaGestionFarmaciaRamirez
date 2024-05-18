<?php
include '../modelo/modeloLab.php';
$laboratorio = new Laboratorio();


$id=$_POST['id'];
$nombre=$_POST['nombre'];
$telefono=$_POST['telefono'];

$laboratorio->editar($id, $nombre, $telefono);