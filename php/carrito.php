<?php
$datos=$_POST["datos"];
$carrito=stdClass();
$carrito = json_decode($datos);

$numero = $carrito->$numero;
$fechaCreacion = $carrito->$fechaCreacion;
$listaArticulos = $carrito->$listaArticulos;

$informacionPago=$_POST["informacionPago"];
$usuario=$informacionPago->$usuario;
$precioTotal=$informacionPago->$precioTotal;
//insertar un pedido
// idPedido,Fecha,Usuario,Estado,PrecioTotal
$db=mysql_connect("localhost","root","frodo2013") or die("Connection Error".mysql_error());
mysql_select_db("proyecto1_tienda_servidor") or die("Error Connection to DB".mysql_error());

$SQL = "INSERT INTO `proyecto1_tienda_servidor`.`pedidos` 
        (`idPedido`, `Fecha`, `Usuario`, `Estado`, `PrecioTotal`) 
VALUES (NULL,'".$fechaCreacion."','".$usuario."','ESPERA','".$listaArticulos."');";

$result=mysql_query($SQL) or die("Couldnt execute query.".mysql_error());
//insertar un detallePedido
//idPedido,IdProducto,Unidades,Precio
foreach ($listaArticulos as &$articulo) {
    $id=$articulo->$id;
    $nombre=$articulo->$nombre;
    $precio=$articulo->$precio;
    $unidades=$articulo->$unidades;
    
$SQL2 = "INSERT INTO `proyecto1_tienda_servidor`.`detallepedidos` 
        (`idPedido`, `idProducto`, `Unidades`, `Precio`) 
        VALUES (NULL, '".$id."', '".$unidades."', '".$precio."');";
$result2=mysql_query($SQL2) or die("Couldnt execute query.".mysql_error());
}

?>
