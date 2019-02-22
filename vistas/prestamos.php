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
                            <th>Aprobar</th>
                            <th>Ver</th>
                            <th>Eliminar</th>
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
                            <th>Aprobar</th>
                            <th>Ver</th>
                            <th>Eliminar</th>
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




                          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Cantidad:</label>
                            <input type="decimal" class="form-control" name="cantidad"  id="cantidad" required  autocomplete="off">
                          </div>
                          <div class="form-group  col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Num.Cuotas:</label>
                            <input type="decimal" class="form-control" name="num_cuotas" id="num_cuotas" required  autocomplete="off">
                          </div>
                          
                          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Cant.Pagada</label>
                            <input type="decimal" class="form-control" name="pagado" id="pagado" readonly  autocomplete="off">
                          </div>

                          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <label>Saldo</label>
                            <input type="decimal" class="form-control" name="saldo" id="saldo" readonly autocomplete="off">
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Accion:</label>
                            <select id="medida" name="medida" class="form-control selectpicker" data-live-search="true"></select>
                          </div>



                          

                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Motivo:</label>
                            <input type="text" class="form-control" name="motivo" id="motivo" required  autocomplete="off" >
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Subir Data Adjunta:</label>
                            <input type="file" class="form-control" name="data_adjunta" id="data_adjunta">
                            <input type="hidden" name="data_adjunta_actual" id="data_adjunta_actual">
                            <img src="" width="150px" height="120px" id="data_adjunta_muestra">
                          </div>


                          <div class="form-group  col-xs-12">
                          </div>


                         <div class="form-group  col-xs-12">

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 1</label>
                                      <select id="fec_des1" name="fec_des1" class="form-control selectpicker"  data-live-search="true"></select>
                                    </div>


                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 1</label>
                                      <input type="decimal" class="form-control" name="mon_des1" autocomplete="off" id="mon_des1">
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 2</label>
                                      <select id="fec_des2" name="fec_des2" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>


                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 2</label>
                                      <input type="decimal" class="form-control" name="mon_des2" autocomplete="off"  id="mon_des2">
                                    </div>


                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 3</label>
                                      <select id="fec_des3" name="fec_des3" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 3</label>
                                      <input type="decimal" class="form-control" name="mon_des3" autocomplete="off"  id="mon_des3">
                                    </div>


                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 4</label>
                                      <select id="fec_des4" name="fec_des4" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 4</label>
                                      <input type="decimal" class="form-control" name="mon_des4" autocomplete="off" id="mon_des4">
                                    </div>

                        </div>




                        <div class="form-group  col-xs-12">

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 5</label>
                                      <select id="fec_des5" name="fec_des5" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 5</label>
                                      <input type="decimal" class="form-control" name="mon_des5" autocomplete="off"  id="mon_des5">
                                    </div>


                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 6</label>
                                      <select id="fec_des6" name="fec_des6" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                     <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 6</label>
                                      <input type="decimal" class="form-control" name="mon_des6" autocomplete="off" id="mon_des6">
                                    </div>



                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 7</label>
                                      <select id="fec_des7" name="fec_des7" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                     <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 7</label>
                                      <input type="decimal" class="form-control" name="mon_des7" autocomplete="off" id="mon_des7">
                                    </div>
                                    


                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 8</label>
                                      <select id="fec_des8" name="fec_des8" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 8</label>
                                      <input type="decimal" class="form-control" name="mon_des8" autocomplete="off" id="mon_des8">
                                    </div>

                        </div>

                        <div class="form-group  col-xs-12">


                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 9</label>
                                      <select id="fec_des9" name="fec_des9" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                     <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 9</label>
                                      <input type="decimal" class="form-control" name="mon_des9" autocomplete="off" id="mon_des9">
                                    </div>


                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 10</label>
                                      <select id="fec_des10" name="fec_des10" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 10</label>
                                      <input type="decimal" class="form-control" name="mon_des10" autocomplete="off" id="mon_des10">
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 11</label>
                                      <select id="fec_des11" name="fec_des11" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 11</label>
                                      <input type="decimal" class="form-control" name="mon_des11" autocomplete="off" id="mon_des11">
                                    </div> 


                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 12</label>
                                      <select id="fec_des12" name="fec_des12" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>


                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 12</label>
                                      <input type="decimal" class="form-control" name="mon_des12" autocomplete="off" id="mon_des12">
                                    </div>
                         </div>

                         <div class="form-group  col-xs-12">

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 13</label>
                                      <select id="fec_des13" name="fec_des13" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>


                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 13</label>
                                      <input type="decimal" class="form-control" name="mon_des13" autocomplete="off" id="mon_des13">
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 14</label>
                                      <select id="fec_des14" name="fec_des14" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>


                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 14</label>
                                      <input type="decimal" class="form-control" name="mon_des14" autocomplete="off" id="mon_des14">
                                    </div>


                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 15</label>
                                      <select id="fec_des15" name="fec_des15" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>


                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 15</label>
                                      <input type="decimal" class="form-control" name="mon_des15" autocomplete="off" id="mon_des15">
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 16</label>
                                      <select id="fec_des16" name="fec_des16" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 16</label>
                                      <input type="decimal" class="form-control" name="mon_des16" autocomplete="off" id="mon_des16">
                                    </div>
                          </div>


                          <div class="form-group  col-xs-12">

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 17</label>
                                      <select id="fec_des17" name="fec_des17" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 17</label>
                                      <input type="decimal" class="form-control" name="mon_des17" autocomplete="off" id="mon_des17">
                                    </div>


                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 18</label>
                                      <select id="fec_des18" name="fec_des18" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 18</label>
                                      <input type="decimal" class="form-control" name="mon_des18" autocomplete="off" id="mon_des18">
                                    </div>


                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 19</label>
                                      <select id="fec_des19" name="fec_des19" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 19</label>
                                      <input type="decimal" class="form-control" name="mon_des19" autocomplete="off" id="mon_des19">
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 20</label>
                                      <select id="fec_des20" name="fec_des20" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 20</label>
                                      <input type="decimal" class="form-control" name="mon_des20" autocomplete="off" id="mon_des20">
                                    </div>
                          </div>



                          <div class="form-group  col-xs-12">

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 21</label>
                                      <select id="fec_des21" name="fec_des21" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 21</label>
                                      <input type="decimal" class="form-control" name="mon_des21" autocomplete="off" id="mon_des21">
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 22</label>
                                      <select id="fec_des22" name="fec_des22" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>


                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 22</label>
                                      <input type="decimal" class="form-control" name="mon_des22" autocomplete="off" id="mon_des22">
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 23</label>
                                      <select id="fec_des23" name="fec_des23" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>


                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 23</label>
                                      <input type="decimal" class="form-control" name="mon_des23" autocomplete="off" id="mon_des23">
                                    </div>

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Fecha Descuento 24</label>
                                      <select id="fec_des24" name="fec_des24" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>


                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto Dscto 24</label>
                                      <input type="decimal" class="form-control" name="mon_des24" autocomplete="off" id="mon_des24">
                                    </div>
                          </div>


                          <div class="form-group  col-xs-12">

                                  <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Fecha Descuento 25</label>
                                    <select id="fec_des25" name="fec_des25" class="form-control selectpicker" data-live-search="true"></select>
                                  </div>

                                  <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                    <label>Monto Dscto 25</label>
                                    <input type="decimal" class="form-control" name="mon_des25" autocomplete="off" id="mon_des25">
                                  </div>

                                  <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Fecha Descuento 26</label>
                                    <select id="fec_des26" name="fec_des26" class="form-control selectpicker" data-live-search="true"></select>
                                  </div>

                                  <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                    <label>Monto Dscto 26</label>
                                    <input type="decimal" class="form-control" name="mon_des26" autocomplete="off" id="mon_des26">
                                  </div>

                                  <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Fecha Descuento 27</label>
                                    <select id="fec_des27" name="fec_des27" class="form-control selectpicker" data-live-search="true"></select>
                                  </div>

                                  <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                    <label>Monto Dscto 27</label>
                                    <input type="decimal" class="form-control" name="mon_des27" autocomplete="off" id="mon_des27">
                                  </div>

                                  <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Fecha Descuento 28</label>
                                    <select id="fec_des28" name="fec_des28" class="form-control selectpicker" data-live-search="true"></select>
                                  </div>

                                  <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                    <label>Monto Dscto 28</label>
                                    <input type="decimal" class="form-control" name="mon_des28" autocomplete="off" id="mon_des28">
                                  </div>
                          </div>

                          <div class="form-group  col-xs-12">

                                  <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Fecha Descuento 29</label>
                                    <select id="fec_des29" name="fec_des29" class="form-control selectpicker" data-live-search="true"></select>
                                  </div>

                                  <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                    <label>Monto Dscto 29</label>
                                    <input type="decimal" class="form-control" name="mon_des29" autocomplete="off"  id="mon_des29">
                                  </div>


                                  <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Fecha Descuento 30</label>
                                    <select id="fec_des30" name="fec_des30" class="form-control selectpicker" data-live-search="true"></select>
                                  </div>

                                  <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                    <label>Monto Dscto 30</label>
                                    <input type="decimal" class="form-control" name="mon_des30" autocomplete="off" id="mon_des30">
                                  </div>
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