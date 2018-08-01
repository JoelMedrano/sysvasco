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

      Administrar Marcas

    </h1>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarMarca">

          Agregar Marca

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Marca</th>
           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>

          <tr>

            <td>1</td>

            <td>EQUIPOS ELECTROMECÁNICOS</td>

            <td>

              <div class="btn-group">

                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>

            </td>

          </tr>

          <tr>

            <td>1</td>

            <td>EQUIPOS ELECTROMECÁNICOS</td>

            <td>

              <div class="btn-group">

                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>

            </td>

          </tr>

          <tr>

            <td>1</td>

            <td>EQUIPOS ELECTROMECÁNICOS</td>

            <td>

              <div class="btn-group">

                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>

            </td>

          </tr>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR MARCA
======================================-->

<div id="modalAgregarMarca" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Marca</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-maxcdn"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Ingresar Marca" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Marca</button>

        </div>
        <?php

          require "../controladores/marcas.controlador.php";

          $crearMarca = new ControladorMarcas();
          $crearMarca -> ctrCrearMarca();

        ?>

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

<?php
}
ob_end_flush();
?>
