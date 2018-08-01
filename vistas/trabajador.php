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
                          <h1 class="box-title">Trabajador 
                          <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> 
                          <a href="../reportes/rptarticulos.php" target="_blank"><button class="btn btn-info">Reporte</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Id.Trabajador</th>
                            <th>Tipo Planilla</th>
                            <th>Sucursal Anexo</th>
                            <th>Dni</th>
                            <th>Nombres</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Datos</th>
                            <th>Anular</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Id.Trabajador</th>
                            <th>Tipo Planilla</th>
                            <th>Sucursal Anexo</th>
                            <th>Dni</th>
                            <th>Nombres</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Datos</th>
                            <th>Anular</th>
                          </tfoot>
                        </table>
                    </div>

                    <!--M,J,K,G,M -->


                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                        <div class="box-header with-border">
                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Nombre(*):</label>
                                <div class="col-lg-2">
                                   <input type="hidden" name="idarticulo" id="idarticulo">
                                   <input type="text" class="form-control" name="nom_trab" id="nom_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Ap.Paterno(*):</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apepat_trab" id="apepat_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Ap.Materno(*):</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apemat_trab" id="apemat_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Id.trabajador(*):</label>
                                <div class="col-lg-1">
                                   <input type="text" readonly class="form-control" name="id_trab" id="id_trab">
                                </div>
                             
                           </div>


                             <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Direccion(*):</label>
                                <div class="col-lg-2">
                                  <input type="text" class="form-control" name="dir_trab" id="dir_trab" >
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Urbanizacion(*):</label>
                                <div class="col-lg-2">
                                  <input type="text" class="form-control" name="urb_trab" id="urb_trab" >
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Distrito(*):</label>
                                <div class="col-lg-2">
                                  <select id="id_distrito" name="id_distrito" class="form-control selectpicker" data-live-search="true"></select>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Departamento:</label>
                                <div class="col-lg-2">
                                  <input type="text" class="form-control" name="departamento" id="departamento" >
                                </div>
                            </div>


                       </div>


                       <div class="form-group  col-xs-12">
                       </div>
                       <div class="form-group  col-xs-12">
                       </div>


                       <div class="box-header with-border">

                            <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fecha Nac.:</label>
                                <div class="col-lg-2">
                                  <input type="text" class="form-control" name="fec_nac_trab" id="fec_nac_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Lugar Nac:</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="lug_nac_trab" id="lug_nac_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Edad</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" readonly  name="edad_trab" id="edad_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Nacionalidad</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="nacionalidad" id="nacionalidad">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Est.Civil(*):</label>
                                <div class="col-lg-1">
                                   <select id="id_est_civil" name="id_est_civil" class="form-control selectpicker" data-live-search="true" ></select>
                                </div>
                            </div>

                          
                            <!-- fila 1 -->
                            <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Tipo de Doc(*):</label>
                                <div class="col-lg-2">
                                  <select id="id_tip_doc" name="id_tip_doc" class="form-control selectpicker" data-live-search="true"></select>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Dni(*):</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="num_doc_trab" id="num_doc_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Tlf. Docimicilio:</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="num_tlf_dom" id="num_tlf_dom">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Tlf. Celular:</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="num_tlf_cel" id="num_tlf_cel">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">E-Mail</label>
                                <div class="col-lg-2">
                                  <input type="text" class="form-control" name="email_trab" id="email_trab">
                                </div>
                            </div>

                    </div>



                    <div class="form-group  col-xs-12">
                    </div>
                    <div class="form-group  col-xs-12">
                    </div>
                        


                    <div class="box-header with-border">

                    
                            <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Sucursal(*):</label>
                                <div class="col-lg-2">
                                <select id="id_sucursal" name="id_sucursal" class="form-control selectpicker" data-live-search="true" ></select>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Funcion(*):</label>
                                <div class="col-lg-2">
                                <select id="id_funcion" name="id_funcion" class="form-control selectpicker" data-live-search="true" ></select>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Area(*):</label>
                                <div class="col-lg-2">
                                <select id="id_area" name="id_area" class="form-control selectpicker" data-live-search="true" ></select>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Turno(*):</label>
                                <div class="col-lg-2">
                                <select id="id_turno" name="id_turno" class="form-control selectpicker" data-live-search="true" ></select>
                                </div>
                            </div>

                            

                            <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">FechaIngreso:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="fec_ing_trab" id="fec_ing_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fecha Cese:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="fec_cese_trab" id="fec_cese_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Cond.Laboral:</label>
                                <div class="col-lg-2">
                                <select id="id_tip_plan" name="id_tip_plan" class="form-control selectpicker" data-live-search="true" ></select>
                                </div>
                            </div>


                            <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Remuneracion:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="sueldo_trab" id="sueldo_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Bono:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="bono_trab" id="bono_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Asig.Familiar:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="asig_trab" id="asig_trab">
                                </div>
                            </div>
                     
                            

                            <div class="form-group  col-xs-12">
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Observaciones:</label>
                                    <div class="col-lg-5">
                                    <input type="text" class="form-control" name="obs_trab" id="obs_trab">
                                    </div>
                            </div>


                      </div> 

                      <div class="form-group  col-xs-12">
                      </div>
                      <div class="form-group  col-xs-12">
                      </div>



                      <div class="box-header with-border">
                            <div class="form-group  col-xs-12">
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Centro.Costos:</label>
                                    <div class="col-lg-2">
                                     <select id="id_cen_cost" name="id_cen_cost" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Tip.Mano Obra:</label>
                                    <div class="col-lg-2">
                                     <select id="id_tip_man_ob" name="id_tip_man_ob" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">CategoriaLaboral:</label>
                                    <div class="col-lg-2">
                                     <select id="id_categoria" name="id_categoria" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Forma de Pago:</label>
                                    <div class="col-lg-2">
                                     <select id="id_form_pag" name="id_form_pag" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>
                                    
                            </div>

                            <div class="form-group  col-xs-12">
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Tip.Contrato:</label>
                                    <div class="col-lg-2">
                                      <select id="id_tip_cont" name="id_tip_cont" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Regimen.Pensionario:</label>
                                    <div class="col-lg-2">
                                      <select id="id_reg_pen" name="id_reg_pen" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Comisión Actual:</label>
                                    <div class="col-lg-2">
                                      <select id="id_com_act" name="id_com_act" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Genero:</label>
                                    <div class="col-lg-2">
                                      <select id="id_genero" name="id_genero" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>
                            </div>

                            <div class="form-group  col-xs-12">
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">T - Registro:</label>
                                    <div class="col-lg-2">
                                      <select id="id_t_registro" name="id_t_registro" class="form-control selectpicker" data-live-search="true"></select>
                                    </div>
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fin.ContratoAnterior:</label>
                                    <div class="col-lg-2">
                                      <input type="text" class="form-control" name="fecfin_con_ant" id="fecfin_con_ant">
                                    </div>
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fin.ContratoActual:</label>
                                    <div class="col-lg-2">
                                      <input type="text" class="form-control" name="fecfin_con_act" id="fecfin_con_act">
                                    </div>
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Codigo.Cusp:</label>
                                    <div class="col-lg-2">
                                      <input type="text" class="form-control" name="cusp_trab" id="cusp_trab">
                                    </div>

                            </div>





                      </div> 

                      <div class="form-group  col-xs-12">
                      </div>
                      <div class="form-group  col-xs-12">
                      </div>


                      <div class="box-header with-border">

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
<script type="text/javascript" src="scripts/trabajador.js"></script>
<?php 
}
ob_end_flush();
?>