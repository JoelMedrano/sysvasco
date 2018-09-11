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
                          <h1 class="box-title">Reporte Diario de Tardanzas, Inasistencias y Permisos
                          <a href="../reportes/rptarticulos.php" target="_blank"><button class="btn btn-info">Reporte</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Cod.</th>
                            <th>Tipo Planilla</th>
                            <th>Sucursal Anexo</th>
                            <th>Dni</th>
                            <th>Nombres</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Condicion</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Cod.</th>
                            <th>Tipo Planilla</th>
                            <th>Sucursal Anexo</th>
                            <th>Dni</th>
                            <th>Nombres</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Condicion</th>
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

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Cond.Laboral:</label>
                                <div class="col-lg-2">
                                <select id="id_tip_plan" name="id_tip_plan" class="form-control selectpicker" data-live-search="true" ></select>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">FechaIngreso:</label>
                                <div class="col-lg-1">
                                <input type="text" class="form-control" name="fec_ing_trab" id="fec_ing_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fecha Cese:</label>
                                <div class="col-lg-1">
                                <input type="text" class="form-control" name="fec_cese_trab" id="fec_cese_trab">
                                </div>
                            </div>


                            <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Remuneracion:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="sueldo_trab" id="sueldo_trab">
                                </div>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fec.Ing Interno:</label>
                                <div class="col-lg-1">
                                <input type="text" class="form-control" name="fec_ing_interno" id="fec_ing_interno">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fec.Cese Interno:</label>
                                <div class="col-lg-1">
                                <input type="text" class="form-control" name="fec_sal_interno" id="fec_sal_interno">
                                </div>
                                
                            </div>


                            <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Bono:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="bono_trab" id="bono_trab">
                                </div>
                            </div>

                            <div class="form-group  col-xs-12">
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






                    <div class="panel-body" id="formularioregistrosdatos">
                        <form name="formulariodatos" id="formulariodatos" method="POST">

                        <div class="box-header with-border">

                        <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">FAMILIAR</label>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">VIVE</label>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">EDAD</label>
                               
                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">APELLIDOS y NOMBRES</label>
                               
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">OCUPACION</label>
                                
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">DEPENDE DE UD</label>

                                <label class="col-col-lg-3 col-md-3 col-sm-3 control-label"></label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">FECHA DE ENTREGA DE DATOS</label>
                          </div>

                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Padre/ Vive:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="viv_pad" id="viv_pad">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_pad" id="nom_pad">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_pad" id="ocu_pad">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_pad" id="dep_pad">
                                </div>

                                <label class="col-col-lg-3 col-md-3 col-sm-3 control-label"></label>

                                <div class="col-lg-2">
                                   <input type="text"  class="form-control" name="fec_rec_dat" id="fec_rec_dat">
                                </div>
                               
                               
                             
                          </div>


                             <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Madre/ Vive:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="viv_mad" id="viv_mad">
                                </div>
                                 <div class="col-lg-1">
                                   <input type="text"  class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_mad" id="nom_mad">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_mad" id="ocu_mad">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_mad" id="dep_mad">
                                </div>
                            </div>


                              <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Conguye/ Vive:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="viv_con" id="viv_con">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control"  readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_con" id="nom_con">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_con" id="ocu_con">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_con" id="dep_con">
                                </div>
                            </div>


                             <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Hijos/ Edad:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control"  readonly >
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="eda_hij1" id="eda_hij1">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_hij1" id="nom_hij1">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_hij1" id="ocu_hij1">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_hij1" id="dep_hij1">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Subir Info:</label>
                                <div class="col-lg-3">
                                  <input type="file" class="form-control" name="dat_hij1" id="dat_hij1">
                                  <input type="hidden" name="dat_hij1_actual" id="dat_hij1_actual">
                                  <img src="" width="150px" height="120px" id="dat_hij1_muestra">
                                </div>
                            </div>



                               <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Hijos/ Edad:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="eda_hij2" id="eda_hij2">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_hij2" id="nom_hij2">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_hij2" id="ocu_hij2">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_hij2" id="dep_hij2">
                                </div>
                            </div>


                              <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Hijos/ Edad:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="eda_hij3" id="eda_hij3">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_hij3" id="nom_hij3">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_hij3" id="ocu_hij3">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_hij3" id="dep_hij3">
                                </div>
                            </div>


                              <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Hijos/ Edad:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="eda_hij4" id="eda_hij4">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_hij4" id="nom_hij4">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_hij4" id="ocu_hij4">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_hij4" id="dep_hij4">
                                </div>
                            </div>

                            <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">APELLIDOS y NOMBRES</label>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">PARENTESCO</label>
                                
                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">AREA DE TRABAJO</label>
                          </div>


                           <div class="form-group  col-xs-12">
                               <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Parientes o conocidos en la empresa:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_fam_con" id="nom_fam_con">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="par_fam_con" id="par_fam_con">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control" name="are_fam_con" id="are_fam_con">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Pruebaaa Visibilidad:</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" name="prueba" id="prueba">
                                </div>
                            </div>

                       </div>



                       <div class="box-header with-border">


                          <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">NIVEL</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">CENTRO DE ESTUDIO</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">CARRERA</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">GRADO</label>
                               
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">DESDE(MES/AÑO)</label>
                               
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">HASTA(MES/AÑO)</label>

                          </div>

                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Primaria:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_pri" id="cen_est_pri">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control"  name="grado_pri" id="grado_pri"   >
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="fec_ini_pri" id="fec_ini_pri">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="fec_fin_pri" id="fec_fin_pri">
                                </div>
                               
                          </div>

                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Secundaria:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_sec" id="cen_est_sec">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control"  name="grado_sec" id="grado_sec"  >
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="fec_ini_sec" id="fec_ini_sec">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="fec_fin_sec" id="fec_fin_sec">
                                </div>
                               
                          </div>


                          <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Superior:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_sup" id="cen_est_sup">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control"  name="carrera_sup" id="carrera_sup">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control"  readonly>
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="fec_des_sup" id="fec_des_sup">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="fec_has_sup" id="fec_has_sup">
                                </div>
                               
                          </div>



                          <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Tecnico:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_tec" id="cen_est_tec">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="carrera_tec" id="carrera_tec" >
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control" readonly>
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="fec_ini_tec" id="fec_ini_tec">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="fec_fin_tec" id="fec_fin_tec">
                                </div>
                               
                          </div>



                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Especialidad:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_esp" id="cen_est_esp">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control"  name="especialidad" id="especialidad"  >
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control"  readonly>
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="fec_ini_esp" id="fec_ini_esp">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="fec_fin_esp" id="fec_fin_esp">
                                </div>
                               
                          </div>


                          <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Otros:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_otros" id="cen_est_otros">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="carrera_otros" id="carrera_otros" >
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control" readonly>
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="fec_ini_otros" id="fec_ini_otros">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="fec_fin_otros" id="fec_fin_otros">
                                </div>
                               
                          </div>



                       </div>



                      <div class="box-header with-border">



                          <div class="form-group  col-xs-12">
                                <label class="col-col-lg--2 col-md-2 col-sm-2 control-label">IDIOMAS</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">CENTRO DE ESTUDIO</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">NIVEL(BASICO, INTERMEDIO o AVANZADO)</label>

                                
                          </div>

                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="des_idioma" id="des_idioma">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_idioma" id="cen_est_idioma">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nivel_idioma" id="nivel_idioma">
                                </div>
                                
                             </div>



                          <div class="form-group  col-xs-12">
                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">CURSOS DE COMPUTACION</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">CENTRO DE ESTUDIO</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">NIVEL(BASICO, INTERMEDIO o AVANZADO)</label>

                          </div>

                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="des_comp" id="des_comp">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_comp" id="cen_est_comp">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control" name="nivel_comp" id="nivel_comp">
                                </div>
                                
                               
                          </div>




                      </div>


                      <div class="box-header with-border">

                            <!-- fila 1 -->
                             <div class="form-group  col-xs-12">
                                  <label class="col-col-lg-5 col-md-5 col-sm-5 control-label">Tiene antecedentes de enefermedades cardiacas y/o oncologicas? Mencionelas</label>
                                  <div class="col-lg-4">
                                     <input type="text" class="form-control" name="tie_enf_car_onc" id="tie_enf_car_onc">
                                  </div>
                                 
                             </div>


                              <div class="form-group  col-xs-12">
                                  <label class="col-col-lg-5 col-md-5 col-sm-5 control-label">Actualmente sufre de alguna enfermedad cronica? Cual?</label>
                                  <div class="col-lg-4">
                                     <input type="text" class="form-control" name="nom_enf_car_onc" id="nom_enf_car_onc">
                                  </div>
                              </div>


                      </div>



                        <div class="box-header with-border">

                            <!-- fila 1 -->
                             <div class="form-group  col-xs-12">
                                  <label class="col-col-lg-2 col-md- col-sm-2 control-label">Esta afiliado a ONP?(SI/NO)</label>
                                  <div class="col-lg-1">
                                     <input type="text" class="form-control" name="afi_onp" id="afi_onp">
                                  </div>
                                 
                             </div>


                              <div class="form-group  col-xs-12">
                                  <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">Esta afiliado a AFP?(SI/NO)</label>
                                  <div class="col-lg-1">
                                     <input type="text" class="form-control" name="afi_afp" id="afi_afp">
                                  </div>
                                  <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Cual?</label>
                                  <div class="col-lg-2">
                                     <input type="text" class="form-control" name="nom_afi_afp" id="nom_afi_afp">
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
<script type="text/javascript" src="scripts/reporte_diario_asistencia.js"></script>
<?php 
}
ob_end_flush();
?>