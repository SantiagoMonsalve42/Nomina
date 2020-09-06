<?php

$nom=$_POST['nombre'];
$sal=$_POST['salario'];
$hextra=$_POST['hextra'];
$comisiones=$_POST['comisiones'];
$dlaborados=$_POST['dlaborados'];
$mlaborados=$_POST['mlaborados'];
$arl=$_POST['ARL'];
$tam=$_POST['tamano'];//HASTA ACA SE RECIBEN TODAS LAS VARIABLE QUE LLEGAN DEL GENERARTBALA.PHP
$subtrans=102854;//VARIABLE QUE ALMACENA EL VALOR DEL SUBCIDIO DE TRANSPORTE
$totaldevengado=0;//VARIBLE DEL TOTAL DEVENGADO
$netoapagar=0;//VARIABLE TOTAL A PAGAR A EMPLEADO
$totaldeducciones=0;//VARIABLE PARA EL TOTAL DEDECCIONES
$seguridadsocial=0;//VARIABLE PARA ALMACENAR VALOR DE SUGURIDAD SOCIAL
$aportesparafiscales=0;//VARIABLE APORTES PARA FISCALES
$prestacionessociales=0;//VARIABLE PARA ALMACENAR VALOR DE PRESTACIONES SOCIALES
$totalapropiaciones=0;//VARIABLE PARA ALMACENAR VALOR DE APROPIACIONES DE NOMINA
$totalnomina=0;//VARIABLE PARA ALMACENAR EL VALOR TOTAL DE LA NOMINA DE 1 EMPLEADO
$totaltnominas=0;//VARIABLE PARA ALMACENAR EL VALOR TOTAL DE LAS NOMINAS DE N EMPLEADOS
if(isset($_POST['tamano'])){//VERIFICA QUE LA $TAMANO HALLA LLEGADO BIEN YA QUE ES NECESARIA PARA ESTE PROCESO
require 'fpdf/fpdf.php';//INSTANCIA DE LA LIBRERIA QUE VAMOS A USAR PARA CREAR NUESTRO PDF
$pdf=new FPDF();//SE CREA UN NUEVO PDF
$pdf->AddPage();//SE AÑADE UNA PAGINA
$pdf->SetFillColor(255, 215, 0);//SE CREA UN COLOR, EN ESTE CASO AMARRILLO Y QUE NOS SERVIRA MAS ADELANTE
$pdf->SetFont('Arial','B',8);//SE ESTABLECE LA FUENTE, EL TAMAÑO
for($i=0;$i<$tam;$i++){  //SE RECORRE UN FOR PARA REALIZAR EL PROCESO DIANMICAMENTE
    $imostrar=$i+1;//VARIABLE PARA MOSTRAR QUE USAURIO SE ESTA REALIZANDO LA NOMINA
$pdf->Cell(100,5,'NOMINA EMPLEADO #'.$imostrar,0,1,'L'); //SE MUSTRA EN COMO TITULO EN NUMERO DE USUARIO Y UN SALTO DE LINA
$pdf->Cell(190,5,'NOMBRE: '.$nom[$i],1,1,'L');//NOMBRE DE USAURIO EN UNA CELDA, ALINEADO A LA IZQUIERDA Y UN SALTO DE LINEA
$pdf->Cell(190,5,'DEVENGADO',1,1,'C');//TITULO EN UNA CELDA, CENTRADO Y CON SALTO DE LIENA
$pdf->Cell(95,5,'SUELDO BASICO:',1,0,'L');//CELDA CON SUBTITULO ALINEADO A LA IZQUIERDA, SIN SALTO DE LINEA Y ALINEADO A LA IZQUIERDA
$pdf->Cell(95,5,'$'.$sal[$i],1,1,'C');//SE MUESTRA UNA CELDA EL SALARIO CENTRADO, Y CON SALTO DE LINEA
$pdf->Cell(95,5,'COMISIONES:',1,0,'L');//CELDA CON SUBTITULO ALINEADO A LA IZQUIERDA, SIN SALTO DE LINEA Y ALINEADO A LA IZQUIERDA
if($comisiones[$i] == 0){ // EVALUA SI LAS COMISIONES SON IGUALES A CERO
$pdf->Cell(95,5,'$0',1,1,'C');//SI ES CERO SE IMPRIME $0 DENTRO DE UNA CELDA Y UN SALTO DE LIENA 
}else{
$pdf->Cell(95,5,'$'.$comisiones[$i],1,1,'C');//SI NO ES CERO SE IMPRIME EL VALOR DENTRO DE UNA CELDA Y UN SALTO DE LINEA
}
$pdf->Cell(95,5,'HORAS EXTRAS Y RECARGOS:',1,0,'L');
if($hextra[$i] == 0){// EVALUA SI LAS HEXTRA SON IGUALES A CERO
$pdf->Cell(95,5,'$0',1,1,'C');//SI ES CERO SE IMPRIME $0 DENTRO DE UNA CELDA Y UN SALTO DE LIENA 
}else{
$pdf->Cell(95,5,'$'.$hextra[$i],1,1,'C');//SI NO ES CERO SE IMPRIME EL VALOR DENTRO DE UNA CELDA Y UN SALTO DE LINEA
}
$pdf->Cell(95,5,'DIAS LABORADOS MES:',1,0,'L');
if($dlaborados[$i] == 0){// EVALUA SI LAS DLABORADOS SON IGUALES A CERO
$pdf->Cell(95,5,'0',1,1,'C');//SI ES CERO SE IMPRIME $0 DENTRO DE UNA CELDA Y UN SALTO DE LIENA 
}else{
$pdf->Cell(95,5,$dlaborados[$i],1,1,'C');//SI NO ES CERO SE IMPRIME EL VALOR DENTRO DE UNA CELDA Y UN SALTO DE LINEA
}
$pdf->Cell(95,5,'MESES TRABAJADOS:',1,0,'L');
if($mlaborados[$i] == 0){// EVALUA SI LAS MLABORADOS SON IGUALES A CERO
$pdf->Cell(95,5,'0',1,1,'C');//SI ES CERO SE IMPRIME $0 DENTRO DE UNA CELDA Y UN SALTO DE LIENA 
}else{
$pdf->Cell(95,5,$mlaborados[$i],1,1,'C');//SI NO ES CERO SE IMPRIME EL VALOR DENTRO DE UNA CELDA Y UN SALTO DE LINEA
}
$pdf->Cell(95,5,'TIPO RIESGO ARL:',1,0,'L');
$pdf->Cell(95,5,$arl[$i],1,1,'C');//se imprime dentro de una celda el tipo de arl seleccionado
$pagarbasico;//variable para almacenar el salrio basico segun los dias que trabajo
if($dlaborados[$i] == 0){//si trabajo todo el mes 
    $pagarbasico=$sal[$i];//el salario se mantien igual
}else{//sino
    $dia=$sal[$i]/30;//se calcula el valor por dia de trabajo segun su salario basico
    $pagarbasico=$dia*$dlaborados[$i];//se calcula el salario basico teniendo en cuenta el valor del dia trabajdo y la cantidad de dias que trabajo
}
$pdf->Cell(95,5,'SUBSIDIO DE TRANSPORTE',1,0,'L');
if($pagarbasico <= 1755606){ //SI ES BENEFICIARIO DE SUBSIDIO DE TRANSPORTE 
$totaldevengado=$pagarbasico+$comisiones[$i]+$hextra[$i]+$subtrans;//SI LO ES SE LE AÑADE AL TOTAL DEVENGADO, INCLUIDO EL BASICO, LAS COMISIONES Y HORAS EXTRAS
$pdf->Cell(95,5,'$'.$subtrans,1,1,'C');//se imprime el valor del subsidio de tranporte dentro de una celda y centrado
}else{
$totaldevengado=$pagarbasico+$comisiones[$i]+$hextra[$i];//SI no LO ES no SE LE AÑADE AL TOTAL DEVENGADO, INCLUIDO EL BASICO, LAS COMISIONES Y HORAS EXTRAS
$pdf->Cell(95,5,'$0',1,1,'C'); 
}
$pdf->Cell(95,5,'TOTAL DEVENGADO:',1,0,'L');
$pdf->Cell(95,5,'$'.round($totaldevengado),1,1,'C',1);//SE MUESTRA EL TOTAL EN UNA CELDA Y SE REDONDE PARA NO MOSTRAR PARTE DECIMAL
$pdf->Cell(190,5,'DEDUCCIONES',1,1,'C');//MODULO PARA DEDUCCIONES
$aportesalud=round($totaldevengado*0.04);//APORTE A LA SALUD ES EL 4% DEL TOTAL DEVENGADO, SE REDONDEA PARA EFECTOS PRACTICOS
$aportepension=round($totaldevengado*0.04);//APORTE A LA PENSION ES EL 4% DEL TOTAL DEVENGADO, SE REDONDEA PARA EFECTOS PRACTICOS
$totaldeducciones=$aportepension+$aportesalud;//TOTAL DE DEDUCCIONES ES LA SUMA DEL VALOR DE SALUD Y PENSION
$netoapagar=round($totaldevengado-$totaldeducciones);//VALOR A PAGAR A EMPLEADO ES LA RESTA ENTRE LO DEVENGADO Y LAS DECCIONES
//SE IMPRIMEN LOS DATOS QUE OBTUVIMOS ANTERIORMENTE
$pdf->Cell(95,5,'APORTE A LA SALUD:',1,0,'L');
$pdf->Cell(95,5,'$'.$aportesalud,1,1,'C');
$pdf->Cell(95,5,'APORTE A LA PENSION:',1,0,'L');
$pdf->Cell(95,5,'$'.$aportepension,1,1,'C');
$pdf->Cell(95,5,'TOTAL DEDUCCIONES:',1,0,'L');
$pdf->Cell(95,5,'$'.$totaldeducciones,1,1,'C',1);
$pdf->Cell(95,5,'TOTAL A PAGAR:',1,0,'L');
$pdf->Cell(95,5,'$'.$netoapagar,1,1,'C',1);
//MODULO APROPIAICONES DE NOMINA, SE DIVIDE EN SEGURIDAD SOCIAL, APORTES PARAFISCALES Y PRESTACIONES SOCIALES
//ESTA PARTE HACE REFENCIA A LO QUE LA EMPRESA PAGA POR CADA EMPLEADO
$pdf->Cell(190,5,'APROPIACIONES DE NOMINA',1,1,'C');
$pdf->Cell(95,5,'SEGURIDAD SOCIAL',1,0,'C');//SE CREA COLUMNA DE SEGURIDAD SOCIAL
$pdf->Cell(95,5,'APORTES PARAFISCALES:',1,1,'C');//SE CREA COLUMNA DE APORTES PARAFISCALES
$pdf->Cell(40,5,'SALUD:',1,0,'L');
$pdf->Cell(55,5,'$'.round($totaldevengado*0.08),1,0,'C');//la salud es el 8% sobre el total devengado
$pdf->Cell(40,5,'SENA:',1,0,'L');
$pdf->Cell(55,5,'$'.round($totaldevengado*0.02),1,1,'C');//el sena es el 2% sobre el total devengado
$pdf->Cell(40,5,'PENSION:',1,0,'L');
$pdf->Cell(55,5,'$'.round($totaldevengado*0.12),1,0,'C');//la pension es el 12% sobre el total devengado
$pdf->Cell(40,5,'CAJAS DE COMPENSACION:',1,0,'L');
$pdf->Cell(55,5,'$'.round($totaldevengado*0.04),1,1,'C');//la caja de compensacion es el 4% sobre el total devengado
$valorarl=0;//variable para almacenar el valor a pagar 
switch ($arl[$i]) {//el valor del arl se calcula segun el tipo de reigo que tenga el empleado
    case 'R1':
         $valorarl=round($totaldevengado*0.00522);  
        break;
        case 'R2':
            $valorarl=round($totaldevengado*0.01044);
            break;
            case 'R3':
                $valorarl=round($totaldevengado*0.02436);
                break;
                case 'R4':
                    $valorarl=round($totaldevengado*0.04350);
                    break;
                    case 'R5':
                        $valorarl=round($totaldevengado*0.06960);
                        break;
    default:
    $valorarl=0;
        break;
}
$pdf->Cell(40,5,'ARL:',1,0,'L');
$pdf->Cell(55,5,'$'.$valorarl,1,0,'C');
$pdf->Cell(40,5,'ICBF:',1,0,'L');
$pdf->Cell(55,5,'$'.round($totaldevengado*0.03),1,1,'C');//ICBF SE CALCULA CON EL 3% SOBRE EL TOTAL DEVENGADO

$seguridadsocial=round($totaldevengado*0.08)+round($totaldevengado*0.12)+$valorarl;//SE CALCULA EL TOTAL DE SEGURIDAD SOCIAL
$aportesparafiscales=round($totaldevengado*0.02)+round($totaldevengado*0.04)+round($totaldevengado*0.03);//SE CALCULA EL TOTAL DE APORTES PARAFISCALES
//SE IMPRIMEN LOS TOTALES QUE HAYAMOS EN LAS 2 LINEAS ANTERIORES
$pdf->Cell(40,5,'TOTAL:',1,0,'L');
$pdf->Cell(55,5,'$'.round($seguridadsocial),1,0,'C',1);
$pdf->Cell(40,5,'TOTAL:',1,0,'L');
$pdf->Cell(55,5,'$'.round($aportesparafiscales),1,1,'C',1);
//MODULO DE PRESTACIONES SOCIALES
$pdf->Cell(190,5,'PRESTACIONES SOCIALES',1,1,'C');
$cesantias=round(($dlaborados[$i]*$totaldevengado)/360);
$pdf->Cell(50,5,'CESANTIAS MES:',1,0,'L');
$pdf->Cell(140,5,'$'.$cesantias,1,1,'C');
$primaservicios=round(($dlaborados[$i]*$totaldevengado)/360);
$pdf->Cell(50,5,'PRIMA DE SERVICIOS:',1,0,'L');
$pdf->Cell(140,5,'$'.$primaservicios,1,1,'C');
$interes=round(($dlaborados[$i]*$cesantias*0.12)/360);
$pdf->Cell(50,5,'INTERES CESANTIAS:',1,0,'L');
$pdf->Cell(140,5,'$'.$interes,1,1,'C');
$vacaciones=0;
if($dlaborados>=30){
$vacaciones=round(($sal[$i]*30)/720);
}else{
$vacaciones=round(($sal[i]*$dlaborados[$i])/720);
}
$pdf->Cell(50,5,'VACACIONES MES:',1,0,'L');
$pdf->Cell(140,5,'$'.$vacaciones,1,1,'C');
$prestacionessociales=round($cesantias+$primaservicios+$interes+$vacaciones);
$pdf->Cell(50,5,'TOTAL:',1,0,'L');
$pdf->Cell(140,5,'$'.$prestacionessociales,1,1,'C',1);
$pdf->Cell(190,5,'',1,1,'C');
$pdf->Cell(80,5,'TOTAL APROPIACIONES DE NOMINA:',1,0,'L');
$totalapropiaciones=round($seguridadsocial+$aportesparafiscales+$prestacionessociales);
$pdf->Cell(110,5,'$'.$totalapropiaciones,1,1,'C',1);
$pdf->Cell(190,5,'',1,1,'C');
$pdf->Cell(80,5,'VALOR TOTAL NOMINA:',1,0,'L');
$totalnomina=round($totaldevengado+$totalapropiaciones);
$totaltnominas+=$totalnomina;
$pdf->Cell(110,5,'$'.$totalnomina,1,1,'C',1);
$pdf->Ln();
}
$pdf->Ln();
$pdf->Cell(190,5,' GLOBAL NOMINAS',1,1,'C');
$pdf->Cell(95,5,'TOTAL GLOBAL:',1,0,'L');
$pdf->Cell(95,5,'$'.$totaltnominas,1,1,'C',1);
$pdf->Output();
}else{
    header('Location: http://localhost/nomina');
}

?>