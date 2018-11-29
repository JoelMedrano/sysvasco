<?php

   session_start();
// $id=$_GET['nrooc'];
// $id=$_POST['nrooc'];

// echo $id;



// header("Content-Type: text/html;charset=utf-8");

// <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

// header("Content-Type: text/html;charset=ISO-8859-1");


header('Content-Type: text/html; charset=ISO-8859-1');



$id_trab=$_GET["id"];



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

$objPHPExcel->getProperties()->setCreator("leydi"); //autor
$objPHPExcel->getProperties()->setTitle("HojaTrabajador"); //titulo

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


//inicio estilos
$titulo4 = new PHPExcel_Style(); //nuevo estilo
$titulo4->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
    ),
    'font' => array( //fuente
      'size' => 10
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
      'color' => array('argb' => 'FF3399FF')
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





$bordes = new PHPExcel_Style(); //nuevo estilo

$bordes->applyFromArray(
  array('borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    )
));
//fin estilos





$bordes_inferior = new PHPExcel_Style(); //nuevo estilo

$bordes_inferior->applyFromArray(
  array('borders' => array(
     'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_NONE)
      )
));
//fin estilos

$bordes_lateral_izquierdo = new PHPExcel_Style(); //nuevo estilo

$bordes_lateral_izquierdo->applyFromArray(
  array('borders' => array(
     'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
      )
));
//fin estilos

$sqlTit=mysql_query("SELECT
tr.id_trab

FROM trabajador tr

where tr.id_trab=$id_trab" ) or die(mysql_error());

$resTit=mysql_fetch_array($sqlTit);





$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Hoja2"); //establecer titulo de hoja

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
$margin = 0.5 / 3.54; // 0.5 centimetros
$marginBottom = 1.2 / 3.54; //1.2 centimetros
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($marginBottom);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($margin);
//fin: establecer margenes






//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);

 $sqlPro=mysql_query("SELECT tr.id_trab,
    CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
    CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab ) AS apellidos,
    tr.apepat_trab, tr.apemat_trab,  tr.nom_trab, tr.est_reg, tr.fecfin_con_ant, tr.fecfin_con_act,
    tr.id_tip_plan, tpla.des_larga AS tipo_planilla,
    tr.id_sucursal, IFNULL(tsua.des_larga,'')  AS sucursal_anexo,
    tr.id_funcion ,  tfun.des_larga AS funcion,
    tr.id_area, tare.des_larga AS area_trab, 
    tr.id_genero, tgen.des_larga AS genero,
    tr.id_tip_doc, tdoc.des_larga AS tipo_documento,
    tr.id_cen_cost, tcco.des_larga AS centro_costos,
    tr.id_tip_man_ob, ttmo.des_larga AS tipo_mano_obra,
    tr.id_categoria, tcal.des_larga AS categoria_laboral,
    tr.id_form_pag, tfop.des_larga AS forma_pago,
    tr.id_tip_cont, tcon.des_larga AS tipo_contrato,
    tr.id_est_civil, teci.des_larga AS estado_civil,
    tr.id_reg_pen, trep.des_larga AS regimen_pensionario,
    tr.id_com_act, ttca.des_larga AS comision_actual,
    tr.id_t_registro, ttre.des_larga AS t_registro,
    tr.num_doc_trab,
    tr.nacionalidad,
    tr.dir_trab,
    tr.urb_trab,
    tr.departamento,
    IF( DATE_FORMAT(tr.fec_nac_trab, '%d/%m/%Y')='00/00/0000' , '', DATE_FORMAT(tr.fec_nac_trab, '%d/%m/%Y')  )AS fec_nac_trab,
    tr.lug_nac_trab,
    tr.num_tlf_cel,
    tr.num_tlf_dom,
    tr.email_trab,
    tr.id_turno, ttur.des_larga AS turno,
    DATE_FORMAT(tr.fec_ing_trab, '%d/%m/%Y') AS fec_ing_trab,
    DATE_FORMAT(tr.fec_sal_trab, '%d/%m/%Y') AS fec_sal_trab,
    DATE_FORMAT(tr.fec_ing2, '%d/%m/%Y') AS fec_ing2,
    DATE_FORMAT(tr.fec_sal2, '%d/%m/%Y') AS fec_sal2,
    tr.mot_sal2,
    DATE_FORMAT(tr.fec_ing1, '%d/%m/%Y') AS fec_ing1,
    DATE_FORMAT(tr.fec_sal1, '%d/%m/%Y') AS fec_sal1,
    tr.mot_sal1,
    DATE_FORMAT(tr.fec_ing_interno, '%d/%m/%Y') AS fec_ing_interno,
    DATE_FORMAT(tr.fec_sal_interno, '%d/%m/%Y') AS fec_sal_interno,
    tr.mot_sal_interno,
    tr.sueldo_trab,
    tr.bono_trab,
    tr.bono_des_trab,
    tr.asig_trab,
    tr.id_pag_esp,
    tmpe.des_larga AS pago_especial,
    tr.obs_trab,
    DATE(tr.fecfin_con_act) AS fecfin_con_act,
    DATE(tr.fecfin_con_ant) AS fecfin_con_ant,
    tr.cusp_trab,
    YEAR(CURDATE())-YEAR(tr.fec_nac_trab) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(tr.fec_nac_trab,'%m-%d'), 0 , -1 ) AS edad_trab,
    tr.id_distrito ,
    ubi.Distrito AS distrito,
    tr.nro_cta_cts, 
    tr.nro_cta_sue, 
    tf.nom_pad,
    tf.viv_pad,
    tf.ocu_pad,
    tf.dep_pad,
    tf.tel_pad,
    DATE(tf.fec_rec_dat) AS fec_rec_dat,
    tf.viv_mad,
    tf.nom_mad,
    tf.ocu_mad,
    tf.dep_mad,
    tf.tel_mad,
    tf.viv_con,
    tf.nom_con,
    tf.ocu_con,
    tf.dep_con,
    tf.tel_con,
    IF( DATE_FORMAT(tf.nac_hij1, '%d/%m/%Y')='00/00/0000' , '',  DATE_FORMAT(tf.nac_hij1, '%d/%m/%Y') ) AS nac_hij1,
    tf.nom_hij1,
    tf.ocu_hij1,
    tf.dep_hij1,
    tf.tel_hij1,
    IF( DATE_FORMAT(tf.nac_hij2, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tf.nac_hij2, '%d/%m/%Y')  ) AS nac_hij2,
    tf.nom_hij2,
    tf.ocu_hij2,
    tf.dep_hij2,
    tf.tel_hij2,
    IF( DATE_FORMAT(tf.nac_hij3, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tf.nac_hij3, '%d/%m/%Y')  ) AS nac_hij3,
    tf.nom_hij3,
    tf.ocu_hij3,
    tf.dep_hij3,
    tf.tel_hij3,
    IF( DATE_FORMAT(tf.nac_hij4, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tf.nac_hij4, '%d/%m/%Y')  ) AS nac_hij4,
    tf.nom_hij4,
    tf.ocu_hij4,
    tf.dep_hij4,
    tf.tel_hij4,
    tf.nom_otro,
    tf.ocu_otro,
    tf.dep_otro,
    tf.tel_otro,
    tf.nom_fam_con,
    tf.par_fam_con,
    tf.are_fam_con,
    te.cen_est_pri,
    te.grado_pri,
    IF( DATE_FORMAT(te.fec_ini_pri, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(te.fec_ini_pri, '%d/%m/%Y') )AS fec_ini_pri, 
    IF( DATE_FORMAT(te.fec_fin_pri, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(te.fec_fin_pri, '%d/%m/%Y') ) AS fec_fin_pri,
    te.cen_est_sec,
    te.grado_sec,
    IF( DATE_FORMAT(te.fec_ini_sec, '%d/%m/%Y')='00/00/0000', '',  DATE_FORMAT(te.fec_ini_sec, '%d/%m/%Y') ) AS fec_ini_sec, 
    IF( DATE_FORMAT(te.fec_fin_sec, '%d/%m/%Y')='00/00/0000', '',  DATE_FORMAT(te.fec_fin_sec, '%d/%m/%Y') ) AS fec_fin_sec, 
    te.cen_est_sup,
    te.carrera_sup,
    IF( DATE_FORMAT(te.fec_des_sup, '%d/%m/%Y')='00/00/0000', '',  DATE_FORMAT(te.fec_des_sup, '%d/%m/%Y') ) AS fec_des_sup,  
    IF( DATE_FORMAT(te.fec_has_sup, '%d/%m/%Y')='00/00/0000', '',  DATE_FORMAT(te.fec_has_sup, '%d/%m/%Y') ) AS fec_has_sup, 
    te.cen_est_tec,
    te.carrera_tec,
    IF( DATE_FORMAT(te.fec_ini_tec, '%d/%m/%Y')='00/00/0000', '',  DATE_FORMAT(te.fec_ini_tec, '%d/%m/%Y') ) AS fec_ini_tec,
    IF( DATE_FORMAT(te.fec_fin_tec, '%d/%m/%Y')='00/00/0000', '',  DATE_FORMAT(te.fec_fin_tec, '%d/%m/%Y') ) AS fec_fin_tec, 
    te.cen_est_esp,
    te.especialidad,
    IF( DATE_FORMAT(te.fec_ini_esp, '%d/%m/%Y')='00/00/0000', '',  DATE_FORMAT(te.fec_ini_esp, '%d/%m/%Y') ) AS fec_ini_esp, 
    IF( DATE_FORMAT(te.fec_fin_esp, '%d/%m/%Y')='00/00/0000', '',  DATE_FORMAT(te.fec_fin_esp, '%d/%m/%Y') ) AS fec_fin_esp,
    te.cen_est_otros,
    te.carrera_otros,
    IF( DATE_FORMAT(te.fec_ini_otros, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(te.fec_ini_otros, '%d/%m/%Y') ) AS fec_ini_otros, 
    IF( DATE_FORMAT(te.fec_fin_otros, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(te.fec_fin_otros, '%d/%m/%Y') ) AS fec_fin_otros,
    tc.des_idioma,
    tc.cen_est_idioma,
    tc.nivel_idioma,
    tc.des_comp,
    tc.cen_est_comp,
    tc.nivel_comp,
    tel.nom_emp_exp1,
    tel.car_exp1,
    tel.fun_exp1,
    IF( DATE_FORMAT(tel.fec_ini_exp1, '%d/%m/%Y')='00/00/0000', '',  DATE_FORMAT(tel.fec_ini_exp1, '%d/%m/%Y') ) AS fec_ini_exp1,
    IF( DATE_FORMAT(tel.fec_fin_exp1, '%d/%m/%Y')='00/00/0000', '',  DATE_FORMAT(tel.fec_fin_exp1, '%d/%m/%Y') ) AS fec_fin_exp1,
    tel.mot_ces_exp1,
    tel.nom_emp_exp2,
    tel.car_exp2,
    tel.fun_exp2,
    IF( DATE_FORMAT(tel.fec_ini_exp2, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tel.fec_ini_exp2, '%d/%m/%Y') ) AS fec_ini_exp2,
    IF( DATE_FORMAT(tel.fec_fin_exp2, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tel.fec_fin_exp2, '%d/%m/%Y') ) AS fec_fin_exp2,
    tel.mot_ces_exp2,
    tel.nom_emp_exp3,
    tel.car_exp3,
    tel.fun_exp3,
    IF( DATE_FORMAT(tel.fec_ini_exp3, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tel.fec_ini_exp3, '%d/%m/%Y') ) AS fec_ini_exp3,
    IF( DATE_FORMAT(tel.fec_fin_exp3, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tel.fec_fin_exp3, '%d/%m/%Y') ) AS fec_fin_exp3,
    tel.mot_ces_exp3,
    ts.tie_enf_car_onc,
    ts.nom_enf_car_onc,
    ts.tie_enf_ale_rec,
    tr.id_gru_san,
    tgsa.des_larga AS grupo_sanguineo,
    if(tr.talla='0', '', tr.talla) AS talla,
    if(tr.peso='0', '', tr.peso) as peso,
    ta.afi_onp,
    ta.afi_afp,
    ta.nom_afi_afp,
    tda.foto_trab,
    tda.dat_hij1,
    tda.dat_hij2,
    tda.dat_hij3,
    tda.dat_hij4,
    tda.dat_con,
    tda.dat_ant_pol,
    tda.dat_luz_agua,
    tda.dat_cer_med,
    tda.dat_dec_dom,
    tda.dat_cv,
    tda.dat_gra_tit,
    tda.dat_idi,
    tda.dat_cer_tec,
    tda.dat_adi,
    tda.dat_cer_tra1,
    tda.dat_cer_tra2,
    tda.dat_cer_tra3,
    tda.dat_cer_res1,
    tda.dat_cer_res2,
    tda.dat_cer_res3,
    tda.dat_pas,
    tda.dat_bre,
    tda.dat_pla_liq1,
    tda.dat_pla_liq2,
    tda.dat_pla_liq3,
    tda.dat_int_liq1,
    tda.dat_int_liq2,
    tda.dat_int_liq3,
    tda.dat_car_ret_cts1,
    tda.dat_car_ret_cts2,
    tda.dat_car_ret_cts3,
    tda.dat_alt_reg1,
    tda.dat_alt_reg2,
    tda.dat_alt_reg3,
    tda.dat_baj_reg1,
    tda.dat_baj_reg2,
    tda.dat_baj_reg3,
    tda.dat_car_ren,
    IFNULL(MAX(vac.correlativo),0) AS CantItems
        FROM trabajador tr
        LEFT JOIN tabla_maestra_detalle AS tpla ON
        tpla.cod_argumento= tr.id_tip_plan
        AND tpla.cod_tabla='TPLA'
        LEFT JOIN tabla_maestra_detalle AS tsua ON
        tsua.cod_argumento= tr.id_sucursal
        AND tsua.cod_tabla='TSUA' OR tsua.cod_tabla IS NULL
        LEFT JOIN tabla_maestra_detalle AS tfun ON
        tfun.cod_argumento= tr.id_funcion
        AND tfun.cod_tabla='TFUN'
        LEFT JOIN tabla_maestra_detalle AS tare ON
        tare.cod_argumento= tr.id_area
        AND tare.cod_tabla='TARE'
        LEFT JOIN tabla_maestra_detalle AS tgen ON
        tgen.cod_argumento= tr.id_genero
        AND tgen.cod_tabla='TGEN' 
        LEFT JOIN tabla_maestra_detalle AS tdoc ON
        tdoc.cod_argumento= tr.id_tip_doc
        AND tdoc.cod_tabla='TDOC' 
        LEFT JOIN tabla_maestra_detalle AS tcco ON
        tcco.cod_argumento= tr.id_cen_cost
        AND tcco.cod_tabla='TCCO' 
        LEFT JOIN tabla_maestra_detalle AS ttmo ON
        ttmo.cod_argumento= tr.id_tip_man_ob
        AND ttmo.cod_tabla='TTMO' 
        LEFT JOIN tabla_maestra_detalle AS tcal ON
        tcal.cod_argumento= tr.id_categoria
        AND tcal.cod_tabla='TCAL' 
          LEFT JOIN tabla_maestra_detalle AS tfop ON
        tfop.cod_argumento= tr.id_form_pag
        AND tfop.cod_tabla='TFOP' 
        LEFT JOIN tabla_maestra_detalle AS tcon ON
        tcon.cod_argumento= tr.id_tip_cont
        AND tcon.cod_tabla='TCON' 
        LEFT JOIN tabla_maestra_detalle AS teci ON
        teci.cod_argumento= tr.id_est_civil
        AND teci.cod_tabla='TECI' 
        LEFT JOIN tabla_maestra_detalle AS trep ON
        trep.cod_argumento= tr.id_reg_pen
        AND trep.cod_tabla='TREP' 
        LEFT JOIN tabla_maestra_detalle AS ttca ON
        ttca.cod_argumento= tr.id_com_act
        AND ttca.cod_tabla='TTCA' 
        LEFT JOIN tabla_maestra_detalle AS ttre ON
        ttre.cod_argumento= tr.id_t_registro
        AND ttre.cod_tabla='TTRE' 
        LEFT JOIN tabla_maestra_detalle AS ttur ON
        ttur.cod_argumento= tr.id_turno
        AND ttre.cod_tabla='TTUR'
        LEFT JOIN tabla_maestra_detalle AS tgsa ON
        tgsa.cod_argumento= tr.id_gru_san
        AND tgsa.cod_tabla='TGSA'
        LEFT JOIN tabla_maestra_detalle AS tmpe ON
        tmpe.cod_argumento= tr.id_pag_esp
        AND tmpe.cod_tabla='TMPE'
        LEFT JOIN ubigeo AS ubi ON
        ubi.coddist= tr.id_distrito
        AND ubi.coddpto='15' 
        AND ubi.codprov='01'
        LEFT JOIN trabajador_familia AS tf ON
        tf.id_trab= tr.id_trab
        LEFT JOIN trabajador_estudios AS te ON
        te.id_trab= tr.id_trab
        LEFT JOIN trabajador_conocimiento AS tc ON
        tc.id_trab= tr.id_trab
        LEFT JOIN trabajador_salud AS ts ON
        ts.id_trab= tr.id_trab
        LEFT JOIN trabajador_afiliacion AS ta ON
        ta.id_trab= tr.id_trab
        LEFT JOIN trabajador_data_adjunta AS tda ON
        tda.id_trab= tr.id_trab
        LEFT JOIN trabajador_exp_laboral AS tel ON
        tel.id_trab= tr.id_trab
        LEFT JOIN vacaciones AS vac ON
        vac.nro_doc= tr.num_doc_trab
       WHERE tr.id_trab=$id_trab" ) or die(mysql_error());





  $resPro=mysql_fetch_array($sqlPro);

  $fila=2;
 
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", " III. DATOS FAMILIARES:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  



  $fila=3;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "FAMILIAR");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", "VIVE");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", "FEC.NAC");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "E$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", "EDAD");
 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "F$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "APELLIDOS Y NOMBRES");
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "OCUPACION");
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", "DEPENDE DE UD");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "L$fila"); //establecer estilo
  

  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", "TELEFONO");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "M$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setWrapText(true);


  $fila=4;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "PADRE");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["viv_pad"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["nom_pad"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["ocu_pad"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["dep_pad"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($resPro["tel_pad"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "M$fila"); //establecer estilo

  

 
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



  $fila=5;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "MADRE");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["viv_mad"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["nom_mad"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["ocu_mad"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["dep_mad"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($resPro["tel_mad"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "M$fila"); //establecer estilo

  
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=6;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "CONYUGE");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["viv_con"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["nom_con"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["ocu_con"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["dep_con"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($resPro["tel_con"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "M$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=7;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "HIJO1");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo




  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["nac_hij1"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["nom_hij1"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["ocu_hij1"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["dep_hij1"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($resPro["tel_hij1"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "M$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=8;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "HIJO2");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo


 
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["nac_hij2"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["nom_hij2"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["ocu_hij2"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["dep_hij2"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($resPro["tel_hij2"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "M$fila"); //establecer estilo




  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=9;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "HIJO3");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo


  
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["nac_hij3"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["nom_hij3"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["ocu_hij3"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["dep_hij3"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($resPro["tel_hij3"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "M$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=10;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "HIJO4");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["nac_hij4"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["nom_hij4"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["ocu_hij4"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["dep_hij4"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($resPro["tel_hij4"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "M$fila"); //establecer estilo




  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=11;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "OTRO");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["nom_otro"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["ocu_otro"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["dep_otro"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($resPro["tel_otro"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "M$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  



  $fila=12;  
    $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");  



  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", "APELLIDOS Y NOMBRES");
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "PARENTESCO");
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:J$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", "AREA DE TRABAJO");
  $objPHPExcel->getActiveSheet()->mergeCells("K$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "M$fila"); //establecer estilo
  

  

  
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:M$fila");


  $objPHPExcel->getActiveSheet() ->getStyle("D$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
 


  $filaX=13;
  $filaY=15;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$filaX", "PARIENTE O CONOCIDO EN LA EMPRESA");
  $objPHPExcel->getActiveSheet()->mergeCells("B$filaX:C$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

 
  $objPHPExcel->getActiveSheet()->SetCellValue("D$filaX", utf8_encode($resPro["nom_fam_con"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("D$filaX:H$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$filaX");


  $objPHPExcel->getActiveSheet()->SetCellValue("I$filaX", utf8_encode($resPro["par_fam_con"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("I$filaX:J$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$filaX"); //establecer estilo


  $objPHPExcel->getActiveSheet()->SetCellValue("K$filaX", utf8_encode($resPro["are_fam_con"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("K$filaX:M$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$filaX"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$filaX:C$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$filaX:H$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "F$filaX:M$filaY");
  $objPHPExcel->getActiveSheet() ->getStyle("B$filaX:M$filaX")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle("B$filaX")->getAlignment()->setWrapText(true);


  $fila=16;


  $fila=17;

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", " IV. ESTUDIOS REALIZADOS:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  


  $fila=18;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "NIVEL");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", "CENTRO DE ESTUDIO");
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "CARRERA-GRADO");
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "DESDE");
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", "HASTA");
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "M$fila"); //establecer estilo




  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("L$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



  $fila=19;

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "PRIMARIA");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["cen_est_pri"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["grado_pri"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["fec_ini_pri"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["fec_fin_pri"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo




  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);




  $fila=20;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "SECUNDARIA");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["cen_est_sec"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["grado_sec"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["fec_ini_sec"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["fec_fin_sec"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



  $fila=21;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "SUPERIOR");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["cen_est_sup"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["carrera_sup"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["fec_des_sup"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["fec_has_sup"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=22;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "TECNICO");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["cen_est_tec"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["carrera_tec"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["fec_ini_tec"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["fec_fin_tec"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



  $fila=23;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "ESPECIALIDAD");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["cen_est_esp"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["especialidad"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["fec_ini_esp"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["fec_fin_esp"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo




  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);




  $fila=24;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "OTROS");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

   
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["cen_est_otros"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["carrera_otros"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["fec_ini_otros"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["fec_fin_otros"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo




  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);





  $fila=26;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", " V. OTROS CONOCIMIENTOS:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo



  $fila=27;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "IDIOMAS");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", "CENTRO DE ESTUDIO");
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "NIVEL(BASICO, INTERMEDIO O AVANZADO)");
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=28;


 

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["des_idioma"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["cen_est_idioma"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($resPro["nivel_idioma"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);




  

  $fila=29;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "COMPUTACION");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", "CENTRO DE ESTUDIO");
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "NIVEL(BASICO, INTERMEDIO O AVANZADO)");
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=30;

   $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["des_comp"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["cen_est_comp"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($resPro["nivel_comp"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $fila=32;

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", " VI. SALUD");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:D$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo



  $fila=33;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "TIENE ANTECEDENTES DE ENFERMEDADES CARDIACAS Y/O ONCOLOGICAS?");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

  $fila=34;

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["tie_enf_car_onc"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);



  $fila=35;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "ACTUALMENTE SUFRE DE ALGUN TIPO DE ALERGIA/MEDICAMENTO");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);



  $fila=36;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["tie_enf_ale_rec"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


  $fila=37;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "ACTUALMENTE SUFRE DE ALGUNA ENFERMEDAD? CUAL?");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

  $fila=38;

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["nom_enf_car_onc"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);




  $fila=39;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "GRUP.SANGUINEO");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "PESO");
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "TALLA");
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "J$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


  $fila=40;

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["grupo_sanguineo"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["peso"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["talla"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:M$fila");

  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);






  


  $fila=41;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "ESTA AFILIADO A ONP?(SI/NO):");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($resPro["afi_onp"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("F$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

 

  $fila=42;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "ESTA AFILIADO A AFP?(SI/NO):");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($resPro["afi_afp"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["nom_afi_afp"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


  $fila=52;
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes_inferior, "B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes_inferior, "J$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



  $fila=53;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Fecha");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "Firma del Solicitante");
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $sql1=mysql_query("SELECT * FROM  trabajador tr  where tr.id_trab=$id_trab") or die(mysql_error());




$res1=mysql_fetch_array($sql1);

$fila+=1;




  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(1);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(7);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(7);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(6);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(9);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);





$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Hoja1"); //establecer titulo de hoja

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
$margin = 0.5 / 3.54; // 0.5 centimetros
$marginBottom = 1.2 / 3.54; //1.2 centimetros
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($marginBottom);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($margin);
//fin: establecer margenes






//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);

 $sqlPro=mysql_query("SELECT tr.id_trab,
    CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
    CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab ) AS apellidos,
    tr.apepat_trab, tr.apemat_trab,  tr.nom_trab, tr.est_reg, tr.fecfin_con_ant, tr.fecfin_con_act,
    tr.id_tip_plan, tpla.des_larga AS tipo_planilla,
    tr.id_sucursal, IFNULL(tsua.des_larga,'')  AS sucursal_anexo,
    tr.id_funcion ,  tfun.des_larga AS funcion,
    tr.id_area, tare.des_larga AS area_trab, 
    tr.id_genero, tgen.des_larga AS genero,
    tr.id_tip_doc, tdoc.des_larga AS tipo_documento,
    tr.id_cen_cost, tcco.des_larga AS centro_costos,
    tr.id_tip_man_ob, ttmo.des_larga AS tipo_mano_obra,
    tr.id_categoria, tcal.des_larga AS categoria_laboral,
    tr.id_form_pag, tfop.des_larga AS forma_pago,
    tr.id_tip_cont, tcon.des_larga AS tipo_contrato,
    tr.id_est_civil, teci.des_larga AS estado_civil,
    tr.id_reg_pen, trep.des_larga AS regimen_pensionario,
    tr.id_com_act, ttca.des_larga AS comision_actual,
    tr.id_t_registro, ttre.des_larga AS t_registro,
    tr.num_doc_trab,
    tr.nacionalidad,
    tr.dir_trab,
    tr.urb_trab,
    tr.departamento,
    DATE_FORMAT(tr.fec_nac_trab, '%d/%m/%Y') AS fec_nac_trab,
    tr.lug_nac_trab,
    tr.num_tlf_cel,
    tr.num_tlf_dom,
    tr.email_trab,
    tr.id_turno, ttur.des_larga AS turno,
    DATE_FORMAT(tr.fec_ing_trab, '%d/%m/%Y') AS fec_ing_trab,
    DATE_FORMAT(tr.fec_sal_trab, '%d/%m/%Y') AS fec_sal_trab,
    DATE_FORMAT(tr.fec_ing2, '%d/%m/%Y') AS fec_ing2,
    DATE_FORMAT(tr.fec_sal2, '%d/%m/%Y') AS fec_sal2,
    tr.mot_sal2,
    DATE_FORMAT(tr.fec_ing1, '%d/%m/%Y') AS fec_ing1,
    DATE_FORMAT(tr.fec_sal1, '%d/%m/%Y') AS fec_sal1,
    tr.mot_sal1,
    DATE_FORMAT(tr.fec_ing_interno, '%d/%m/%Y') AS fec_ing_interno,
    DATE_FORMAT(tr.fec_sal_interno, '%d/%m/%Y') AS fec_sal_interno,
    tr.mot_sal_interno,
    tr.sueldo_trab,
    tr.bono_trab,
    tr.bono_des_trab,
    tr.asig_trab,
    tr.id_pag_esp,
    tmpe.des_larga AS pago_especial,
    tr.obs_trab,
    DATE(tr.fecfin_con_act) AS fecfin_con_act,
    DATE(tr.fecfin_con_ant) AS fecfin_con_ant,
    tr.cusp_trab,
    YEAR(CURDATE())-YEAR(tr.fec_nac_trab) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(tr.fec_nac_trab,'%m-%d'), 0 , -1 ) AS edad_trab,
    tr.id_distrito ,
    ubi.Distrito AS distrito,
    tr.nro_cta_cts, 
    tr.nro_cta_sue, 
    tf.nom_pad,
    tf.viv_pad,
    tf.ocu_pad,
    tf.dep_pad,
    tf.tel_pad,
    DATE(tf.fec_rec_dat) AS fec_rec_dat,
    tf.viv_mad,
    tf.nom_mad,
    tf.ocu_mad,
    tf.dep_mad,
    tf.tel_mad,
    tf.viv_con,
    tf.nom_con,
    tf.ocu_con,
    tf.dep_con,
    tf.tel_con,
    DATE(tf.nac_hij1) AS nac_hij1,
    tf.nom_hij1,
    tf.ocu_hij1,
    tf.dep_hij1,
    tf.tel_hij1,
    DATE(tf.nac_hij2) AS nac_hij2,
    tf.nom_hij2,
    tf.ocu_hij2,
    tf.dep_hij2,
    tf.tel_hij2,
    DATE(tf.nac_hij3) AS nac_hij3,
    tf.nom_hij3,
    tf.ocu_hij3,
    tf.dep_hij3,
    tf.tel_hij3,
    DATE(tf.nac_hij4) AS nac_hij4,
    tf.nom_hij4,
    tf.ocu_hij4,
    tf.dep_hij4,
    tf.tel_hij4,
    tf.nom_otro,
    tf.ocu_otro,
    tf.dep_otro,
    tf.tel_otro,
    tf.nom_fam_con,
    tf.par_fam_con,
    tf.are_fam_con,
    te.cen_est_pri,
    te.grado_pri,
    DATE(te.fec_ini_pri)   AS fec_ini_pri, 
    DATE(te.fec_fin_pri)   AS fec_fin_pri,
    te.cen_est_sec,
    te.grado_sec,
    DATE(te.fec_ini_sec) AS fec_ini_sec, 
    DATE(te.fec_fin_sec)   AS fec_fin_sec, 
    te.cen_est_sup,
    te.carrera_sup,
    DATE(te.fec_des_sup)  AS fec_des_sup,  
    DATE(te.fec_has_sup)   AS fec_has_sup, 
    te.cen_est_tec,
    te.carrera_tec,
    DATE(te.fec_ini_tec)   AS fec_ini_tec,
    DATE(te.fec_fin_tec)   AS fec_fin_tec, 
    te.cen_est_esp,
    te.especialidad,
    DATE(te.fec_ini_esp)   AS fec_ini_esp, 
    DATE(te.fec_fin_esp)   AS fec_fin_esp,
    te.cen_est_otros,
    te.carrera_otros,
    DATE(te.fec_ini_otros)  AS fec_ini_otros, 
    DATE(te.fec_fin_otros)  AS fec_fin_otros,
    tc.des_idioma,
    tc.cen_est_idioma,
    tc.nivel_idioma,
    tc.des_comp,
    tc.cen_est_comp,
    tc.nivel_comp,
    tel.nom_emp_exp1,
    tel.car_exp1,
    tel.fun_exp1,
    IF( DATE_FORMAT(tel.fec_ini_exp1, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tel.fec_ini_exp1, '%d/%m/%Y') ) AS fec_ini_exp1,
    IF( DATE_FORMAT(tel.fec_fin_exp1, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tel.fec_fin_exp1, '%d/%m/%Y') ) AS fec_fin_exp1,
    tel.mot_ces_exp1,
    tel.nom_emp_exp2,
    tel.car_exp2,
    tel.fun_exp2,
    IF( DATE_FORMAT(tel.fec_ini_exp2, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tel.fec_ini_exp2, '%d/%m/%Y') ) AS fec_ini_exp2,
    IF( DATE_FORMAT(tel.fec_fin_exp2, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tel.fec_fin_exp2, '%d/%m/%Y') ) AS fec_fin_exp2,
    tel.mot_ces_exp2,
    tel.nom_emp_exp3,
    tel.car_exp3,
    tel.fun_exp3,
    IF( DATE_FORMAT(tel.fec_ini_exp3, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tel.fec_ini_exp3, '%d/%m/%Y') ) AS fec_ini_exp3,
    IF( DATE_FORMAT(tel.fec_fin_exp3, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tel.fec_fin_exp3, '%d/%m/%Y') ) AS fec_fin_exp3,
    tel.mot_ces_exp3,
    ts.tie_enf_car_onc,
    ts.nom_enf_car_onc,
    ts.tie_enf_ale_rec,
    tr.id_gru_san,
    tgsa.des_larga AS grupo_sanguineo,
    tr.talla,
    tr.peso,
    ta.afi_onp,
    ta.afi_afp,
    ta.nom_afi_afp,
    tda.foto_trab,
    tda.dat_hij1,
    tda.dat_hij2,
    tda.dat_hij3,
    tda.dat_hij4,
    tda.dat_con,
    tda.dat_ant_pol,
    tda.dat_luz_agua,
    tda.dat_cer_med,
    tda.dat_dec_dom,
    tda.dat_cv,
    tda.dat_gra_tit,
    tda.dat_idi,
    tda.dat_cer_tec,
    tda.dat_adi,
    tda.dat_cer_tra1,
    tda.dat_cer_tra2,
    tda.dat_cer_tra3,
    tda.dat_cer_res1,
    tda.dat_cer_res2,
    tda.dat_cer_res3,
    tda.dat_pas,
    tda.dat_bre,
    tda.dat_pla_liq1,
    tda.dat_pla_liq2,
    tda.dat_pla_liq3,
    tda.dat_int_liq1,
    tda.dat_int_liq2,
    tda.dat_int_liq3,
    tda.dat_car_ret_cts1,
    tda.dat_car_ret_cts2,
    tda.dat_car_ret_cts3,
    tda.dat_alt_reg1,
    tda.dat_alt_reg2,
    tda.dat_alt_reg3,
    tda.dat_baj_reg1,
    tda.dat_baj_reg2,
    tda.dat_baj_reg3,
    tda.dat_car_ren,
    IFNULL(MAX(vac.correlativo),0) AS CantItems
        FROM trabajador tr
        LEFT JOIN tabla_maestra_detalle AS tpla ON
        tpla.cod_argumento= tr.id_tip_plan
        AND tpla.cod_tabla='TPLA'
        LEFT JOIN tabla_maestra_detalle AS tsua ON
        tsua.cod_argumento= tr.id_sucursal
        AND tsua.cod_tabla='TSUA' OR tsua.cod_tabla IS NULL
        LEFT JOIN tabla_maestra_detalle AS tfun ON
        tfun.cod_argumento= tr.id_funcion
        AND tfun.cod_tabla='TFUN'
        LEFT JOIN tabla_maestra_detalle AS tare ON
        tare.cod_argumento= tr.id_area
        AND tare.cod_tabla='TARE'
        LEFT JOIN tabla_maestra_detalle AS tgen ON
        tgen.cod_argumento= tr.id_genero
        AND tgen.cod_tabla='TGEN' 
        LEFT JOIN tabla_maestra_detalle AS tdoc ON
        tdoc.cod_argumento= tr.id_tip_doc
        AND tdoc.cod_tabla='TDOC' 
        LEFT JOIN tabla_maestra_detalle AS tcco ON
        tcco.cod_argumento= tr.id_cen_cost
        AND tcco.cod_tabla='TCCO' 
        LEFT JOIN tabla_maestra_detalle AS ttmo ON
        ttmo.cod_argumento= tr.id_tip_man_ob
        AND ttmo.cod_tabla='TTMO' 
        LEFT JOIN tabla_maestra_detalle AS tcal ON
        tcal.cod_argumento= tr.id_categoria
        AND tcal.cod_tabla='TCAL' 
          LEFT JOIN tabla_maestra_detalle AS tfop ON
        tfop.cod_argumento= tr.id_form_pag
        AND tfop.cod_tabla='TFOP' 
        LEFT JOIN tabla_maestra_detalle AS tcon ON
        tcon.cod_argumento= tr.id_tip_cont
        AND tcon.cod_tabla='TCON' 
        LEFT JOIN tabla_maestra_detalle AS teci ON
        teci.cod_argumento= tr.id_est_civil
        AND teci.cod_tabla='TECI' 
        LEFT JOIN tabla_maestra_detalle AS trep ON
        trep.cod_argumento= tr.id_reg_pen
        AND trep.cod_tabla='TREP' 
        LEFT JOIN tabla_maestra_detalle AS ttca ON
        ttca.cod_argumento= tr.id_com_act
        AND ttca.cod_tabla='TTCA' 
        LEFT JOIN tabla_maestra_detalle AS ttre ON
        ttre.cod_argumento= tr.id_t_registro
        AND ttre.cod_tabla='TTRE' 
        LEFT JOIN tabla_maestra_detalle AS ttur ON
        ttur.cod_argumento= tr.id_turno
        AND ttur.cod_tabla='TTUR'
        LEFT JOIN tabla_maestra_detalle AS tgsa ON
        tgsa.cod_argumento= tr.id_gru_san
        AND tgsa.cod_tabla='TGSA'
        LEFT JOIN tabla_maestra_detalle AS tmpe ON
        tmpe.cod_argumento= tr.id_pag_esp
        AND tmpe.cod_tabla='TMPE'
        LEFT JOIN ubigeo AS ubi ON
        ubi.coddist= tr.id_distrito
        AND ubi.coddpto='15' 
        AND ubi.codprov='01'
        LEFT JOIN trabajador_familia AS tf ON
        tf.id_trab= tr.id_trab
        LEFT JOIN trabajador_estudios AS te ON
        te.id_trab= tr.id_trab
        LEFT JOIN trabajador_conocimiento AS tc ON
        tc.id_trab= tr.id_trab
        LEFT JOIN trabajador_salud AS ts ON
        ts.id_trab= tr.id_trab
        LEFT JOIN trabajador_afiliacion AS ta ON
        ta.id_trab= tr.id_trab
        LEFT JOIN trabajador_data_adjunta AS tda ON
        tda.id_trab= tr.id_trab
        LEFT JOIN trabajador_exp_laboral AS tel ON
        tel.id_trab= tr.id_trab
        LEFT JOIN vacaciones AS vac ON
        vac.nro_doc= tr.num_doc_trab
       WHERE tr.id_trab=$id_trab" ) or die(mysql_error());





  $resPro=mysql_fetch_array($sqlPro);

  $fila=2;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'CORPORACION VASCO S.A.C.');

  $fila=3;
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'SOLICITUD DE EMPLEO');
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "D$fila:I$fila"); //establecer estilo



  

  $fila=4;






  $fila=7;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "I. DATOS A PERSONALES:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:D$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);







  $fila=8;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["apellidos"]));
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($resPro["nom_trab"]));
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:L$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $fila=9;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "APELLIDOS");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "NOMBRES");
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:L$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $fila=10;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["dir_trab"]));
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["urb_trab"]));
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($resPro["distrito"]));
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:J$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($resPro["departamento"]));
  $objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=11;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "DIRECCION");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "URBANIZACION");
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "DISTRITO");
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:J$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", "DEPARTAMENTO");
  $objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $fila=12;

  $fila=13;

  $fila=14;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["fec_nac_trab"]));
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["lug_nac_trab"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["edad_trab"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($resPro["nacionalidad"]));
  $objPHPExcel->getActiveSheet()->mergeCells("H$fila:J$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($resPro["estado_civil"]));
  $objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=15;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "FEC.NACIMIENTO");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", "LUGAR DE NACIMIENTO");
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "EDAD");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "NACIONALIDAD");
  $objPHPExcel->getActiveSheet()->mergeCells("H$fila:J$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "H$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", "ESTADO CIVIL");
  $objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet() ->setSharedStyle($bordes, "B$fila:L$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);




  $fila=16;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["num_doc_trab"]));
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["num_tlf_dom"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($resPro["num_tlf_cel"]));
  $objPHPExcel->getActiveSheet()->mergeCells("F$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($resPro["email_trab"]));
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:L$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo




  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=17;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "D.N.I");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", "TELF.DOMICILIO");
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", "CELULAR");
  $objPHPExcel->getActiveSheet()->mergeCells("F$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "E-MAIL");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:L$fila");


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=18;

  $fila=19;

  $fila=20;

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "II. EXPERIENCIA LABORAL(Comenzar por el mas reciente)");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

  $fila=21;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "EMPRESA");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:D$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", "CARGO");
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "FUNCIONES");
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "G$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "DESDE");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "HASTA");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", "MOTIVO CESE");
  $objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=22;

 
   




  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["nom_emp_exp1"]));
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:D$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["car_exp1"]));
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["fun_exp1"]));
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($resPro["fec_ini_exp1"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["fec_fin_exp1"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($resPro["mot_ces_exp1"]));
  $objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);







  


  $fila=23;

   $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["nom_emp_exp2"]));
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:D$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["car_exp2"]));
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["fun_exp2"]));
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($resPro["fec_ini_exp2"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["fec_fin_exp2"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($resPro["mot_ces_exp2"]));
  $objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);





  


  $fila=24;

   $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["nom_emp_exp3"]));
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:D$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["car_exp3"]));
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($resPro["fun_exp3"]));
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:H$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($resPro["fec_ini_exp3"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($resPro["fec_fin_exp3"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "J$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($resPro["mot_ces_exp3"]));
  $objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$fila"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:L$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



  $fila+=1;


  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "SUCURSAL:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["sucursal_anexo"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:G$fila");
  

  $fila+=1;

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "AREA:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["area_trab"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:G$fila");


  $fila+=1;

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "FUNCION:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["funcion"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:G$fila");

 
  $fila+=1;

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "TURNO");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["turno"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:G$fila");


  $fila+=1;
  
  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "FECHA INGRESO:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["fec_ing_trab"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:G$fila");


  $fila+=1;
  
  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "COND.LABORAL:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["tipo_planilla"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:G$fila");

  
  $fila+=1;
  
  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "REMUNERACION:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["sueldo_trab"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:G$fila");

  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

  $fila+=1;
  
  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "BONO:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["bono_trab"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:G$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);



  $fila+=1;


  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "BONO DESTAJO:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["bono_des_trab"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:G$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);




  $sql1=mysql_query("SELECT * FROM  trabajador tr where tr.id_trab=$id_trab") or die(mysql_error());




  $res1=mysql_fetch_array($sql1);

  $fila+=1;




  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(1);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(9);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(9);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(11);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(11);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(8);



//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');

//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo

// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");

// nombre del archivo
header('Content-Disposition: attachment; filename="HojaDeEmpleo.xls"');
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
