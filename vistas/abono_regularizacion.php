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
                          <h1 class="box-title">Abono Regularizacion<button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Fec.Registro</th>
                            <th>Trabajador</th>
                            <th>Area</th>
                            <th>Motivo</th>
                            <th>Cantidad</th>
                            <th>Modalidad</th>
                            <th>Tip.Abono</th>
                            <th>Situacion</th>
                            <th>Estado</th>
                            <th>Ver</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Fec.Registro</th>
                            <th>Trabajador</th>
                            <th>Area</th>
                            <th>Motivo</th>
                            <th>Cantidad</th>
                            <th>Modalidad</th>
                            <th>Tip.Abono</th>
                            <th>Situacion</th>
                            <th>Estado</th>
                            <th>Ver</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                          
                        
                           <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fec.Suceso:</label>
                            <input type="hidden" readonly class="form-control" name="id_abo_reg" id="id_abo_reg">
                            <input type="date" class="form-control" name="fec_suc" id="fec_suc" required >
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Trabajador:</label>
                            <select id="id_trab" name="id_trab" class="form-control selectpicker" data-live-search="true"></select>
                          </div>
                          <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <label>Motivo:</label>
                            <input type="text" class="form-control" name="motivo" id="motivo">
                          </div>




                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Modalidad:</label>
                            <select id="modalidad" name="modalidad" class="form-control selectpicker" data-live-search="true"></select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Tip.Abono:</label>
                            <select id="tip_abono" name="tip_abono" class="form-control selectpicker" data-live-search="true"></select>
                          </div>


                          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Cantidad:</label>
                            <input type="decimal" class="form-control" name="cantidad" id="cantidad">
                          </div>
                          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Cant.Pagada</label>
                            <input type="decimal" class="form-control" name="pagado" id="pagado" readonly>
                          </div>
                          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Saldo</label>
                            <input type="decimal" class="form-control" name="saldo" id="saldo" readonly>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                          </div>

                          <div class="form-group  col-xs-12">
                          </div>
                          <div class="form-group  col-xs-12">
                          </div>
                         

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha de Abono</label>
                            <input type="date" class="form-control" name="fec_abo_reg" id="fec_abo_reg" >
                          </div>

                          


                          


                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/abono_regularizacion.js"></script>
<?php 
}
ob_end_flush();
?>