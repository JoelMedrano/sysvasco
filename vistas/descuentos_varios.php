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
                          <h1 class="box-title">Descuentos Varios(Prendas)<button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
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
                            <th>Detalle</th>
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
                            <th>Detalle</th>
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
                            <input type="hidden" readonly class="form-control" name="id_des_var" id="id_des_var"  autocomplete="off">
                            <input type="date" class="form-control" name="fec_suc" id="fec_suc" required >
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Trabajador:</label>
                            <select id="id_trab" name="id_trab" class="form-control selectpicker" data-live-search="true" required autocomplete="off"></select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Modalidad:</label>
                            <select id="modalidad" name="modalidad" class="form-control selectpicker" data-live-search="true" autocomplete="off"></select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Tip.Dscto:</label>
                            <select id="tip_dscto" name="tip_dscto" class="form-control selectpicker" data-live-search="true" autocomplete="off"></select>
                          </div>



                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                          </div>

                          <div class="form-group  col-xs-12">
                          </div>
                          <div class="form-group  col-xs-12">
                          </div>

                          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Cantidad:</label>
                            <input type="decimal" class="form-control" name="cantidad" id="cantidad"  autocomplete="off">
                          </div>

                          <div class="form-group  col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Num.Cuotas:</label>
                            <input type="number" class="form-control" name="num_cuotas" id="num_cuotas"  autocomplete="off">
                          </div>

                          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Cant.Pagada</label>
                            <input type="decimal" class="form-control" name="pagado" id="pagado" readonly  autocomplete="off">
                          </div>

                          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Saldo</label>
                            <input type="decimal" class="form-control" name="saldo" id="saldo" readonly  autocomplete="off">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Detalle:</label>
                            <input type="text" class="form-control" name="detalle" id="detalle" autocomplete="off">
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                          </div>

                          <div class="form-group  col-xs-12">
                          </div>
                          <div class="form-group  col-xs-12">
                          </div> 
                          
                         

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                      <label>Fecha Descuento 1</label>
                                      <select id="fec_des1" name="fec_des1" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 1</label>
                                      <input type="decimal" class="form-control" name="mon_des1" id="mon_des1" autocomplete="off">
                                    </div>

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                      <label>Fecha Descuento 2</label>
                                      <select id="fec_des2" name="fec_des2" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>


                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 2</label>
                                      <input type="decimal" class="form-control" name="mon_des2" id="mon_des2" autocomplete="off">
                                    </div>


                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                      <label>Fecha Descuento 3</label>
                                      <select id="fec_des3" name="fec_des3" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 3</label>
                                      <input type="decimal" class="form-control" name="mon_des3" id="mon_des3" autocomplete="off">
                                    </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                          </div>

                          <div class="form-group  col-xs-12">
                          </div>
                          <div class="form-group  col-xs-12">
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
<script type="text/javascript" src="scripts/descuentos_varios.js"></script>
<?php 
}
ob_end_flush();
?>