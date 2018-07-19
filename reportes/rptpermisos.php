<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1) 
  session_start();

if (!isset($_SESSION["nombre"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
}
else
{
if ($_SESSION['almacen']==1)
{

//Inlcuímos a la clase PDF_MC_Table
require('PDF_MC_Table.php');
 
//Instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table();
 
//Agregamos la primera página al documento pdf
$pdf->AddPage();
 
//Seteamos el inicio del margen superior en 25 pixeles 
$y_axis_initial = 25;
 
//Seteamos el tipo de letra y creamos el título de la página. No es un encabezado no se repetirá
$pdf->SetFont('Arial','B',9);

$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTA DE PERMISOS',1,0,'C'); 
$pdf->Ln(10);
 
//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232); 
$pdf->SetFont('Arial','B',8);
$pdf->Cell(28,6,'FEC.EMISION',1,0,'C',1); 
$pdf->Cell(28,6,utf8_decode('FEC.PROCEDE'),1,0,'C',1);
$pdf->Cell(55,6,utf8_decode('COLABORADOR'),1,0,'C',1);
$pdf->Cell(25,6,'TIP.PERMISO',1,0,'C',1);
$pdf->Cell(30,6,'MOTIVO',1,0,'C',1);
$pdf->Cell(15,6,'EST',1,0,'C',1);
$pdf->Cell(15,6,'APRO',1,0,'C',1);
 
$pdf->Ln(10);
//Comenzamos a crear las filas de los registros según la consulta mysql
require_once "../modelos/Permiso_Personal.php";
$permiso_personal = new Permiso_Personal();

$rspta = $permiso_personal->reporte();

//Table with 20 rows and 4 columns
$pdf->SetWidths(array(23,23,35,25,30, 22, 27));

while($reg= $rspta->fetch_object())
{  
    $fecha_emision = $reg->fecha_emision;
    $fecha_procede = $reg->fecha_procede;
    $tipo_permiso = $reg->tipo_permiso;
    $tipo_permiso = $reg->tipo_permiso;
    $tipo_permiso =$reg->tipo_permiso;
    $tipo_permiso = $reg->tipo_permiso;
    $tipo_permiso =$reg->tipo_permiso;
 	
 	$pdf->SetFont('Arial','',7);
    $pdf->Row(array(utf8_decode($fecha_emision),utf8_decode($fecha_procede),$tipo_permiso,$tipo_permiso,utf8_decode($tipo_permiso),$tipo_permiso,utf8_decode($tipo_permiso) ));
}
 
//Mostramos el documento pdf
$pdf->Output();

?>
<?php
}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>