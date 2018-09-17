<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['almacen']==1)
{
?>

<?php

if (isset($_POST["enviar"])) {//nos permite recepcionar una variable que si exista y que no sea null
	require_once("importar_xls/conexion.php");
	require_once("importar_xls/funciones.php");

	$archivo = $_FILES["archivo"]["name"];
	$archivo_copiado= $_FILES["archivo"]["tmp_name"];
	$archivo_guardado = "importar_xls/copia_".$archivo;

	//echo $archivo."esta en la ruta temporal: " .$archivo_copiado;

	if (copy($archivo_copiado ,$archivo_guardado )) {
		echo "se copio correctamente el archivo temporal a nuestra carpeta de trabajo <br/>";
	}else{
    echo'<script>

					swal({
						  type: "error",
						  title: "Escoja un archivo .csv por favor",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "imp_fact.php";

							}
						})

			  	</script>';
	}

    if (file_exists($archivo_guardado)) {

    	 $fp = fopen($archivo_guardado,"r");//abrir un archivo
         $rows = 0;
         $borrar = borrar_datos();
         while ($datos = fgetcsv($fp , 1000 , ";")) {
         	    $rows ++;
         	   // echo $datos[0] ." ".$datos[1] ." ".$datos[2]." ".$datos[3] ."<br/>";
         	if ($rows > 1) {

         		$resultado = insertar_datos($datos[0],$datos[1],$datos[2],$datos[3]);
         	if($resultado){

            echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La carga se realizo correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "cotizacion.php";

								}
							})

				</script>';

         	}else{
         		echo "no se inserto <br/>";
         	}
         	}
         }



    }else{
    	echo "no existe el archivo copiado <br/>";
    }

}

?>

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Cargar Ventas </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>

                    <div class="panel-body formulario">
                        <form action="imp_fact.php" class="formulariocompleto" method="post" enctype="multipart/form-data">
                              <label>Subir archivo de Ventas</label>
                              <input type="file" name="archivo" class="form-control"/>
                              <label></label>
                              <button class="btn btn-primary" type="submit" name="enviar"><i class="fa fa-save"></i> Guardar</button>
                              <a href="cotizacion.php"><input type="button" class="btn btn-danger" value="Cancelar"/></a>
                        </form>
                    </div>


                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>

<?php
}
ob_end_flush();
?>
