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
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Regimen Pensionario <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Codigo</th>
                            <th>Año</th>
                            <th>Observación</th>
                            <th>Ver</th>
                            <th>Anular</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Codigo</th>
                            <th>Año</th>
                            <th>Observación</th>
                            <th>Ver</th>
                            <th>Anular</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          

                          <div class="box-header with-border">
                              <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                <label>Año:</label>
                                <input type="text" class="form-control" name="id_ano" id="id_ano" required>
                              </div>
                              
                              <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <label>Obs Reg.Pensionario:</label>
                                <input type="text" class="form-control" name="obs_reg_pen" id="obs_reg_pen" >
                              </div>

                              <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                              </div>

                              <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                <label>Codigo:</label>
                                <input type="text" class="form-control" name="id_reg_pen" id="id_reg_pen" readonly>
                              </div>


                          </div>





                          <div class="box-header with-border">

                          <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">FONDO</label>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">APORTE OBLIG.</label>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">COM.MENSUAL REMUNER.</label>
                               
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">COM.ANUAL</label>
                               
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">COM.MENSUAL</label>
                                
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">PRIMA DE SEGUROS</label>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">TOT.APORTE ACTUAL</label>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">TOT.APORTE MIXTA</label>
                          </div>

                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">ONP:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="onp_apo_obl" id="onp_apo_obl">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="onp_com_men_rem" id="onp_com_men_rem">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="onp_com_anu" id="onp_com_anu">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="onp_com_men" id="onp_com_men">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="onp_pri_seg" id="onp_pri_seg">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="onp_apo_act" id="onp_apo_act">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="onp_apo_mix" id="onp_apo_mix">
                                </div>
                          </div>


                          <!-- fila 2 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">INTEGRA:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="int_apo_obl" id="int_apo_obl">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="int_com_men_rem" id="int_com_men_rem">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="int_com_anu" id="int_com_anu">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="int_com_men" id="int_com_men">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="int_pri_seg" id="int_pri_seg">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="int_apo_act" id="int_apo_act">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="int_apo_mix" id="int_apo_mix">
                                </div>
                          </div>



                          <!-- fila 3 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">PRIMA:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="pri_apo_obl" id="pri_apo_obl">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="pri_com_men_rem" id="pri_com_men_rem">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="pri_com_anu" id="pri_com_anu">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="pri_com_men" id="pri_com_men">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="pri_pri_seg" id="pri_pri_seg">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="pri_apo_act" id="pri_apo_act">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="pri_apo_mix" id="pri_apo_mix">
                                </div>
                          </div>


                          <!-- fila 4 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">PROFUTURO:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="pro_apo_obl" id="pro_apo_obl">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="pro_com_men_rem" id="pro_com_men_rem">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="pro_com_anu" id="pro_com_anu">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="pro_com_men" id="pro_com_men">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="pro_pri_seg" id="pro_pri_seg">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="pro_apo_act" id="pro_apo_act">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="pro_apo_mix" id="pro_apo_mix">
                                </div>
                          </div>


                          <!-- fila 4 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">HABITAT:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="hab_apo_obl" id="hab_apo_obl">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="hab_com_men_rem" id="hab_com_men_rem">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="hab_com_anu" id="hab_com_anu">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="hab_com_men" id="hab_com_men">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="hab_pri_seg" id="hab_pri_seg">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="hab_apo_act" id="hab_apo_act">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="hab_apo_mix" id="hab_apo_mix">
                                </div>
                          </div>


                          <!-- fila 4 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">SR.JOSE:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="sj_apo_obl" id="sj_apo_obl">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="sj_com_men_rem" id="sj_com_men_rem">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" readonly>
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" readonly>
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" readonly>
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" readonly>
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="sj_apo_mix" id="sj_apo_mix">
                                </div>
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
<script type="text/javascript" src="scripts/regimen_pensionario.js"></script>
<?php 
}
ob_end_flush();
?>