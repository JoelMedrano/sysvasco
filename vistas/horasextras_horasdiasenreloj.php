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

if ($_SESSION['rrhh']==1)
{
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
            <h1 class="box-title">Horas Extras en Horas y Dias del Reloj</h1>

            <div class="box-tools pull-right">
              <h10>Nota:Solo un periodo debe estar habilitado cuando se requiera eligir cuales seran abonados x
                items(Pantalla: Habilitar abono x fila del reloj)</h10>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- centro -->

          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>PD</th>
                <th>Año</th>
                <th>Fecha de Pago</th>
                <th>Visualizar y Agregar</th>
                <th>Abono</th>
                <th>Habilitar para Abono</th>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th>PD</th>
                <th>Año</th>
                <th>Fecha de Pago</th>
                <th>Visualizar y Agregar</th>
                <th>Abono</th>
                <th>Habilitar para Abono</th>

              </tfoot>
            </table>
          </div>
          <div class="panel-body" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">

              <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                
                <input type="hidden" readonly class="form-control" name="id_cp" id="id_cp">
              </div>

              <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                
                <input type="hidden" readonly class="form-control" name="num" id="num">
              </div>

              <br>


              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">
                <a data-toggle="modal" href="#myModal">
                  <button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span>
                    Agregar Horas.Extras no abonadas de otro Periodo de Pago</button>
                </a>
              </div>


              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive table-wrapper-scroll-x">

                <div class="scrollable">

                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                      <label>Buscar por fecha</label>
                      <input type="text" id="myInput" onkeyup="myFunction()" class="form-control"  autocomplete="off" placeholder="Fecha">
                    </div>

                    <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                      <label>Buscar por Nombre</label>
                      <input type="text" id="myInput1" onkeyup="myFunction1()" class="form-control" autocomplete="off" placeholder="Nombre">
                    </div>

                    <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                      <label>Buscar por Estado </label>
                      <input type="text" id="myInput2" onkeyup="myFunction2()" class="form-control" autocomplete="off" placeholder="Estado">
                    </div>

                    <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                      <label>Buscar por Situación</label>
                      <input type="text" id="myInput3" onkeyup="myFunction3()" class="form-control" autocomplete="off" placeholder="Situación">
                    </div>

                  </div>

                  <span class="counter pull-right"></span>
                  <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                  </table>
                </div>

              </div>

              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>
                  Cancelar</button>
              </div>

            </form>
          </div>
          <!--Fin centro -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->

</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 65% !important;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Seleccione un Periodo</h4>
      </div>
      <div class="modal-body">
        <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
          <thead>
            <th>Add</th>
            <th>Id</th>
            <th>Fecha</th>
            <th>Trabajador</th>
            <th>Estado Dia</th>
            <th>Tiempo</th>
            <th>Tie.Final</th>
            <th>Observacion</th>
            <th>Situacion</th>
            <th>Estado</th>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <th>Add</th>
            <th>Id</th>
            <th>Fecha</th>
            <th>Trabajador</th>
            <th>Estado Dia</th>
            <th>Tiempo</th>
            <th>Tie.Final</th>
            <th>Observacion</th>
            <th>Situacion</th>
            <th>Estado</th>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin modal -->



<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="../public/bootstrap/css/style.css">

<script>
  function myFunction() {
    // Declare variables 
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("detalles");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
</script>

<script>
  function myFunction1() {
    // Declare variables 
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput1");
    filter = input.value.toUpperCase();
    table = document.getElementById("detalles");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
</script>

<script>
  function myFunction2() {
    // Declare variables 
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput2");
    filter = input.value.toUpperCase();
    table = document.getElementById("detalles");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[3];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
</script>

<script>
  function myFunction3() {
    // Declare variables 
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput3");
    filter = input.value.toUpperCase();
    table = document.getElementById("detalles");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[8];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
</script>

<script type="text/javascript" src="scripts/horasextras_horasdiasenreloj.js"></script>
<?php 
}
ob_end_flush();
?>
