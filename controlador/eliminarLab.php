<?php
include '../modelo/modeloLab.php';
$laboratorio = new Laboratorio();

$id = $_POST['id'];
$laboratorio->eliminar($id);