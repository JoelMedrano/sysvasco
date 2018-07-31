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
if ($_SESSION['udp']==1)
{
?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Modelos

    </h1>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarModelo">

          Agregar Modelo

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablaModelos" width="100%">

        <thead>

         <tr>

           	<th style="width:10px">#</th>
           	<th>Marca</th>
           	<th>Modelo</th>
      			<th>Nombre</th>
      			<th>Estado</th>
      			<th>Tipo</th>
      			<th>Linea</th>
      			<th>Imagen</th>
            <th>P. Bruto</th>
            <th>P. Neto</th>
      			<th>Creacion</th>
      			<th>Opciones</th>

         </tr>


       </thead>


       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR MODELO
======================================-->

<div id="modalAgregarModelo" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Modelo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO INTERNO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar código" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CODIGO DEL MODELO -->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-compass"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCodModelo" placeholder="Codigo del Modelo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE DEL MODELO -->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TIPO-->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-bullseye"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTipo" placeholder="Ingresar Tipo" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA LINEA -->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-bullseye"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoLinea" placeholder="Ingresar Linea" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU MARCA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-maxcdn"></i></span>

                <select class="form-control input-lg" id="nuevaMarca" name="nuevaMarca" required>

                  <option value="">Seleccionar Marca</option>

                  <?php

                    require_once "../controladores/consultasj.controlador.php";


                      $areas = ControladorConsultasJ::ctrMostrarAreas();

                      foreach ($areas as $key => $value) {

                        echo '<option value="'.$value["cod_argumento"].'">'.$value["des_larga"].'</option>';

                      }

                  ?>

                </select>

              </div>

            </div>


            <!-- ENTRADA PARA LA PRECIO BRUTO -->

             <div class="form-group row">

                <div class="col-xs-6">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-money"></i></span>

                    <input type="number" class="form-control input-lg" name="nuevoPreBru" placeholder="Precio Bruto" step="any" required>

                  </div>

                </div>





              <!-- ENTRADA PARA LA PRECIO NETO -->


                <div class="col-xs-6">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    <input type="number" class="form-control input-lg" name="nuevoPreNet" placeholder="Precio Neto" step="any" required>

                  </div>

                  <br>

                  <!-- CHECKBOX PARA PORCENTAJE -->

                  <div class="col-xs-6">

                    <div class="form-group">

                      <label>

                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar porcentaje
                      </label>

                    </div>

                  </div>

                  <!-- ENTRADA PARA PORCENTAJE -->

                  <div class="col-xs-6" style="padding:0">

                    <div class="input-group">

                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="18" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>


                </div>

              </div>



            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">

              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" id="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="../files/modelos/default/anonymous.png" class="img-thumbnail" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Modelo</button>

        </div>

      </form>

    </div>

  </div>

</div>

<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>

<!-- DataTables -->

 <link rel="stylesheet" href="bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

 <!-- iCheck for checkboxes and radio inputs -->
 <link rel="stylesheet" href="../public/plugins/iCheck/all.css">

  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- DataTables -->


  <script src="bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>


  <!-- SweetAlert 2 -->
  <script src="plugins/sweetalert2/sweetalert2.all.js"></script>
   <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="plugins/iCheck/icheck.min.js"></script>


  <script type="text/javascript" src="scripts/plantilla.js"></script>
  <script type="text/javascript" src="scripts/modelos.js"></script>

<?php
}
ob_end_flush();
?>
