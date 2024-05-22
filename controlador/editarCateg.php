<?php
include '../modelo/modeloCatg.php';
$categoria = new Categoria();

$id = $_POST['id'];
$descripcion = $_POST['descripcion'];


$categoria->editar($id, $descripcion);