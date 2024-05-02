<?php
//Este archivo hace enfasis cuando lo usamos en el boton cerrar sesion y regresa al index que es el login 

session_start();
session_destroy();
header('Location:../index.php');
