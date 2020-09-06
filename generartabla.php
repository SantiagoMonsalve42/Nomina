
<?php
//se reciben los datos que llegaron del formulario ubicado en el archivo index.php
$nom=$_POST['nombre'];
$sal=$_POST['salario'];
$hextra=$_POST['hextra'];
$comisiones=$_POST['comisiones'];
$dlaborados=$_POST['dlaborados'];
$mlaborados=$_POST['mlaborados'];
$arl=$_POST['ARL'];
$tam=$_POST['tamano'];
//se valida que el tamaño halla llegado bien
if(isset($_POST['tamano'])){?>
<!DOCTYPE html>
<html lang=es>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Reportes</title><!-titulo de la pagina->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' 
    integrity='sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk' crossorigin='anonymous'><!-inclusion de boostrap para estilos en nuestro proyecto->
    <link rel='icon' href='./imagenes/icono1.ico'><!-icono para la pestaña->
</head>

<body background='./imagenes/slashes.png'><!-fondo de la pagina->
<div class='container'><!-vuelve nuestro contenido responsivo->
<div>
<h2 style='text-align: center; color: aliceblue;' >REPORTES GENERADOS</h2><!-titulo de la pagina->
<div>
<table style="border-radius:15px;" class='table table-dark'><!-creacion de una tabla para mostrar los datos que llegaron->
<thead>
  <tr><!-se establecen cuales seran las cabeceras de la tabla, las cuales usaremos de referencia para mostrar nuestros datos->
    <th scope='col'>NOMBRE</th>
    <th scope='col'>SUELDO</th>
    <th scope='col'> H.EXTRA</th>
    <th scope='col'>COMISION</th>
    <th scope='col'>DIAS LABORADOS/MES</th>    
    <th scope='col'>MESES LABORADOS/AÑO</th>
    <th scope='col'>ARL</th>
  </tr>
</thead>
<tbody>
<?php
for($i=0;$i<$tam;$i++){//arreglo para mostrar los datos que llegaron dinamicamente
  echo "<tr><td>".$nom[$i]."</td><td>".$sal[$i]."</td>
  <td>".$hextra[$i]."</td><td>".$comisiones[$i]."</td>
  <td>".$dlaborados[$i]."</td><td>".$mlaborados[$i]."</td>
  <td>".$arl[$i]."</td></tr>";
}
echo "</tbody>
</table>";
?>
<div class="row">
<div class='col-5'>
</div>
<div class='col-2'>
<form action="./generarpdf.php" method="POST"><!-se crea un formulario auxiliar para enviar los datos a generarpdf.php por metodo POST->
<?php for($i=0;$i<$tam;$i++){?><!-se llenan los datos dinamicante haciendo uso d eun ciclo->
<input type="hidden" name="nombre[]" value="<?php echo $nom[$i];?>"><!-de esta forma se envia el dato en la posicion $i segun el arreglo que se necesite->
<input type="hidden" name="salario[]" value="<?php echo $sal[$i];?>"><!-son datos de tipos hidden ya que no es necesario que el usuario final vea este proceso->
<input type="hidden" name="hextra[]" value="<?php echo $hextra[$i];?>">
<input type="hidden" name="comisiones[]" value="<?php echo $comisiones[$i];?>">
<input type="hidden" name="dlaborados[]" value="<?php echo $dlaborados[$i];?>">
<input type="hidden" name="mlaborados[]" value="<?php echo $mlaborados[$i];?>">
<input type="hidden" name="ARL[]" value="<?php echo $arl[$i];?>">
<input type="hidden" name="tamano" value="<?php echo $_POST['tamano'];?>">
<?php }?>
<input type='submit' value='GENERAR PDF' class='btn btn-primary' required><!-este boton si se muestra y es el encargado de hacer enviar nuestros datos a generarpdf.php->
<a href="./index.php" style="text-align: center; width:130px; border-radius:15px; margin-top: 1em;" class="btn btn-primary">VOLVER</a> <!-boton para volver al index.html->        
</form>
</div>
</div>        
</body>
</html>
<?php
}
else  //si no llego la variable tamaño correctamente se redirige al index.html
{
    header('Location: http://localhost/nomina');
}
?>

