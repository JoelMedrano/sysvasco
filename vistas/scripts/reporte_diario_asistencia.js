var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	mostrarform_datos(false);



	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$("#formulariodatos").on("submit",function(e)
	{
		guardaryeditardatos(e);	
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

	//Cargamos los items al select turno
	$.post("../ajax/consultasD.php?op=selectDistrito", function(r){
	            $("#id_distrito").html(r);
	            $('#id_distrito').selectpicker('refresh');

	});







	$("#dat_hij1_muestra").hide();



}

//Función limpiar
function limpiar()
{
	$("#codigo").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
	$("#stock").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#print").hide();
	$("#idarticulo").val("");
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
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#formularioregistrosdatos").hide();
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
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#formularioregistrosdatos").hide();
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
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/reporte_diario_asistencia.php?op=listar',
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
		$("#fec_ing_trab").val(data.fec_ing_trab);
		$("#fec_cese_trab").val(data.fec_cese_trab);
		$("#sueldo_trab").val(data.sueldo_trab);
		$("#bono_trab").val(data.bono_trab);
		$("#asig_trab").val(data.asig_trab);
		$("#obs_trab").val(data.obs_trab);
		$("#fecfin_con_ant").val(data.fecfin_con_ant);
		$("#fecfin_con_act").val(data.fecfin_con_act);
		$("#cusp_trab").val(data.cusp_trab);
		$("#nacionalidad").val(data.nacionalidad);
		$("#departamento").val(data.departamento);
		$("#edad_trab").val(data.edad_trab);



	
		


 	})
}




function mostrar_datos(id_trab)
{
	$.post("../ajax/trabajador.php?op=mostrar",{id_trab : id_trab}, function(data, status)
	{
		
		data = JSON.parse(data);		
		mostrarform_datos(true);


		

		$("#prueba").val(data.id_trab);
		$("#viv_pad").val(data.viv_pad);
		$("#nom_pad").val(data.nom_pad);
		$("#ocu_pad").val(data.ocu_pad);
		$("#dep_pad").val(data.dep_pad);
		$("#fec_rec_dat").val(data.fec_rec_dat);
				

		$("#viv_mad").val(data.viv_mad);
		$("#nom_mad").val(data.nom_mad);
		$("#ocu_mad").val(data.ocu_mad);
		$("#dep_mad").val(data.dep_mad);

		$("#viv_con").val(data.viv_con);
		$("#nom_con").val(data.nom_con);
		$("#ocu_con").val(data.ocu_con);
		$("#dep_con").val(data.dep_con);


		$("#eda_hij1").val(data.eda_hij1);
		$("#nom_hij1").val(data.nom_hij1);
		$("#ocu_hij1").val(data.ocu_hij1);
		$("#dep_hij1").val(data.dep_hij1);

		$("#dat_hij1_muestra").show();
		$("#dat_hij1_muestra").attr("src","../files/trabajador_hijos/"+data.dat_hij1);
		$("#dat_hij1_actual").val(data.dat_hij1);



		$("#eda_hij2").val(data.eda_hij2);
		$("#nom_hij2").val(data.nom_hij2);
		$("#ocu_hij2").val(data.ocu_hij2);
		$("#dep_hij2").val(data.dep_hij2);

		$("#eda_hij3").val(data.eda_hij3);
		$("#nom_hij3").val(data.nom_hij3);
		$("#ocu_hij3").val(data.ocu_hij3);
		$("#dep_hij3").val(data.dep_hij3);

        $("#eda_hij4").val(data.eda_hij4);
		$("#nom_hij4").val(data.nom_hij4);
		$("#ocu_hij4").val(data.ocu_hij4);
		$("#dep_hij4").val(data.dep_hij4);

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


		$("#tie_enf_car_onc").val(data.tie_enf_car_onc);
		$("#nom_enf_car_onc").val(data.nom_enf_car_onc);
		

		$("#afi_onp").val(data.afi_onp);
		$("#afi_afp").val(data.afi_afp);
		$("#nom_afi_afp").val(data.nom_afi_afp);



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