<?php
include '../modelo/modeloCatg.php';
$categoria = new Categoria();

$id = $_POST['id'];
$categoria->eliminar($id);