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


  if (isset($_POST["enviar"])) {//nos permite recepcionar una variable que si

    require_once("importar_xls/conexion.php");
    require_once("importar_xls/imp_mov_fun.php");

    $archivo = $_FILES["archivo"]["name"];
    $archivo_copiado= $_FILES["archivo"]["tmp_name"];
    $archivo_guardado = "importar_xls/copia_".$archivo;

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

                  window.location = "importar_movimientos.php";

                  }
                })

            </script>';
      }

      if (file_exists($archivo_guardado)) {

        $fp = fopen($archivo_guardado,"r");//abrir un archivo
        $rows = 0;
        $borrar = borrar_datos();
        while ($datos = fgetcsv($fp , 5000 , ";")) {
          $rows ++;
            //echo $datos[0] ." ".$datos[1] ." ".$datos[2]." ".$datos[3] ." ".$datos[4] ." ".$datos[5] ." ".$datos[6] ." ".$datos[7] ." ".$datos[8] ." ".$datos[9] ." ".$datos[10] ." ".$datos[11] ." ".$datos[12] ." ".$datos[13] ." ".$datos[14] ." ".$datos[15] ."<br/>";

          if ($rows > 1) {

            $resultado = insertar_datos($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6],$datos[7],$datos[8],$datos[9],$datos[10],$datos[11],$datos[12],$datos[13],$datos[14],$datos[15]);



          }

        }

        if ($resultado) {
          echo'<script>

                swal({
                  type: "success",
                  title: "La carga se realizo correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                      if (result.value) {

                      window.location = "movimientos_detalle.php";

                      }
                    })

              </script>';

        } else {
          echo "no se inserto";
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
                        <form action="importar_movimientos.php" class="formulariocompleto" method="post" enctype="multipart/form-data">
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
