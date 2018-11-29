<?php

   session_start();
// $id=$_GET['nrooc'];
// $id=$_POST['nrooc'];

// echo $id;



// header("Content-Type: text/html;charset=utf-8");

// <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

// header("Content-Type: text/html;charset=ISO-8859-1");


header('Content-Type: text/html; charset=ISO-8859-1');



$idmft = $_GET["id"];



//ajuntar la libreria excel
include "Classes/PHPExcel.php";
//include "../library/consulSQL.php";

 $conexion=mysql_connect("192.168.1.26","admin","vasco123") or die("No se pudo conectar: " . mysql_error());
    mysql_select_db("db_corpvasco",$conexion);

      $fechaactual = getdate();
        // print_r($fechaactual);
        $fecha="$fechaactual[mday]/$fechaactual[mon]/$fechaactual[year]";

        //$UsuReg=$_SESSION['usuario']['Login'];


$objPHPExcel = new PHPExcel(); //nueva instancia

$objPHPExcel->getProperties()->setCreator("Joel"); //autor
$objPHPExcel->getProperties()->setTitle("sadasdas"); //titulo

//inicio estilos
$titulo = new PHPExcel_Style(); //nuevo estilo
$titulo->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 16
    )
));

//inicio estilos
$titulo2 = new PHPExcel_Style(); //nuevo estilo
$titulo2->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 12
    )
));


//inicio estilos
$titulo3 = new PHPExcel_Style(); //nuevo estilo
$titulo3->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 14
    )
));


$observaciones = new PHPExcel_Style(); //nuevo estilo
$observaciones->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 8
    )
));

$subtitulo = new PHPExcel_Style(); //nuevo estilo
$subtitulo->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('argb' => 'FF3399FF')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));

$subtitulo2 = new PHPExcel_Style(); //nuevo estilo
$subtitulo2->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'B2ACAB')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 16
    )
));

$subtitulo3 = new PHPExcel_Style(); //nuevo estilo
$subtitulo3->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => '#D4E6F1')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 16
    )
));


/*======================================================
  ======================================================
  ======================================================*/

  $tituloG = new PHPExcel_Style(); //nuevo estilo
  $tituloG->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'borders' => array( //bordes
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => true,
        'size' => 42
      )
  ));

  //TEXTOS

  //inicio estilos
  $tex1 = new PHPExcel_Style(); //nuevo estilo
  $tex1->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
      ),
      'font' => array( //fuente
        'bold' => false,
        'size' => 36
      )
  ));

  $tex2 = new PHPExcel_Style(); //nuevo estilo
  $tex2->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
      ),
      'borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => false,
        'size' => 36
      )
  ));



  //SUBTITULOS//
  $sub1 = new PHPExcel_Style(); //nuevo estilo
  $sub1->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'borders' => array( //bordes
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => false,
        'size' => 28
      )
  ));

  $sub2 = new PHPExcel_Style(); //nuevo estilo
  $sub2->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
      ),
      'borders' => array( //bordes
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => true,
        'size' => 36
      )
  ));

  $sub3 = new PHPExcel_Style(); //nuevo estilo
  $sub3->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
      ),
      'font' => array( //fuente
        'bold' => true,
        'size' => 36
      )
  ));


  $sub4 = new PHPExcel_Style(); //nuevo estilo
  $sub4->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'fill' => array( //relleno de color
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'd6d0d0')
      ),
      'borders' => array( //bordes
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
        'font' => array( //fuente
        'bold' => true,
        'size' => 42
      )
  ));

  $sub5 = new PHPExcel_Style(); //nuevo estilo
  $sub5->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => true,
        'size' => 40
      )
  ));

  $sub6 = new PHPExcel_Style(); //nuevo estilo
  $sub6->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
      ),
      'borders' => array( //bordes
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => true,
        'size' => 36
      )
  ));

  $sub7 = new PHPExcel_Style(); //nuevo estilo
  $sub7->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
      ),
      'borders' => array( //bordes
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => true,
        'size' => 36
      )
  ));

  $bordes1 = new PHPExcel_Style(); //nuevo estilo
  $bordes1->applyFromArray(
    array('borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      )
  ));

  $bordes2 = new PHPExcel_Style(); //nuevo estilo
  $bordes2->applyFromArray(
    array('borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
      )
  ));

  $bordes3 = new PHPExcel_Style(); //nuevo estilo
  $bordes3->applyFromArray(
    array('borders' => array( //bordes
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      )
  ));


  /*======================================================
    ======================================================
    ======================================================*/




$bordes = new PHPExcel_Style(); //nuevo estilo

$bordes->applyFromArray(
  array('borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));
//fin estilos

$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("PRESENTACION"); //establecer titulo de hoja

//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);

//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);


//establecer impresion a pagina completa
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
//fin: establecer impresion a pagina completa


//establecer margenes
$margin = 1.75 / 3.54; // 0.5 centimetros
$marginBottom = 1.625 / 3.54; //1.2 centimetros
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($marginBottom);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($marginBottom);
//fin: establecer margenes


//incluir una imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('img/jackyft.png'); //ruta
$objDrawing->setWidthAndHeight(333,200);
// $objDrawing->setWeight(10); //altura
$objDrawing->setCoordinates('B2');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen






//establecer titulos de impresion en cada hoja
//$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);

 $sqlPro=mysql_query(" SELECT         mft.idmft,
                                      DATE(mft.fecha_hora) AS fecha,
                                      DATE(mft.fecha_mod) AS fecha_mod,
                                      m.id_marca,
                                      ma.nombre AS marca,
                                      mft.cod_mod,
                                      m.nom_mod,
                                      mft.id_trab,
                                      CONCAT(
                                        SUBSTRING_INDEX(nom_trab, ' ', 1),
                                        ' ',
                                        t.apepat_trab,
                                        ' ',
                                        SUBSTRING(t.apemat_trab, 1, 1),
                                        '.'
                                      ) AS disenador,
                                      mft.idusuario,
                                      UPPER(u.nombre) AS desarrollador,
                                      mft.total_mft,
                                      mft.vb_mft,
                                      SUBSTRING_INDEX(
                                        (SELECT 
                                          UPPER(nombre) 
                                        FROM
                                          usuario u 
                                        WHERE u.idusuario = mft.vb_mft),
                                        ' ',
                                        2
                                      ) AS vb,
                                      mft.estado,
                                      mft.editable,
                                      CASE
                                        WHEN mft.empresa = '1' 
                                        THEN 'CORPORACION VASCO' 
                                        WHEN mft.empresa = '2' 
                                        THEN 'INSUSTRIAS VASQUEZ' 
                                        ELSE 'JOSE VASQUEZ CORTEZ' 
                                      END AS empresa,
                                      mft.color_mod,
                                      mft.tallas_mod,
                                      mft.div_mod,
                                      mft.temp_mod,
                                      mft.dest_mod,
                                      t1.tela1 AS tela1_mod,
                                      t2.tela2 AS tela2_mod,
                                      t3.tela3 AS tela3_mod,
                                      mft.tela1_mod AS t1,
                                      mft.tela2_mod AS t2,
                                      mft.tela3_mod AS t3,
                                      CASE
                                        WHEN mft.bord_mod = '0' 
                                        THEN 'NO' 
                                        ELSE 'SI' 
                                      END AS bord_mod,
                                      CASE
                                        WHEN mft.esta_mod = '0' 
                                        THEN 'NO' 
                                        ELSE 'SI' 
                                      END AS esta_mod,
                                      CASE
                                        WHEN mft.manu_mod = '0' 
                                        THEN 'NO' 
                                        ELSE 'SI' 
                                      END AS manu_mod,
                                      mft.imagen,
                                      mft.imagen2 
                                      FROM
                                      maestro_ficha_tecnica mft 
                                      LEFT JOIN modelojf m 
                                        ON mft.cod_mod = m.cod_mod 
                                      LEFT JOIN marcas ma 
                                        ON m.id_marca = ma.id_marca 
                                      LEFT JOIN usuario u 
                                        ON mft.idusuario = u.idusuario 
                                      LEFT JOIN trabajador t 
                                        ON mft.id_trab = t.id_trab 
                                      LEFT JOIN 
                                        (SELECT 
                                          SUBSTRING(pro.codfab, 1, 6) AS tela1_mod,
                                          CONCAT(
                                            SUBSTRING(pro.codfab, 1, 6),
                                            ' - ',
                                            tmd.des_larga
                                          ) AS tela1,
                                          tmd.des_corta AS cod_linea,
                                          lin.linea 
                                        FROM
                                          producto pro 
                                          LEFT JOIN tabla_m_detalle AS tmd 
                                            ON SUBSTRING(pro.codfab, 4, 3) = tmd.valor_3 
                                          LEFT JOIN 
                                            (SELECT 
                                              SUBSTRING(pro.codfab, 1, 6) AS cod_sublinea,
                                              tmd.des_larga AS linea,
                                              tmd.des_corta AS cod_linea 
                                            FROM
                                              producto pro 
                                              LEFT JOIN tabla_m_detalle AS tmd 
                                                ON LEFT(pro.codfab, 3) = tmd.des_corta 
                                            WHERE pro.estpro = '1' 
                                              AND tmd.cod_tabla = 'tlin' 
                                            GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS lin 
                                            ON SUBSTRING(pro.codfab, 1, 6) = lin.cod_sublinea 
                                        WHERE pro.estpro = '1' 
                                          AND tmd.cod_tabla = 'tsub' 
                                          AND tmd.des_corta = lin.cod_linea 
                                          AND linea LIKE '%tela%' OR  linea LIKE '%blonda%' 
                                        GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS t1 
                                        ON mft.tela1_mod = t1.tela1_mod 
                                      LEFT JOIN 
                                        (SELECT 
                                          SUBSTRING(pro.codfab, 1, 6) AS tela2_mod,
                                          CONCAT(
                                            SUBSTRING(pro.codfab, 1, 6),
                                            ' - ',
                                            tmd.des_larga
                                          ) AS tela2,
                                          tmd.des_corta AS cod_linea,
                                          lin.linea 
                                        FROM
                                          producto pro 
                                          LEFT JOIN tabla_m_detalle AS tmd 
                                            ON SUBSTRING(pro.codfab, 4, 3) = tmd.valor_3 
                                          LEFT JOIN 
                                            (SELECT 
                                              SUBSTRING(pro.codfab, 1, 6) AS cod_sublinea,
                                              tmd.des_larga AS linea,
                                              tmd.des_corta AS cod_linea 
                                            FROM
                                              producto pro 
                                              LEFT JOIN tabla_m_detalle AS tmd 
                                                ON LEFT(pro.codfab, 3) = tmd.des_corta 
                                            WHERE pro.estpro = '1' 
                                              AND tmd.cod_tabla = 'tlin' 
                                            GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS lin 
                                            ON SUBSTRING(pro.codfab, 1, 6) = lin.cod_sublinea 
                                        WHERE pro.estpro = '1' 
                                          AND tmd.cod_tabla = 'tsub' 
                                          AND tmd.des_corta = lin.cod_linea 
                                          AND linea LIKE '%tela%' OR  linea LIKE '%blonda%' 
                                        GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS t2 
                                        ON mft.tela2_mod = t2.tela2_mod 
                                      LEFT JOIN 
                                        (SELECT 
                                          SUBSTRING(pro.codfab, 1, 6) AS tela3_mod,
                                          CONCAT(
                                            SUBSTRING(pro.codfab, 1, 6),
                                            ' - ',
                                            tmd.des_larga
                                          ) AS tela3,
                                          tmd.des_corta AS cod_linea,
                                          lin.linea 
                                        FROM
                                          producto pro 
                                          LEFT JOIN tabla_m_detalle AS tmd 
                                            ON SUBSTRING(pro.codfab, 4, 3) = tmd.valor_3 
                                          LEFT JOIN 
                                            (SELECT 
                                              SUBSTRING(pro.codfab, 1, 6) AS cod_sublinea,
                                              tmd.des_larga AS linea,
                                              tmd.des_corta AS cod_linea 
                                            FROM
                                              producto pro 
                                              LEFT JOIN tabla_m_detalle AS tmd 
                                                ON LEFT(pro.codfab, 3) = tmd.des_corta 
                                            WHERE pro.estpro = '1' 
                                              AND tmd.cod_tabla = 'tlin' 
                                            GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS lin 
                                            ON SUBSTRING(pro.codfab, 1, 6) = lin.cod_sublinea 
                                        WHERE pro.estpro = '1' 
                                          AND tmd.cod_tabla = 'tsub' 
                                          AND tmd.des_corta = lin.cod_linea 
                                          AND linea LIKE '%tela%' OR  linea LIKE '%blonda%' 
                                        GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS t3 
                                        ON mft.tela3_mod = t3.tela3_mod 
                                      WHERE mft.idmft = $idmft" ) or die(mysql_error());





  $resPro=mysql_fetch_array($sqlPro);

  $fila=2;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'FICHA DE ESPECIFICACIONES TECNICAS');
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'UDP');
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "N$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tituloG, "B$fila:M$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->setSharedStyle($tituloG, "N$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(105);




  $fila=3;

  $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(48.75);
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "DPTO. : DESARROLLO DEL PRODUCTO");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila:N$fila"); //establecer estilo




  $fila=4;
  $objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(48.75);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "CLIENTE:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["empresa"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "D$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "DISEÑADORA:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["disenador"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "J$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", "BORDADO:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($resPro["bord_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "N$fila");


  $fila=5;
  $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(48.75);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "MARCA:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["marca"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "D$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "ELABORADO POR:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["desarrollador"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "J$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", "ESTAMPADO:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($resPro["esta_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "N$fila");


  $fila=6;
  $objPHPExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(48.75);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "TEMPORADA:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["temp_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "D$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "DESTINO");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["dest_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "J$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", "MANUALIDADES:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($resPro["manu_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "N$fila");


  $fila=7;
  $objPHPExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(48.75);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "DIVISION:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["div_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "D$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "COLORES");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["color_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "J$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", "FECHA DE ELABORACION:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($resPro["fecha"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "N$fila");


  $fila=8;
  $objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(48.75);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "CODIGO:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["cod_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "D$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "TELA PRINCIPAL:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["tela1_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "J$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", "FECHA DE MODIFICACION:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($resPro["fecha_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "N$fila");

  $fila=9;
  $objPHPExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(48.75);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "DESCRIPCION:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["nom_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "D$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "TELA COMPLEMENTO 1:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["tela2_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "J$fila");

  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "N$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", "MOTIVO:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "L$fila"); //establecer estilo


  $fila=10;
  $objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(48.75);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "TALLAS:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["tallas_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "D$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "TELA COMPLEMENTO 2:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["tela3_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "J$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", "V.B:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($resPro["vb"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "N$fila");

  $fila=11;
  $objPHPExcel->getActiveSheet()->getRowDimension('11')->setRowHeight(62.46);

  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "N$fila");


  $fila=12;
  $objPHPExcel->getActiveSheet()->getRowDimension('12')->setRowHeight(64.75);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "RUTA:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", "CORTE - COSTURA - ACABADOS - EMPAQUE");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "D$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "D$fila:N$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=13;
  $objPHPExcel->getActiveSheet()->getRowDimension('13')->setRowHeight(15.23);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=14;
  $objPHPExcel->getActiveSheet()->getRowDimension('14')->setRowHeight(15.23);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=15;
  $objPHPExcel->getActiveSheet()->getRowDimension('15')->setRowHeight(45.70);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=16;
  $objPHPExcel->getActiveSheet()->getRowDimension('16')->setRowHeight(45.70);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "RUTA PARA PRODUCCION:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "B$fila:F$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "PRESENTACION");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=17;
  $objPHPExcel->getActiveSheet()->getRowDimension('17')->setRowHeight(15.23);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=18;
  $objPHPExcel->getActiveSheet()->getRowDimension('18')->setRowHeight(15.23);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=19;
  $objPHPExcel->getActiveSheet()->getRowDimension('19')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=20;
  $objPHPExcel->getActiveSheet()->getRowDimension('20')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "1.-");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "TENDIDO");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=21;
  $objPHPExcel->getActiveSheet()->getRowDimension('21')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "(tendido de capas de telas según orden de corte)");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=22;
  $objPHPExcel->getActiveSheet()->getRowDimension('22')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=23;
  $objPHPExcel->getActiveSheet()->getRowDimension('23')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=24;
  $objPHPExcel->getActiveSheet()->getRowDimension('24')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  //incluir una imagen
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setPath('../files/fichas_tecnicas/'.$resPro["imagen"].''); //ruta
  $objDrawing->setWidthAndHeight(1100,900);
  //$objDrawing->setWeight(100); //altura
  $objDrawing->setCoordinates('H24');
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
  //fin: incluir una imagen

  //incluir una imagen
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setPath('../files/fichas_tecnicas/'.$resPro["imagen2"].''); //ruta
  $objDrawing->setWidthAndHeight(1100,900);
  //$objDrawing->setWeight(100); //altura
  $objDrawing->setCoordinates('K24');
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
  //fin: incluir una imagen



  $fila=25;
  $objPHPExcel->getActiveSheet()->getRowDimension('25')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "2.-");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "TIZADA");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=26;
  $objPHPExcel->getActiveSheet()->getRowDimension('26')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "(realizar tizado en programa)");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=27;
  $objPHPExcel->getActiveSheet()->getRowDimension('27')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=28;
  $objPHPExcel->getActiveSheet()->getRowDimension('28')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=29;
  $objPHPExcel->getActiveSheet()->getRowDimension('29')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=30;
  $objPHPExcel->getActiveSheet()->getRowDimension('30')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "3.-");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "CORTE Y HABILITADO");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=31;
  $objPHPExcel->getActiveSheet()->getRowDimension('31')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "(dar el tiempo de reposo necesario a la tela)");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=32;
  $objPHPExcel->getActiveSheet()->getRowDimension('32')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=33;
  $objPHPExcel->getActiveSheet()->getRowDimension('33')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=34;
  $objPHPExcel->getActiveSheet()->getRowDimension('34')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=35;
  $objPHPExcel->getActiveSheet()->getRowDimension('35')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "4.-");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "HABILITAR INSUMOS A AREA DE PRODUCCION");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=36;
  $objPHPExcel->getActiveSheet()->getRowDimension('36')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "(El area de almacen de materia prima habilitara");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=37;
  $objPHPExcel->getActiveSheet()->getRowDimension('37')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "insumos requeridos al area de produccion)");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=38;
  $objPHPExcel->getActiveSheet()->getRowDimension('38')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=39;
  $objPHPExcel->getActiveSheet()->getRowDimension('39')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=40;
  $objPHPExcel->getActiveSheet()->getRowDimension('40')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "5.-");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "CONFECCION DE PRENDAS");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=41;
  $objPHPExcel->getActiveSheet()->getRowDimension('41')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "(la prenda debe ser entregada limpia)");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=42;
  $objPHPExcel->getActiveSheet()->getRowDimension('42')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=43;
  $objPHPExcel->getActiveSheet()->getRowDimension('43')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=44;
  $objPHPExcel->getActiveSheet()->getRowDimension('44')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=45;
  $objPHPExcel->getActiveSheet()->getRowDimension('45')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "6.-");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "INSPECCION DE CALIDAD");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=46;
  $objPHPExcel->getActiveSheet()->getRowDimension('46')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "(revision y auditoria de prendas)");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=47;
  $objPHPExcel->getActiveSheet()->getRowDimension('47')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=48;
  $objPHPExcel->getActiveSheet()->getRowDimension('48')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=49;
  $objPHPExcel->getActiveSheet()->getRowDimension('49')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=50;
  $objPHPExcel->getActiveSheet()->getRowDimension('50')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "7.-");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "ACABADO, DOBLADO Y EMBOLSADO DE PRENDA");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=51;
  $objPHPExcel->getActiveSheet()->getRowDimension('51')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->setSharedStyle($sub6, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "(la prenda tendra que estar con todos sus avios)");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:F$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=52;
  $objPHPExcel->getActiveSheet()->getRowDimension('52')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=53;
  $objPHPExcel->getActiveSheet()->getRowDimension('53')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=54;
  $objPHPExcel->getActiveSheet()->getRowDimension('54')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $fila=55;
  $objPHPExcel->getActiveSheet()->getRowDimension('55')->setRowHeight(40.37);

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "G$fila:N$fila");


  $fila=56;
  $objPHPExcel->getActiveSheet()->getRowDimension('56')->setRowHeight(91.41);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "COMBOS :");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub7, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub7, "B$fila:F$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "OBSERVACIONES :");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub7, "G$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub7, "G$fila:N$fila");

  $fila=57;
  $objPHPExcel->getActiveSheet()->getRowDimension('57')->setRowHeight(22.09);

  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes1, "B$fila:F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "C$fila:N$fila");


  /*===PARA LOS COMBOS=====*/

      $sql=mysql_query("SELECT
                                  CONCAT('COMBO ',(@i := @i + 1)) AS contador ,
                                  fc.cod_color,
                                  c.color
                                  FROM (SELECT @i:=0) r, fictec_color fc
                                  LEFT JOIN
                                  (SELECT
                                  RIGHT(cod_argumento,2) AS cod_color,
                                  des_larga AS color
                                  FROM tabla_m_detalle
                                  WHERE cod_tabla='tcol' AND cod_argumento<100) AS c
                                  ON fc.cod_color=c.cod_color
                                  WHERE fc.idmft=$idmft") or die(mysql_error());




  while($res=mysql_fetch_array($sql)){


  $fila+=1;
  $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(67.79);

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["contador"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", "");
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["color"]));




  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes2, "D$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "F$fila");

 }

   /*===PARA LOS COMBOS=====*/



   $fila=58;
   $objPHPExcel->getActiveSheet()->getRowDimension('58')->setRowHeight(67.79);

   $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "F$fila");

   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "* LA MUESTRA ENVIADA AL SERVICIO SIRVE SOLO COMO REFERENCIA DE CONFECCIÓN. LOS DETALLES DE LA PRENDA SE ENCUENTRAN EN LA FICHA TECNICA.");
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "G$fila");
   $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "G$fila:N$fila");

   $fila=59;
   $objPHPExcel->getActiveSheet()->getRowDimension('59')->setRowHeight(67.79);

   $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "F$fila");

   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "* EL SERVICIO ESTÁ EN LA OBLIGACIÓN DE CORRER UNA MUESTRA ANTES DE INICIO DE PRODUCCIÓN, PARA EVITAR PROBLEMAS EN EL PROCESO.");
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "G$fila");
   $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "G$fila:N$fila");

   $fila=60;
   $objPHPExcel->getActiveSheet()->getRowDimension('60')->setRowHeight(67.79);

   $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "F$fila");

   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "* RESPETAR SEPARACIÓN DE BLOQUES DE CORTE, YA QUE SE COLOCA TELA CONTRASTE PARA DIFERENCIAR TONALIDAD EN CADA BLOQUE DE CORTE.");
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "G$fila");
   $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "G$fila:N$fila");

   $fila=61;
   $objPHPExcel->getActiveSheet()->getRowDimension('61')->setRowHeight(67.79);

   $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "F$fila");

   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "* REGULAR TENSIONES SEGÚN TELA A TRABAJAR.");
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "G$fila");
   $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "G$fila:N$fila");

   $fila=62;
   $objPHPExcel->getActiveSheet()->getRowDimension('62')->setRowHeight(67.79);

   $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "F$fila");

   $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "* REVISAR E INSPECCIONAR TODAS LAS PRENDAS CUANDO SALEN DE LÍNEA DE COSTURA.");
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "G$fila");
   $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "G$fila:N$fila");

   $fila=63;
   $objPHPExcel->getActiveSheet()->getRowDimension('63')->setRowHeight(67.79);

   $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "F$fila");
   $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "G$fila:N$fila");


   $fila=64;
   $objPHPExcel->getActiveSheet()->getRowDimension('64')->setRowHeight(67.79);

   $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila"); //establecer estilo
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "F$fila");
   $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
   $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "G$fila:N$fila");

   $fila=65;
   $objPHPExcel->getActiveSheet()->getRowDimension('65')->setRowHeight(67.79);

   $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
   $objPHPExcel->getActiveSheet()->setSharedStyle($bordes3, "B$fila:F$fila");
   $objPHPExcel->getActiveSheet()->mergeCells("G$fila:N$fila");
   $objPHPExcel->getActiveSheet()->setSharedStyle($bordes3, "G$fila:N$fila");




  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3.14);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(23.86);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(46.43);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40.71);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15.29);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(55.86);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(82.57);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(52.86);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(27.14);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(73.57);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(100.71);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(42.57);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(45.71);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(64.29);



//establecer pie de impresion en cada hoja
//$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');

//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo

// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");

// nombre del archivo

        $sqlTit=mysql_query("SELECT   CONCAT('F.T ',mft.cod_mod,' ',m.nom_mod) AS modelo,
                                      mft.cod_mod,
                                      m.nom_mod
                                      FROM maestro_ficha_tecnica mft
                                      LEFT JOIN modelojf m
                                      ON mft.cod_mod=m.cod_mod
                                      where mft.idmft=$idmft" ) or die(mysql_error());

        $resTit=mysql_fetch_array($sqlTit);

header('Content-Disposition: attachment; filename="'.$resTit["modelo"].'.xls"');
//**********************************************************************

//****************Guardar como excel 2007*******************************
//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //Escribir archivo
//
//// Establecer formado de Excel 2007
//header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//
//// nombre del archivo
//header('Content-Disposition: attachment; filename="kiuvox.xlsx"');
//**********************************************************************

//forzar a descarga por el navegador
$objWriter->save('php://output');
