<?php
$carritoJson=$_POST["datos"];
$carrito= new stdClass();
$carrito = json_decode($carritoJson);

$numero = $carrito->numero;//guardamos en la variable numero el contenido de numero del carrito
$fechaCreacion = $carrito->fechaCreacion;//guadamos la fecha creacion del carrito
$listaArticulos = $carrito->listaArticulos;//guardamos la lista de articulos del carrito

//insertar un pedido
// idPedido,Fecha,Usuario,Estado,PrecioTotal
$db=mysql_connect("localhost","root","") or die("Connection Error".mysql_error());
mysql_select_db("proyecto1_tienda_servidor") or die("Error Connection to DB".mysql_error());

$SQL = "INSERT INTO `proyecto1_tienda_servidor`.`pedidos` 
        (`idPedido`, `Fecha`, `Usuario`, `Estado`, `PrecioTotal`) 
VALUES (NULL,'2014-12-12','1','ESPERA','66666');";
$result=mysql_query($SQL) or die("Couldnt execute query.".mysql_error());

$SQL0 = "select max(idPedido) as maximo from pedidos where Usuario = 1;";
$result0=mysql_query($SQL0) or die("Couldnt execute query.".mysql_error());
$fila = mysql_fetch_array($result0,MYSQL_ASSOC);
$idpedido = $fila["maximo"];

//insertar un detallePedido
//idPedido,IdProducto,Unidades,Precio
foreach ($listaArticulos as $articulo) {//realizar insert por cada articulo
    $id=$articulo->id;//cogemos el id del articulo
    $precio=$articulo->precio;//cogemos el precio del articulo
    $unidades=$articulo->unidades;//cogemos la cantidad de unidades del articulo
$SQL2 = "INSERT INTO `proyecto1_tienda_servidor`.`detallepedidos` 
        (`idPedido`, `idProducto`, `Unidades`, `Precio`) 
        VALUES ('".$idpedido."', '".$id."', '".$unidades."', '".$precio."');";
$result2=mysql_query($SQL2) or die("Couldnt execute query.".mysql_error());
}
//select max(idpedido) as maximo from pedidos where idusuario = idusuario;
?>
