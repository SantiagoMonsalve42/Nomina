<!DOCTYPE html><!-archivo html pantalla de inicio->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomina</title> <!–titulo de la pestaña –> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"><!-inclusion de boostrap4.5 en el archivo->
    <link rel="icon" href="./imagenes/icono1.ico"><!-icono para la pestaña del index->
</head>
<body background="./imagenes/slashes.png"><!-fondo de la pagina->
    <div class="container"><!-creacion de contendor->
     <h1 style="text-align: center; color: aliceblue;">SISTEMA DE GESTION DE NOMINA</h1><!-titulo de la pagina->
     <div class="row"><!-nueva fila para usar sistema de rejilla en boostrap ->
         <div class="col-3"><!-reacion de columna tamaño 3->
            <form action="./index.php" method="POST"><!-formulario que viaja a index.php por el metodo POST->
                <div class="form-group">
                  <label style="color: aliceblue;">DIGITE CANTIDAD DE USUARIOS:</label>
                  <input type="number" class="form-control" name="cantidad" required><!-INPUT PARA SABER LA CANTIDAD DE USUARIOS->
                 </div>
                <input type="submit" name="CALCULAR" value="CALCULAR" class="btn btn-primary" ><!-BOTON PARA ENVIAR LOS DATOS->
              </form>
         </div>
         <?php
          if(isset($_POST['CALCULAR']) && isset($_POST['cantidad'])){//se verifica que los datos del formulario de arriba hayan llegado correctamente
            $tam=$_POST['cantidad'];  //variable para saber la cantidad de usuarios a registrar de forma dinamica
            echo "<div class='col-9'>
              <form action='./generartabla.php' method='POST'>
                  <div class='form-group'>";//formulario que viaja por el metodo post a generatabla.php
                  for($i=0;$i<$tam;$i++){//for para leer la cantidad de ususarios dinamicamente
                     $imostrar=$i+1;//variable para mostrar la posicion del usuario que se esta leyendo, se pone +1 para que nunca muestre usuario 0
                    echo "<label style='color: aliceblue;'>Nombre usuario ".$imostrar.":</label>".//formulario para enviar los datos necesarios para calcular nuestra nomina
                    "<input type='text' class='form-control' name='nombre[]'>".//aqui hacemos usos de arreglos para enviar datos ordenadamente
                    "<input type='hidden' value='".$tam."' name='tamano' required>
                    <label style='color: aliceblue;'>Sueldo basico usuario: ".$imostrar.":</label>
                    <input type='number' min='877803' class='form-control' name='salario[]' required> 
                    <label style='color: aliceblue;'>Comisiones usuario: ".$imostrar.":</label>
                    <input type='number' min='0' class='form-control' name='comisiones[]' required> 
                    <label style='color: aliceblue;'>Horas extras y recargos usuario ".$imostrar.":</label>
                    <input type='number' min='0' class='form-control' name='hextra[]' required>
                    <label style='color: aliceblue;'>Dias laborados al mes usuario ".$imostrar.":</label>
                    <input type='number' min='0' max='30' class='form-control' name='dlaborados[]' required>
                    <label style='color: aliceblue;'>Meses trabajados del año usuario ".$imostrar.":</label>
                    <input type='number' min='0' max='12' class='form-control' name='mlaborados[]' required>
                    <label style='color: aliceblue;'>Tipo riesgo ARL usuario ".$imostrar.":</label>
                    <select name='ARL[]' class='custom-select' required>
                      <option value='R1'>CLASE I</option> 
                      <option value='R2'>CLASE II</option>
                      <option value='R3'>CLASE III</option>
                      <option value='R4'>CLASE IV</option>
                      <option value='R5'>CLASE V</option>
                    </select><br><br><br>
                     ";
                   }
                 echo "</div> 
                 <input type='submit' value='MOSTRAR' class='btn btn-primary' required><br>
                 <label style='color: aliceblue;'>Elaborado por Andres Santiago Monsalve Salinas® </label>
                 </form>
            </div>";
          }
         ?>
     </div>
    </div>
  
</body>
</html>