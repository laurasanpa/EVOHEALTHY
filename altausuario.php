<?php

//Creamos un objeto de la clase usuario con los datos obtenidos en el formulario.

require_once ('usuarioClass.php');

//Manejamos la elección del sexo.
if($sex["Hombre"]==ON)
    $aux="Hombre";
else if($sex["Mujer"]==ON)
    $aux="Mujer";
else
    $aux="Otro";

//Creamos el array con los datos del nuevo usuario.
$datos=array(
    "nombre"=>$_POST["nombre"],
    "apellidos"=>$_POST["apellidos"],
    "peso"=>$_POST["peso"],
    "altura"=>$_POST["altura"],
    "sexo"=>$aux,
    "password"=>$_POST["password"],
    "email"=>$_POST["email"],
);
//Creamos un nuevo usuario con los datos obtenidos. 
$usuario = new Usuario($datos);
//Insertamos el usuario en la base de datos.
$usuario.insertarUsuario();


?>