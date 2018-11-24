var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	mostrarform_datos(false);
	mostrarform_data_adjunta(false);



	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$("#formulariodatos").on("submit",function(e)
	{
		guardaryeditardatos(e);	
	})


	$("#formulario_data_adjunta").on("submit",function(e)
	{
		guardaryeditar_data_adjunta(e);	
	})



	//Cargamos los items al select funcion del trabajador
	$.post("../ajax/consultasD.php?op=selectFuncion", function(r){
	            $("#id_funcion").html(r);  
	            $('#id_funcion').selectpicker('refresh');

	});


	//Cargamos los items al select area del trabajador
	$.post("../ajax/consultasD.php?op=selectArea", function(r){
	            $("#id_area").html(r);
	            $('#id_area').selectpicker('refresh');

	});


	//Cargamos los items al select tipo de documento
	$.post("../ajax/consultasD.php?op=selectTipoDocumento", function(r){
	            $("#id_tip_doc").html(r);
	            $('#id_tip_doc').selectpicker('refresh');

	});


	//Cargamos los items al select tipo de planilla
	$.post("../ajax/consultasD.php?op=selectTipoPlanilla", function(r){
	            $("#id_tip_plan").html(r);
	            $('#id_tip_plan').selectpicker('refresh');

	});


   //Cargamos los items al select tipo de planilla
	$.post("../ajax/consultasD.php?op=selectCentroCostos", function(r){
	            $("#id_cen_cost").html(r);
	            $('#id_cen_cost').selectpicker('refresh');

	});


	//Cargamos los items al select tipo de planilla
	$.post("../ajax/consultasD.php?op=selectManoDeObra", function(r){
	            $("#id_tip_man_ob").html(r);
	            $('#id_tip_man_ob').selectpicker('refresh');

	});



	//Cargamos los items al select tipo de planilla
	$.post("../ajax/consultasD.php?op=selectSucursal", function(r){
	            $("#id_sucursal").html(r);
	            $('#id_sucursal').selectpicker('refresh');

	});



	//Cargamos los items al select categoria laboral
	$.post("../ajax/consultasD.php?op=selectCategoriaLaboral", function(r){
	            $("#id_categoria").html(r);
	            $('#id_categoria').selectpicker('refresh');

	});


	//Cargamos los items al select categoria laboral
	$.post("../ajax/consultasD.php?op=selectFormaDePago", function(r){
	            $("#id_form_pag").html(r);
	            $('#id_form_pag').selectpicker('refresh');

	});



	//Cargamos los items al select categoria laboral
	$.post("../ajax/consultasD.php?op=selectTipoContrato", function(r){
	            $("#id_tip_cont").html(r);
	            $('#id_tip_cont').selectpicker('refresh');

	});


	//Cargamos los items al select estado civil
	$.post("../ajax/consultasD.php?op=selectEstadoCivil", function(r){
	            $("#id_est_civil").html(r);
	            $('#id_est_civil').selectpicker('refresh');

	});



	//Cargamos los items al select regimen pensionario
	$.post("../ajax/consultasD.php?op=selectRegimenPensionario", function(r){
	            $("#id_reg_pen").html(r);
	            $('#id_reg_pen').selectpicker('refresh');

	});



	//Cargamos los items al select comision actual
	$.post("../ajax/consultasD.php?op=selectComisionActual", function(r){
	            $("#id_com_act").html(r);
	            $('#id_com_act').selectpicker('refresh');

	});




	//Cargamos los items al select genero
	$.post("../ajax/consultasD.php?op=selectGenero", function(r){
	            $("#id_genero").html(r);
	            $('#id_genero').selectpicker('refresh');

	});



	//Cargamos los items al select t registro
	$.post("../ajax/consultasD.php?op=selectTRegistro", function(r){
	            $("#id_t_registro").html(r);
	            $('#id_t_registro').selectpicker('refresh');

	});



	//Cargamos los items al select turno
	$.post("../ajax/consultasD.php?op=selectTurno", function(r){
	            $("#id_turno").html(r);
	            $('#id_turno').selectpicker('refresh');

	});


	//Cargamos los items al select distrito
	$.post("../ajax/consultasD.php?op=selectDistrito", function(r){
	            $("#id_distrito").html(r);
	            $('#id_distrito').selectpicker('refresh');

	});


	//Cargamos los items al select grupo sanguineo
	$.post("../ajax/consultasD.php?op=selectGrupoSanguineo", function(r){
	            $("#id_gru_san").html(r);
	            $('#id_gru_san').selectpicker('refresh');

	});



	//Cargamos los items al select grupo sanguineo
	$.post("../ajax/consultasD.php?op=selectPagoEspecial", function(r){
	            $("#id_pag_esp").html(r);
	            $('#id_pag_esp').selectpicker('refresh');

	});








    $("#foto_trab_muestra").hide();
    $("#dni_trab_muestra").hide();
	$("#dat_hij1_muestra").hide();
	$("#dat_hij2_muestra").hide();
    $("#dat_hij3_muestra").hide();
	$("#dat_hij4_muestra").hide();
	$("#dat_con_muestra").hide();

	$("#dat_ant_pol_muestra").hide();
    $("#dat_luz_agua_muestra").hide();
	$("#dat_cer_med_muestra").hide();
	$("#dat_dec_dom_muestra").hide();
	$("#dat_cv_muestra").hide();


	$("#dat_gra_tit_muestra").hide();
    $("#dat_dip_cur_esp_muestra").hide();
    $("#dat_adi_muestra").hide();
    $("#dat_liquidacion_muestra").hide();
	
	$("#dat_idi_muestra").hide();
	$("#dat_cer_tec_muestra").hide();
	$("#dat_adi_muestra").hide();
	$("#dat_cer_tra1_muestra").hide();
	$("#dat_pas_muestra").hide();
	$("#dat_bre_muestra").hide();
	$("#dat_pla_liq1_muestra").hide();
	$("#dat_car_ret_cts1_muestra").hide();
	$("#dat_car_ren_muestra").hide();




}

//Función limpiar
function limpiar()
{
	$("#nom_trab").val("");
	$("#apepat_trab").val("");
	$("#apemat_trab").val("");
	$("#id_trab").val("");
	$("#dir_trab").val("");
	$("#urb_trab").val("");

	
	$("#id_distrito").val("LIMA");
	$("#id_distrito").selectpicker('refresh');



	$("#departamento").val("");
	$("#fec_nac_trab").val("");
	$("#lug_nac_trab").val("");
	$("#edad_trab").val("");
	$("#nacionalidad").val("");
	$("#id_est_civil").val("");
	

	$("#id_tip_doc").val("DNI");
	$("#id_tip_doc").selectpicker('refresh');


	$("#num_doc_trab").val("");
	$("#num_tlf_dom").val("");
	$("#num_tlf_cel").val("");
	$("#email_trab").val("");
	

	$("#id_sucursal").val("CORP.VASCO");
	$("#id_sucursal").selectpicker('refresh');

	$("#id_funcion").val("ASISTENTE");
	$("#id_funcion").selectpicker('refresh');

	$("#id_area").val("ADMINISTRACIÓN");
	$("#id_area").selectpicker('refresh');

	$("#id_turno").val("DIA");
	$("#id_turno").selectpicker('refresh');

	$("#id_tip_plan").val("INTERNO");
	$("#id_tip_plan").selectpicker('refresh');


	$("#fec_ing_trab").val("");
	$("#fec_sal_trab").val("");
	$("#sueldo_trab").val("");
	$("#fec_ing2").val("");
	$("#fec_sal2").val("");
	$("#mot_sal2").val("");
	$("#bono_trab").val("");
	$("#bono_des_trab").val("");

	$("#id_pag_esp").val("NINGUNO");
	$("#id_pag_esp").selectpicker('refresh');

	$("#fec_ing1").val("");
	$("#fec_sal1").val("");
	$("#mot_sal1").val("");
	$("#asig_trab").val("");
	$("#fec_ing_interno").val("");
	$("#fec_sal_interno").val("");
	$("#mot_sal_interno").val("");
	$("#obs_trab").val("");
	$("#id_cen_cost").val("");

	
	$("#id_tip_man_ob").val("MANO DE OBRA DIRECTA");
	$("#id_tip_man_ob").selectpicker('refresh');

	$("#id_categoria").val("OBRERO");
	$("#id_categoria").selectpicker('refresh');

	$("#id_form_pag").val("NORMAL");
	$("#id_form_pag").selectpicker('refresh');

	$("#id_tip_cont").val("");
	$("#id_reg_pen").val("");
	$("#id_com_act").val("");
	

	//Marcamos el primer tipo_documento
   	$("#id_genero").val("FEMENINO");
	$("#id_genero").selectpicker('refresh');

	$("#nro_cta_sue").selectpicker('nro_cta_sue');
	$("#nro_cta_cts").selectpicker('nro_cta_cts');
	



	$("#fecfin_con_ant").val("");
	$("#fecfin_con_act").val("");
	$("#cusp_trab").val("");
	$("#viv_pad").val("");
	$("#nom_pad").val("");
	$("#ocu_pad").val("");
	$("#dep_pad").val("");
	$("#tel_pad").val("");
	$("#fec_rec_dat").val("");
	$("#viv_mad").val("");
	$("#nom_mad").val("");
	$("#ocu_mad").val("");
	$("#dep_mad").val("");
	$("#tel_mad").val("");
	$("#viv_con").val("");
	$("#nom_con").val("");
	$("#ocu_con").val("");
	$("#dep_con").val("");
	$("#tel_con").val("");
	$("#prueba").val("");
	$("#nac_hij1").val("");
	$("#nom_hij1").val("");
	$("#ocu_hij1").val("");
	$("#dep_hij1").val("");
	$("#nac_hij2").val("");
	$("#nom_hij2").val("");
	$("#ocu_hij2").val("");
	$("#dep_hij2").val("");
	$("#nac_hij3").val("");
	$("#nom_hij3").val("");
	$("#ocu_hij3").val("");
	$("#dep_hij3").val("");
	$("#nac_hij4").val("");
	$("#nom_hij4").val("");
	$("#ocu_hij4").val("");
	$("#dep_hij4").val("");
	$("#nom_otro").val("");
	$("#ocu_otro").val("");
	$("#dep_otro").val("");
	$("#nom_fam_con").val("");
	$("#par_fam_con").val("");
	$("#are_fam_con").val("");
	$("#cen_est_pri").val("");
	$("#grado_pri").val("");
	$("#fec_ini_pri").val("");
	$("#fec_fin_pri").val("");
	$("#cen_est_sec").val("");
	$("#grado_sec").val("");
	$("#fec_ini_sec").val("");
	$("#fec_fin_sec").val("");
	$("#cen_est_sup").val("");
	$("#carrera_sup").val("");
	$("#fec_des_sup").val("");
	$("#fec_has_sup").val("");
	$("#cen_est_tec").val("");
	$("#carrera_tec").val("");
	$("#fec_ini_tec").val("");
	$("#fec_fin_tec").val("");
	$("#cen_est_esp").val("");
	$("#especialidad").val("");
	$("#fec_ini_esp").val("");
	$("#fec_fin_esp").val("");
	$("#cen_est_otros").val("");
	$("#carrera_otros").val("");
	$("#fec_ini_otros").val("");
	$("#fec_fin_otros").val("");
	$("#des_idioma").val("");
	$("#cen_est_idioma").val("");
	$("#nivel_idioma").val("");
	$("#des_comp").val("");
	$("#cen_est_comp").val("");
	$("#nivel_comp").val("");

	$("#nom_emp_exp1").val("");
	$("#car_exp1").val("");
	$("#fun_exp1").val("");
	$("#fec_ini_exp1").val("");
	$("#fec_fin_exp1").val("");
	$("#mot_ces_exp1").val("");

	$("#nom_emp_exp2").val("");
	$("#car_exp2").val("");
	$("#fun_exp2").val("");
	$("#fec_ini_exp2").val("");
	$("#fec_fin_exp2").val("");
	$("#mot_ces_exp2").val("");

	$("#nom_emp_exp3").val("");
	$("#car_exp3").val("");
	$("#fun_exp3").val("");
	$("#fec_ini_exp3").val("");
	$("#fec_fin_exp3").val("");
	$("#mot_ces_exp3").val("");



	$("#tie_enf_car_onc").val("");
	$("#tie_enf_ale_rec").val("");
	$("#nom_enf_car_onc").val("");
	$("#afi_onp").val("");
	$("#afi_afp").val("");
	$("#nom_afi_afp").val("");
	$("#codigo").val("");
	



	$("#id_trab_data_adjunta").val("");



	$("#foto_trab_muestra").attr("src","");
	$("#imagenactual_foto_trab").val("");
	$("#foto_trab").attr("src","");


	$("#dni_trab_muestra").attr("src","");
	$("#imagenactual_dni_trab").val("");
	$("#dni_trab").attr("src","");



	$("#dat_ant_pol_muestra").attr("src","");
	$("#imagenactual_dat_ant_pol").val("");
	$("#dat_ant_pol").attr("src","");





	$("#dat_hij1_muestra").attr("src","");
	$("#imagenactual_dat_hij1").val("");
	$("#dat_hij1").attr("src","");


	$("#dat_hij2_muestra").attr("src","");
	$("#imagenactual_dat_hij2").val("");


	$("#dat_hij3_muestra").attr("src","");
	$("#imagenactual_dat_hij3").val("");


	$("#dat_hij4_muestra").attr("src","");
	$("#imagenactual_dat_hij4").val("");


	$("#dat_con_muestra").attr("src","");
	$("#imagenactual_dat_con").val("");


	$("#dat_luz_agua_muestra").attr("src","");
	$("#imagenactual_dat_luz_agua").val("");
	$("#dat_luz_agua").attr("src","");


	$("#dat_cer_med_muestra").attr("src","");
	$("#imagenactual_dat_cer_med").val("");
	$("#dat_cer_med").attr("src","");


	$("#dat_dec_dom_muestra").attr("src","");
	$("#imagenactual_dat_dec_dom").val("");
	$("#dat_dec_dom").attr("src","");


	$("#dat_cv_muestra").attr("src","");
	$("#imagenactual_dat_cv").val("");
    $("#dat_cv").attr("src","");


	$("#dat_gra_tit_muestra").attr("src","");
	$("#imagenactual_dat_gra_tit").val("");
	$("#dat_gra_tit").attr("src","");

	$("#dat_dip_cur_esp_muestra").attr("src","");
	$("#imagenactual_dat_dip_cur_esp").val("");
	$("#dat_dip_cur_esp").attr("src","");


	


	$("#dat_idi_muestra").attr("src","");
	$("#imagenactual_dat_idi").val("");

	$("#dat_cer_tec_muestra").attr("src","");
	$("#imagenactual_dat_cer_tec").val("");


	$("#dat_adi_muestra").attr("src","");
	$("#imagenactual_dat_adi").val("");
	$("#dat_adi").attr("src","");


	$("#dat_cer_tra1_muestra").attr("src","");
	$("#imagenactual_dat_cer_tra1").val("");
	$("#dat_cer_tra1").attr("src","");


	$("#dat_cer_tra2_muestra").attr("src","");
	$("#imagenactual_dat_cer_tra2").val("");

	$("#dat_cer_tra3_muestra").attr("src","");
	$("#imagenactual_dat_cer_tra3").val("");

	$("#dat_cer_res1_muestra").attr("src","");
	$("#imagenactual_dat_cer_res1").val("");

	$("#dat_cer_res2_muestra").attr("src","");
	$("#imagenactual_dat_cer_res2").val("");

	$("#dat_cer_res3_muestra").attr("src","");
	$("#imagenactual_dat_cer_res3").val("");




	$("#dat_pas_muestra").attr("src","");
	$("#imagenactual_dat_pas").val("");
	$("#dat_pas").attr("src","");


	$("#dat_bre_muestra").attr("src","");
	$("#imagenactual_dat_bre").val("");
	$("#dat_bre").attr("src","");

	$("#dat_liquidacion_muestra").attr("src","");
	$("#imagenactual_dat_liquidacion").val("");
	$("#dat_liquidacion").attr("src","");


	$("#dat_pla_liq1_muestra").attr("src","");
	$("#imagenactual_dat_pla_liq1").val("");

	$("#dat_pla_liq2_muestra").attr("src","");
	$("#imagenactual_dat_pla_liq2").val("");

	$("#dat_pla_liq3_muestra").attr("src","");
	$("#imagenactual_dat_pla_liq3").val("");

	$("#dat_int_liq1_muestra").attr("src","");
	$("#imagenactual_dat_int_liq1").val("");

	$("#dat_int_liq2_muestra").attr("src","");
	$("#imagenactual_dat_int_liq2").val("");

	$("#dat_int_liq3_muestra").attr("src","");
	$("#imagenactual_dat_int_liq3").val("");





	$("#dat_car_ret_cts1_muestra").attr("src","");
	$("#imagenactual_dat_car_ret_cts1").val("");

	$("#dat_car_ret_cts2_muestra").attr("src","");
	$("#imagenactual_dat_car_ret_cts2").val("");

	$("#dat_car_ret_cts3_muestra").attr("src","");
	$("#imagenactual_dat_car_ret_cts3").val("");



	$("#dat_alt_reg1_muestra").attr("src","");
	$("#imagenactual_dat_alt_reg1").val("");

	$("#dat_alt_reg2_muestra").attr("src","");
	$("#imagenactual_dat_alt_reg2").val("");

	$("#dat_alt_reg3_muestra").attr("src","");
	$("#imagenactual_dat_alt_reg3").val("");



	$("#dat_baj_reg1_muestra").attr("src","");
	$("#imagenactual_dat_baj_reg1").val("");

	$("#dat_baj_reg2_muestra").attr("src","");
	$("#imagenactual_dat_baj_reg2").val("");

	$("#dat_baj_reg3_muestra").attr("src","");
	$("#imagenactual_dat_baj_reg3").val("");



	$("#dat_car_ren_muestra").attr("src","");
	$("#imagenactual_dat_car_ren").val("");

	


	$("#print").hide();











}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#formularioregistrosdatos").hide();
		$("#formularioregistros_data_adjunta").hide();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#formularioregistrosdatos").hide();
		$("#formularioregistros_data_adjunta").hide();
		$("#btnagregar").show();
	}
}


//Función mostrar formulario
function mostrarform_datos(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").hide();
		$("#formularioregistrosdatos").show();
		$("#formularioregistros_data_adjunta").hide();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#formularioregistrosdatos").hide();
		$("#formularioregistros_data_adjunta").hide();
		$("#btnagregar").show();
	}
}


//Función mostrar formulario
function mostrarform_data_adjunta(flag)
{
	limpiar(); 
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").hide();
		$("#formularioregistrosdatos").hide();
		$("#formularioregistros_data_adjunta").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#formularioregistrosdatos").hide();
		$("#formularioregistros_data_adjunta").hide();
		$("#btnagregar").show();
	}
}






//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            
		        ],
		"ajax":
				{
					url: '../ajax/trabajador.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/trabajador.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}



function guardaryeditardatos(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulariodatos")[0]);

	$.ajax({
		url: "../ajax/trabajador.php?op=guardaryeditar_datos",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}



function guardaryeditar_data_adjunta(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario_data_adjunta")[0]);

	$.ajax({
		url: "../ajax/trabajador.php?op=guardaryeditar_data_adjunta",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}




function mostrar(id_trab)
{
	$.post("../ajax/trabajador.php?op=mostrar",{id_trab : id_trab}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#id_funcion").val(data.id_funcion);
		$('#id_funcion').selectpicker('refresh'); 

        $("#id_genero").val(data.id_genero);
		$('#id_genero').selectpicker('refresh'); 

		$("#id_tip_doc").val(data.id_tip_doc);
		$('#id_tip_doc').selectpicker('refresh'); 

		$("#id_tip_plan").val(data.id_tip_plan);
		$('#id_tip_plan').selectpicker('refresh');

		$("#id_sucursal").val(data.id_sucursal);
		$('#id_sucursal').selectpicker('refresh');

		$("#id_area").val(data.id_area);
		$('#id_area').selectpicker('refresh'); 

		$("#id_cen_cost").val(data.id_cen_cost);
		$('#id_cen_cost').selectpicker('refresh'); 

		$("#id_tip_man_ob").val(data.id_tip_man_ob);
		$('#id_tip_man_ob').selectpicker('refresh'); 

		$("#id_categoria").val(data.id_categoria);
		$('#id_categoria').selectpicker('refresh');

		$("#id_form_pag").val(data.id_form_pag);
		$('#id_form_pag').selectpicker('refresh');

		$("#id_tip_cont").val(data.id_tip_cont);
		$('#id_tip_cont').selectpicker('refresh');

		$("#id_est_civil").val(data.id_est_civil);
		$('#id_est_civil').selectpicker('refresh');

		$("#id_reg_pen").val(data.id_reg_pen);
		$('#id_reg_pen').selectpicker('refresh');

		$("#id_com_act").val(data.id_com_act);
		$('#id_com_act').selectpicker('refresh');

		$("#id_t_registro").val(data.id_t_registro);
		$('#id_t_registro').selectpicker('refresh');

		$("#id_turno").val(data.id_turno);
		$('#id_turno').selectpicker('refresh');

		$("#id_distrito").val(data.id_distrito);
		$('#id_distrito').selectpicker('refresh');


		$("#id_tip_doc").val(data.id_tip_doc);
		$('#id_tip_doc').selectpicker('refresh');


		$("#id_pag_esp").val(data.id_pag_esp);
		$('#id_pag_esp').selectpicker('refresh');


		$("#id_trab").val(data.id_trab);
		$("#nom_trab").val(data.nom_trab);
		$("#apepat_trab").val(data.apepat_trab);
		$("#apemat_trab").val(data.apemat_trab);
		$("#num_doc_trab").val(data.num_doc_trab);
		$("#dir_trab").val(data.dir_trab);
		$("#urb_trab").val(data.urb_trab);
		$("#fec_nac_trab").val(data.fec_nac_trab);
		$("#lug_nac_trab").val(data.lug_nac_trab);
		$("#num_tlf_dom").val(data.num_tlf_dom);
		$("#num_tlf_cel").val(data.num_tlf_cel);
		$("#email_trab").val(data.email_trab);
		$("#sueldo_trab").val(data.sueldo_trab);
		$("#bono_trab").val(data.bono_trab);
		$("#bono_des_trab").val(data.bono_des_trab); 
		$("#asig_trab").val(data.asig_trab);
		$("#obs_trab").val(data.obs_trab);
		$("#cusp_trab").val(data.cusp_trab);
		$("#nacionalidad").val(data.nacionalidad);
		$("#departamento").val(data.departamento);
		$("#edad_trab").val(data.edad_trab);

        $("#fec_ing_trab").val(data.fec_ing_trab);
		$("#fec_sal_trab").val(data.fec_sal_trab);

		$("#fec_ing2").val(data.fec_ing2);
		$("#fec_sal2").val(data.fec_sal2);
		$("#mot_sal2").val(data.mot_sal2);

		$("#fec_ing1").val(data.fec_ing1);
		$("#fec_sal1").val(data.fec_sal1);
		$("#mot_sal1").val(data.mot_sal1);

		$("#fec_sal_interno").val(data.fec_sal_interno);
		$("#fec_ing_interno").val(data.fec_ing_interno);
		$("#mot_sal_interno").val(data.mot_sal_interno);

		$("#fecfin_con_ant").val(data.fecfin_con_ant);
		$("#fecfin_con_act").val(data.fecfin_con_act);


		

		$("#CantItems").val(data.CantItems);

		$("#nro_cta_sue").val(data.nro_cta_sue);
		$("#nro_cta_cts").val(data.nro_cta_cts);
		
		


	
		


 	})
}




function mostrar_datos(id_trab)
{
	$.post("../ajax/trabajador.php?op=mostrar",{id_trab : id_trab}, function(data, status)
	{
		
		data = JSON.parse(data);		
		mostrarform_datos(true);


		

		$("#prueba").val(data.id_trab);
		$("#codigo").val(data.id_trab);

		$("#viv_pad").val(data.viv_pad);
		$("#nom_pad").val(data.nom_pad);
		$("#ocu_pad").val(data.ocu_pad);
		$("#dep_pad").val(data.dep_pad);
		$("#tel_pad").val(data.tel_pad);
		$("#fec_rec_dat").val(data.fec_rec_dat);
				

		$("#viv_mad").val(data.viv_mad);
		$("#nom_mad").val(data.nom_mad);
		$("#ocu_mad").val(data.ocu_mad);
		$("#dep_mad").val(data.dep_mad);
		$("#tel_mad").val(data.tel_mad);

		$("#viv_con").val(data.viv_con);
		$("#nom_con").val(data.nom_con);
		$("#ocu_con").val(data.ocu_con);
		$("#dep_con").val(data.dep_con);
		$("#tel_con").val(data.tel_con);


		$("#nac_hij1").val(data.nac_hij1);
		$("#nom_hij1").val(data.nom_hij1);
		$("#ocu_hij1").val(data.ocu_hij1);
		$("#dep_hij1").val(data.dep_hij1);
		$("#tel_hij1").val(data.tel_hij1);

		$("#dat_hij1_muestra").show();
		$("#dat_hij1_muestra").attr("src","../files/trabajador_familia/"+data.dat_hij1);
		$("#dat_hij1_actual").val(data.dat_hij1);



		$("#nac_hij2").val(data.nac_hij2);
		$("#nom_hij2").val(data.nom_hij2);
		$("#ocu_hij2").val(data.ocu_hij2);
		$("#dep_hij2").val(data.dep_hij2);
		$("#tel_hij2").val(data.tel_hij2);


		$("#nac_hij3").val(data.nac_hij3);
		$("#nom_hij3").val(data.nom_hij3);
		$("#ocu_hij3").val(data.ocu_hij3);
		$("#dep_hij3").val(data.dep_hij3);
		$("#tel_hij3").val(data.tel_hij3);

        $("#nac_hij4").val(data.nac_hij4);
		$("#nom_hij4").val(data.nom_hij4);
		$("#ocu_hij4").val(data.ocu_hij4);
		$("#dep_hij4").val(data.dep_hij4);
		$("#tel_hij4").val(data.tel_hij4);

		$("#nom_otro").val(data.nom_otro);
		$("#ocu_otro").val(data.ocu_otro);
		$("#dep_otro").val(data.dep_otro);
		$("#tel_otro").val(data.tel_otro);


		$("#nom_fam_con").val(data.nom_fam_con);
		$("#par_fam_con").val(data.par_fam_con);
		$("#are_fam_con").val(data.are_fam_con);

		$("#cen_est_pri").val(data.cen_est_pri);
		$("#grado_pri").val(data.grado_pri);
		$("#fec_ini_pri").val(data.fec_ini_pri);
		$("#fec_fin_pri").val(data.fec_fin_pri);
		$("#cen_est_sec").val(data.cen_est_sec);
		$("#grado_sec").val(data.grado_sec);
		$("#fec_ini_sec").val(data.fec_ini_sec);
		$("#fec_fin_sec").val(data.fec_fin_sec);
		$("#cen_est_sup").val(data.cen_est_sup);
		$("#carrera_sup").val(data.carrera_sup);
		$("#fec_des_sup").val(data.fec_des_sup);
		$("#fec_has_sup").val(data.fec_has_sup);
		$("#cen_est_tec").val(data.cen_est_tec);
		$("#carrera_tec").val(data.carrera_tec);
		$("#fec_ini_tec").val(data.fec_ini_tec);
		$("#fec_fin_tec").val(data.fec_fin_tec);


		$("#cen_est_esp").val(data.cen_est_esp);
        $("#especialidad").val(data.especialidad);
		$("#fec_ini_esp").val(data.fec_ini_esp);
		$("#fec_fin_esp").val(data.fec_fin_esp);
		$("#cen_est_otros").val(data.cen_est_otros);
		$("#carrera_otros").val(data.carrera_otros);
		$("#fec_ini_otros").val(data.fec_ini_otros);
		$("#fec_fin_otros").val(data.fec_fin_otros);


		$("#des_idioma").val(data.des_idioma);
		$("#cen_est_idioma").val(data.cen_est_idioma);
		$("#nivel_idioma").val(data.nivel_idioma);

		$("#des_comp").val(data.des_comp);
		$("#cen_est_comp").val(data.cen_est_comp);
		$("#nivel_comp").val(data.nivel_comp);

		$("#des_comp").val(data.des_comp);
		$("#cen_est_comp").val(data.cen_est_comp);
		$("#nivel_comp").val(data.nivel_comp);


		



		$("#nom_emp_exp1").val(data.nom_emp_exp1);
		$("#car_exp1").val(data.car_exp1);
		$("#fun_exp1").val(data.fun_exp1);
		$("#fec_ini_exp1").val(data.fec_ini_exp1);
		$("#fec_fin_exp1").val(data.fec_fin_exp1);
		$("#mot_ces_exp1").val(data.mot_ces_exp1);
		$("#nom_emp_exp2").val(data.nom_emp_exp2);
		$("#car_exp2").val(data.car_exp2);
		$("#fun_exp2").val(data.fun_exp2);
		$("#fec_ini_exp2").val(data.fec_ini_exp2);
		$("#fec_fin_exp2").val(data.fec_fin_exp2);
		$("#mot_ces_exp2").val(data.mot_ces_exp2);
		$("#nom_emp_exp3").val(data.nom_emp_exp3);
		$("#car_exp3").val(data.car_exp3);
		$("#fun_exp3").val(data.fun_exp3);
		$("#fec_ini_exp3").val(data.fec_ini_exp3);
		$("#fec_fin_exp3").val(data.fec_fin_exp3);
		$("#mot_ces_exp3").val(data.mot_ces_exp3);

		$("#tie_enf_car_onc").val(data.tie_enf_car_onc);
		$("#nom_enf_car_onc").val(data.nom_enf_car_onc);
		$("#tie_enf_ale_rec").val(data.tie_enf_ale_rec);

		$("#id_gru_san").val(data.id_gru_san);
		$('#id_gru_san').selectpicker('refresh');
		$("#talla").val(data.talla);
		$("#peso").val(data.peso);


		

		$("#afi_onp").val(data.afi_onp);
		$("#afi_afp").val(data.afi_afp);
		$("#nom_afi_afp").val(data.nom_afi_afp);



 	})
}





function mostrar_data_adjunta(id_trab)
{
	$.post("../ajax/trabajador.php?op=mostrar",{id_trab : id_trab}, function(data, status)
	{

		limpiar();
		
		data = JSON.parse(data);		
		mostrarform_data_adjunta(true);


		$("#id_trab_data_adjunta").val(data.id_trab);

		$("#foto_trab_muestra").show();
		$("#foto_trab_muestra").attr("src","../files/trabajador_data_adjunta/"+data.foto_trab);
		$("#imagenactual_foto_trab").val(data.foto_trab);

		$("#dat_hij1_muestra").show();
		$("#dat_hij1_muestra").attr("src","../files/trabajador_familia/"+data.dat_hij1);
		$("#imagenactual_dat_hij1").val(data.dat_hij1);

		$("#dat_hij2_muestra").show();
		$("#dat_hij2_muestra").attr("src","../files/trabajador_familia/"+data.dat_hij2);
		$("#imagenactual_dat_hij2").val(data.dat_hij2);

		$("#dat_hij3_muestra").show();
		$("#dat_hij3_muestra").attr("src","../files/trabajador_familia/"+data.dat_hij3);
		$("#imagenactual_dat_hij3").val(data.dat_hij3);

		$("#dat_hij4_muestra").show();
		$("#dat_hij4_muestra").attr("src","../files/trabajador_familia/"+data.dat_hij4);
		$("#imagenactual_dat_hij4").val(data.dat_hij4);

		$("#dat_con_muestra").show();
		$("#dat_con_muestra").attr("src","../files/trabajador_familia/"+data.dat_con);
		$("#imagenactual_dat_con").val(data.dat_con);

		$("#dat_luz_agua_muestra").show();
		$("#dat_luz_agua_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_luz_agua);
		$("#imagenactual_dat_luz_agua").val(data.dat_luz_agua);

		$("#dat_ant_pol_muestra").show();
		$("#dat_ant_pol_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_ant_pol);
		$("#imagenactual_dat_ant_pol").val(data.dat_ant_pol);

		$("#dat_cer_med_muestra").show();
		$("#dat_cer_med_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_cer_med);
		$("#imagenactual_dat_cer_med").val(data.dat_cer_med);

		$("#dat_dec_dom_muestra").show();
		$("#dat_dec_dom_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_dec_dom);
		$("#imagenactual_dat_dec_dom").val(data.dat_dec_dom);
	
		$("#dat_cv_muestra").show();
		$("#dat_cv_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_cv);
		$("#imagenactual_dat_cv").val(data.dat_cv);

		$("#dat_gra_tit_muestra").show();
		$("#dat_gra_tit_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_gra_tit);
		$("#imagenactual_dat_gra_tit").val(data.dat_gra_tit);

		$("#dat_idi_muestra").show();
		$("#dat_idi_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_idi);
		$("#imagenactual_dat_idi").val(data.dat_idi);

		$("#dat_cer_tec_muestra").show();
		$("#dat_cer_tec_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_cer_tec);
		$("#imagenactual_dat_cer_tec").val(data.dat_cer_tec);

		$("#dat_cer_tra1_muestra").show();
		$("#dat_cer_tra1_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_cer_tra1);
		$("#imagenactual_dat_cer_tra1").val(data.dat_cer_tra1);

		$("#dat_cer_tra2_muestra").show();
		$("#dat_cer_tra2_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_cer_tra2);
		$("#imagenactual_dat_cer_tra2").val(data.dat_cer_tra2);
		
		$("#dat_cer_tra3_muestra").show();
		$("#dat_cer_tra3_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_cer_tra3);
		$("#imagenactual_dat_cer_tra3").val(data.dat_cer_tra3);


		$("#dat_cer_res1_muestra").show();
		$("#dat_cer_res1_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_cer_res1);
		$("#imagenactual_dat_cer_res1").val(data.dat_cer_res1);

		$("#dat_cer_res2_muestra").show();
		$("#dat_cer_res2_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_cer_res2);
		$("#imagenactual_dat_cer_res2").val(data.dat_cer_res2);
		
		$("#dat_cer_res3_muestra").show();
		$("#dat_cer_res3_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_cer_res3);
		$("#imagenactual_dat_cer_res3").val(data.dat_cer_res3);


		$("#dat_adi_muestra").show();
		$("#dat_adi_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_adi);
		$("#imagenactual_dat_adi").val(data.dat_adi);


		$("#dat_pas_muestra").show();
		$("#dat_pas_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_pas);
		$("#imagenactual_dat_pas").val(data.dat_pas);

		$("#dat_bre_muestra").show();
		$("#dat_bre_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_bre);
		$("#imagenactual_dat_bre").val(data.dat_bre);

		$("#dat_pla_liq1_muestra").show();
		$("#dat_pla_liq1_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_pla_liq1);
		$("#imagenactual_dat_pla_liq1").val(data.dat_pla_liq1);

		$("#dat_pla_liq2_muestra").show();
		$("#dat_pla_liq2_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_pla_liq2);
		$("#imagenactual_dat_pla_liq2").val(data.dat_pla_liq2);


		$("#dat_pla_liq3_muestra").show();
		$("#dat_pla_liq3_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_pla_liq3);
		$("#imagenactual_dat_pla_liq3").val(data.dat_pla_liq3);


		$("#dat_int_liq1_muestra").show();
		$("#dat_int_liq1_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_int_liq1);
		$("#imagenactual_dat_int_liq1").val(data.dat_int_liq1);


		$("#dat_int_liq2_muestra").show();
		$("#dat_int_liq2_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_int_liq2);
		$("#imagenactual_dat_int_liq2").val(data.dat_int_liq2);


		$("#dat_int_liq3_muestra").show();
		$("#dat_int_liq3_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_int_liq3);
		$("#imagenactual_dat_int_liq3").val(data.dat_int_liq3);


		$("#dat_car_ret_cts1_muestra").show();
		$("#dat_car_ret_cts1_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_car_ret_cts1);
		$("#imagenactual_dat_car_ret_cts1").val(data.dat_car_ret_cts1);

		
		$("#dat_car_ret_cts1_muestra").show();
		$("#dat_car_ret_cts1_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_car_ret_cts1);
		$("#imagenactual_dat_car_ret_cts1").val(data.dat_car_ret_cts1);

		$("#dat_car_ret_cts2_muestra").show();
		$("#dat_car_ret_cts2_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_car_ret_cts2);
		$("#imagenactual_dat_car_ret_cts2").val(data.dat_car_ret_cts2);


		$("#dat_car_ret_cts3_muestra").show();
		$("#dat_car_ret_cts3_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_car_ret_cts3);
		$("#imagenactual_dat_car_ret_cts3").val(data.dat_car_ret_cts3);


		$("#dat_alt_reg1_muestra").show();
		$("#dat_alt_reg1_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_alt_reg1);
		$("#imagenactual_dat_alt_reg1").val(data.dat_alt_reg1);

		$("#dat_alt_reg2_muestra").show();
		$("#dat_alt_reg2_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_alt_reg2);
		$("#imagenactual_dat_alt_reg2").val(data.dat_alt_reg2);

		$("#dat_alt_reg3_muestra").show();
		$("#dat_alt_reg3_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_alt_reg3);
		$("#imagenactual_dat_alt_reg3").val(data.dat_alt_reg3);

		$("#dat_baj_reg1_muestra").show();
		$("#dat_baj_reg1_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_baj_reg1);
		$("#imagenactual_dat_baj_reg1").val(data.dat_baj_reg1);

		$("#dat_baj_reg2_muestra").show();
		$("#dat_baj_reg2_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_baj_reg2);
		$("#imagenactual_dat_baj_reg2").val(data.dat_baj_reg2);


		$("#dat_baj_reg3_muestra").show();
		$("#dat_baj_reg3_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_baj_reg3);
		$("#imagenactual_dat_baj_reg3").val(data.dat_baj_reg3);


		$("#dat_car_ren_muestra").show();
		$("#dat_car_ren_muestra").attr("src","../files/trabajador_data_adjunta/"+data.dat_car_ren);
		$("#imagenactual_dat_car_ren").val(data.dat_car_ren);

		

 	})
}





//Función para desactivar registros
function desactivar(id_trab)
{
	bootbox.confirm("¿Está Seguro de desactivar el Trabajador?", function(result){
		if(result)
        {
        	$.post("../ajax/trabajador.php?op=desactivar", {id_trab : id_trab}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(id_trab)
{
	bootbox.confirm("¿Está Seguro de activar el Trabajador?", function(result){
		if(result)
        {
        	$.post("../ajax/trabajador.php?op=activar", {id_trab : id_trab}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}



//función para generar el código de barras
function generarbarcode()
{
	codigo=$("#codigo").val();
	JsBarcode("#barcode", codigo);
	$("#print").show();
}

//Función para imprimir el Código de barras
function imprimir()
{
	$("#print").printArea();
}

init();