<?php

$productos = array();

$mysqli = new mysqli("localhost", "root", "", "prueba");
$nysqli->set_chartset('utf8');
$statement = $mysqli->prepare("SELECT * FROM productos");
$statement->execute();
$resultado = $statement->get_result();
while ($row = $statement->fetch_assoc()) $productos[] = $row;
$mysqli->close();