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
                          <h1 class="box-title">Maternidad<button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Est.</th>
                            <th>Sucursal</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Nombres</th>
                            <th>Est.Trabajador</th>
                            <th>Editar</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Est.</th>
                            <th>Sucursal</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Nombres</th>
                            <th>Est.Trabajador</th>
                            <th>Editar</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                 
                        
                          <div class="form-group  col-xs-12">

                                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                  <label>Colaboradora:</label>
                                  <input type="hidden" class="form-control" name="id_maternidad"  id="id_maternidad"   autocomplete="off">
                                  <select id="id_trab" name="id_trab" class="form-control selectpicker" data-live-search="true"></select>
                                </div>
                         </div>
                         

                          <div class="box-header with-border">

                                <div class="form-group  col-xs-12">
                                      <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <label>Fec.Nacimiento:</label>
                                        <input type="date" class="form-control" name="fec_nac_c1"  id="fec_nac_c1"   autocomplete="off">
                                      </div>

                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>HOSPITAL</label>
                                        <input type="text" class="form-control" name="lugar_c1" id="lugar_c1"  autocomplete="off">
                                      </div>

                                       <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>OBSERVACION</label>
                                        <input type="text" class="form-control" name="observa_c1" id="observa_c1"  autocomplete="off">
                                      </div>

                                </div>

                                <div class="form-group  col-xs-12">

                                     
                                       <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Subir Data Adjunta:</label>
                                        <input type="file" class="form-control" name="data_adjunta_hij1_c1" id="data_adjunta_hij1_c1">
                                        <input type="hidden" name="data_adjunta_hij1_c1_actual" id="data_adjunta_hij1_c1_actual">
                                        <img src="" width="150px" height="120px" id="data_adjunta_hij1_c1_muestra">
                                      </div>

                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Subir Data Adjunta:</label>
                                        <input type="file" class="form-control" name="data_adjunta_hij2_c1" id="data_adjunta_hij2_c1">
                                        <input type="hidden" name="data_adjunta_hij2_c1_actual" id="data_adjunta_hij2_c1_actual">
                                        <img src="" width="150px" height="120px" id="data_adjunta_hij2_c1_muestra">
                                      </div>


                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Subir Data Adjunta:</label>
                                        <input type="file" class="form-control" name="data_adjunta_hij3_c1" id="data_adjunta_hij3_c1">
                                        <input type="hidden" name="data_adjunta_hij3_c1_actual" id="data_adjunta_hij3_c1_actual">
                                        <img src="" width="150px" height="120px" id="data_adjunta_hij3_c1_muestra">
                                      </div>

                                      

                                </div>
                          </div>

                         
                          <div class="form-group  col-xs-12">
                          </div>

                          <div class="box-header with-border">

                                <div class="form-group  col-xs-12">
                                      <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <label>Fec.Nacimiento:</label>
                                        <input type="date" class="form-control" name="fec_nac_c2"  id="fec_nac_c2"   autocomplete="off">
                                      </div>

                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>HOSPITAL</label>
                                        <input type="text" class="form-control" name="lugar_c2" id="lugar_c2"  autocomplete="off">
                                      </div>

                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>OBSERVACION</label>
                                        <input type="text" class="form-control" name="observa_c2" id="observa_c2"  autocomplete="off">
                                      </div>

                                      <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                        <label>ESTADO</label>
                                        <input type="text" class="form-control" name="est_c2" id="est_c2"  autocomplete="off">
                                      </div>

                                 </div>

                                <div class="form-group  col-xs-12">

                                     
                                       <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Subir Data Adjunta:</label>
                                        <input type="file" class="form-control" name="data_adjunta_hij1_c2" id="data_adjunta_hij1_c2">
                                        <input type="hidden" name="data_adjunta_hij1_c2_actual" id="data_adjunta_hij1_c2_actual">
                                        <img src="" width="150px" height="120px" id="data_adjunta_hij1_c2_muestra">
                                      </div>

                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Subir Data Adjunta:</label>
                                        <input type="file" class="form-control" name="data_adjunta_hij2_c2" id="data_adjunta_hij2_c2">
                                        <input type="hidden" name="data_adjunta_hij2_c2_actual" id="data_adjunta_hij2_c2_actual">
                                        <img src="" width="150px" height="120px" id="data_adjunta_hij2_c2_muestra">
                                      </div>


                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Subir Data Adjunta:</label>
                                        <input type="file" class="form-control" name="data_adjunta_hij3_c2" id="data_adjunta_hij3_c2">
                                        <input type="hidden" name="data_adjunta_hij3_c2_actual" id="data_adjunta_hij3_c2_actual">
                                        <img src="" width="150px" height="120px" id="data_adjunta_hij3_c2_muestra">
                                      </div>

                                       

                                </div>

                          </div>



                          <div class="form-group  col-xs-12">
                          </div>

                          <div class="box-header with-border">

                                <div class="form-group  col-xs-12">
                                      <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <label>Fec.Nacimiento:</label>
                                        <input type="date" class="form-control" name="fec_nac_c3"  id="fec_nac_c3"   autocomplete="off">
                                      </div>

                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>HOSPITAL</label>
                                        <input type="text" class="form-control" name="lugar_c3" id="lugar_c3"  autocomplete="off">
                                      </div>

                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>OBSERVACION</label>
                                        <input type="text" class="form-control" name="observa_c3" id="observa_c3"  autocomplete="off">
                                      </div>


                                 </div>

                                <div class="form-group  col-xs-12">

                                     
                                       <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Subir Data Adjunta Hijo1:</label>
                                        <input type="file" class="form-control" name="data_adjunta_hij1_c3" id="data_adjunta_hij1_c3">
                                        <input type="hidden" name="data_adjunta_hij1_c3_actual" id="data_adjunta_hij1_c3_actual">
                                        <img src="" width="150px" height="120px" id="data_adjunta_hij1_c3_muestra">
                                      </div>

                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Subir Data Adjunta Hijo2:</label>
                                        <input type="file" class="form-control" name="data_adjunta_hij2_c3" id="data_adjunta_hij2_c3">
                                        <input type="hidden" name="data_adjunta_hij2_c3_actual" id="data_adjunta_hij2_c3_actual">
                                        <img src="" width="150px" height="120px" id="data_adjunta_hij2_c3_muestra">
                                      </div>


                                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label>Subir Data Adjunta Hijo3:</label>
                                        <input type="file" class="form-control" name="data_adjunta_hij3_c3" id="data_adjunta_hij3_c3">
                                        <input type="hidden" name="data_adjunta_hij3_c3_actual" id="data_adjunta_hij3_c3_actual">
                                        <img src="" width="150px" height="120px" id="data_adjunta_hij3_c3_muestra">
                                      </div>


                                       

                                </div>
                          </div>




                          

                          <div class="form-group  col-xs-12">
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
<script type="text/javascript" src="scripts/maternidad.js"></script>
<?php 
}
ob_end_flush();
?>