<?php
//importamos la libreria de Flight
require 'flight/Flight.php';
//importamos la libreria de redBean
require 'rb.php';
//conecta a la B.D
R::setup('mysql:host=localhost;dbname=washablecat','root','');


Flight::route('/', function () {
    echo"<h1>API de Usuarios</h1>";
});


//cramos una ruta para ver los Usuarios
//SELEC * FROM usuario
//usaremos el GET

Flight::route('GET /usuarios', function ()
{ //obtenemos TODOS los datos de
  //la tabla de usuarios
$usuarios = R::findAll('usuarios');

//mandamos el resultado como JSON
Flight::json($usuarios);

});

Flight::route('POST /usuarios', function()
{
   //obtenemos TODOS los datos
   //La tabla Usuarios

   $usuarios=R::dispense('usuarios');

   $usuarios->nombre=(Flight::request()->data->nombre);
   $usuarios->usuario=(Flight::request()->data->usuario);
   $usuarios->clave=(Flight::request()->data->clave);

   $id=R::store($usuarios);

   //mandamos el resultado como JSON
   Flight::json("usuario creado con exito"); 
  
});


   //Actualizar Usuarios
   Flight::route('PUT /usuarios', function(){

    $id=(Flight::request()->data->id);
    $usuarios=R::load( 'usuarios', $id );
    $usuarios->usuario = (Flight::request()->data->usuario);
    $usuarios->clave = (Flight::request()->data->clave);
    $usuarios->nombre = (Flight::request()->data->nombre);
    R::store($usuarios);
    Flight::json($usuarios);
    

});


//Eliminar Usuarios
  Flight::route('DELETE /usuarios', function (){
    $id=(Flight::request()->data->id);
    $usuarios=R::load( 'usuarios', $id);
    R::trash( $usuarios );
    Flight::json(['Usuario Eliminado']);
});


Flight::start();

?>