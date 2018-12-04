var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    selectTM();


    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    })

    //Cargamos los items al select categoria
    $.post("../ajax/confeccion.php?op=selectFT", function (r) {
        $("#idmft").html(r);
        $('#idmft').selectpicker('refresh');

    });

    //Cargamos los items al select categoria
    $.post("../ajax/confeccion.php?op=selectOP", function (r) {
        $("#id_operacion").html(r);
        $('#id_operacion').selectpicker('refresh');

    });

    //Cargamos los items al select categoria
    $.post("../ajax/confeccion.php?op=selectCP2", function (r) {
        $("#idcodigo_puntada").html(r);
        $('#idcodigo_puntada').selectpicker('refresh');

    });

    $('#idtipo_maquina').change(function () {
        selectCP();

    });


}

//Función limpiar
function limpiar() {
    $("#codigo").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#stock").val("");
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#print").hide();
    $("#idconfeccion").val("");
    $("#imagen").attr("src", "");
}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $('#nombre').focus();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}

//Función Listar
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/confeccion.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 20, //Paginación
        "order": [
            [0, "desc"]
        ] //Ordenar (columna,orden)
    }).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/confeccion.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    limpiar();
}

function mostrar(idconfeccion) {
    $.post("../ajax/confeccion.php?op=mostrar", {
        idconfeccion: idconfeccion
    }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);


        $("#idmft").val(data.idmft);
        $("#idmft").selectpicker('refresh');

        $("#id_operacion").val(data.id_operacion);
        $("#id_operacion").selectpicker('refresh');;

        $("#descripcion").val(data.descripcion);

        $("#idtipo_maquina").val(data.idtipo_maquina);
        $("#idtipo_maquina").selectpicker('refresh');

        $("#idcodigo_puntada").val(data.idcodigo_puntada);
        $("#idcodigo_puntada").selectpicker('refresh');




        $("#ancho_costura").val(data.ancho_costura);

        $("#puntadas_pulgadas").val(data.puntadas_pulgadas);


        $("#idconfeccion").val(data.idconfeccion);


    })
}

//TODO: SELECT PARA ACTIVAR TRABAJADORES
function selectTM() {
    //Cargamos los items al combobox departamento
    $.post("../ajax/confeccion.php?op=selectTM", function (r) {
        $("#idtipo_maquina").html(r);
        $('#idtipo_maquina').selectpicker('refresh');

    });
}

function selectCP() {
    //Cargamos los items al combobox departamento
    idtipo_maquina = $("#idtipo_maquina").val();

    $.post("../ajax/confeccion.php?op=selectCP", {
        idtipo_maquina: idtipo_maquina
    }, function (r) {
        $("#idcodigo_puntada").html(r);
        $('#idcodigo_puntada').selectpicker('refresh');
    });
}

//Función para desactivar registros
function eliminar(idconfeccion)
{
	bootbox.confirm("¿Está Seguro de eliminar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/confeccion.php?op=eliminar", {idconfeccion : idconfeccion}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}


init();
