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
                          <h1 class="box-title">Prestamos<button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Fec.Solicitud</th>
                            <th>Solicitante</th>
                            <th>Aprobado por</th>
                            <th>Motivo</th>
                            <th>Cantidad</th>
                            <th>Modalidad</th>
                            <th>Tip.Dscto</th>
                            <th>Estado</th>
                            <th>Ver</th>
                            <th>Aprobar</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                           <th>Fec.Solicitud</th>
                            <th>Solicitante</th>
                            <th>Aprobado por</th>
                            <th>Motivo</th>
                            <th>Cantidad</th>
                            <th>Modalidad</th>
                            <th>Tip.Dscto</th>
                            <th>Estado</th>
                            <th>Ver</th>
                            <th>Aprobar</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                          
                             
                        
                           <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fec.Solicitud:</label>
                            <input type="hidden" readonly class="form-control" name="id_pre" id="id_pre">
                            <input type="date" class="form-control" name="fec_sol" id="fec_sol" required >
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Registrante:</label>
                             <input type="text" class="form-control" name="registrante" id="registrante" readonly>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Trabajador Solicitante:</label>
                            <select id="solicitante" name="solicitante" class="form-control selectpicker" data-live-search="true"></select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Aprobado por:</label>
                            <select id="aprob_por" name="aprob_por" class="form-control selectpicker" data-live-search="true"></select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Modalidad:</label>
                            <select id="modalidad" name="modalidad" class="form-control selectpicker" data-live-search="true"></select>
                          </div>
                           <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Tip.Dscto:</label>
                            <select id="tip_dscto" name="tip_dscto" class="form-control selectpicker" data-live-search="true"></select>
                          </div>



                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                          </div>

                         

                          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Cantidad:</label>
                            <input type="number" class="form-control" name="cantidad" id="cantidad">
                          </div>
                          <div class="form-group  col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Num.Cuotas:</label>
                            <input type="number" class="form-control" name="num_cuotas" id="num_cuotas">
                          </div>
                          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Cant.Pagada</label>
                            <input type="number" class="form-control" name="pagado" id="pagado" readonly>
                          </div>
                          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Saldo</label>
                            <input type="number" class="form-control" name="saldo" id="saldo" readonly>
                          </div>



                          

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Subir Data Adjunta:</label>
                            <input type="file" class="form-control" name="data_adjunta" id="data_adjunta">
                            <input type="hidden" name="data_adjunta_actual" id="data_adjunta_actual">
                            <img src="" width="150px" height="120px" id="data_adjunta_muestra">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Motivo:</label>
                            <input type="text" class="form-control" name="motivo" id="motivo">
                          </div>

                           <div class="form-group  col-xs-12">
                            </div>
                            <div class="form-group  col-xs-12">
                            </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 1</label>
                            <input type="number" class="form-control" name="fec_des1" id="fec_des1" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 2</label>
                            <input type="number" class="form-control" name="fec_des2" id="fec_des2" readonly>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 3</label>
                            <input type="number" class="form-control" name="fec_des3" id="fec_des3" readonly>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 4</label>
                            <input type="number" class="form-control" name="fec_des4" id="fec_des4" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 5</label>
                            <input type="number" class="form-control" name="fec_des5" id="fec_des5" readonly>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 6</label>
                            <input type="number" class="form-control" name="fec_des6" id="fec_des6" readonly>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 7</label>
                            <input type="number" class="form-control" name="fec_des7" id="fec_des7" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 8</label>
                            <input type="number" class="form-control" name="fec_des8" id="fec_des8" readonly>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 9</label>
                            <input type="number" class="form-control" name="fec_des9" id="fec_des9" readonly>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 10</label>
                            <input type="number" class="form-control" name="fec_des10" id="fec_des10" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 11</label>
                            <input type="number" class="form-control" name="fec_des11" id="fec_des11" readonly>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 12</label>
                            <input type="number" class="form-control" name="fec_des12" id="fec_des12" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 13</label>
                            <input type="number" class="form-control" name="fec_des13" id="fec_des13" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 14</label>
                            <input type="number" class="form-control" name="fec_des14" id="fec_des14" readonly>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 15</label>
                            <input type="number" class="form-control" name="fec_des15" id="fec_des15" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 16</label>
                            <input type="number" class="form-control" name="fec_des16" id="fec_des16" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 17</label>
                            <input type="number" class="form-control" name="fec_des17" id="fec_des17" readonly>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 18</label>
                            <input type="number" class="form-control" name="fec_des18" id="fec_des18" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 19</label>
                            <input type="number" class="form-control" name="fec_des19" id="fec_des19" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 20</label>
                            <input type="number" class="form-control" name="fec_des20" id="fec_des20" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 21</label>
                            <input type="number" class="form-control" name="fec_des21" id="fec_des21" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 22</label>
                            <input type="number" class="form-control" name="fec_des22" id="fec_des22" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 23</label>
                            <input type="number" class="form-control" name="fec_des23" id="fec_des23" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 24</label>
                            <input type="number" class="form-control" name="fec_des24" id="fec_des24" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 25</label>
                            <input type="number" class="form-control" name="fec_des25" id="fec_des25" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 26</label>
                            <input type="number" class="form-control" name="fec_des26" id="fec_des26" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 27</label>
                            <input type="number" class="form-control" name="fec_des27" id="fec_des27" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 28</label>
                            <input type="number" class="form-control" name="fec_des28" id="fec_des28" readonly>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 29</label>
                            <input type="number" class="form-control" name="fec_des29" id="fec_des29" readonly>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Descuento 30</label>
                            <input type="number" class="form-control" name="fec_des30" id="fec_des30" readonly>
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
<script type="text/javascript" src="scripts/prestamos.js"></script>
<?php 
}
ob_end_flush();
?>