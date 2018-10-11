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
                          <h1 class="box-title">Trabajador
                          <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> 
                         <a href="../reportes/rpt_xls_trabajador.php" target="_blank"><button class="btn btn-info">Reporte</button></a> </h1>
                         <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>EST</th>
                            <th>Tipo Planilla</th>
                            <th>Sucursal Anexo</th>
                            <th>Codigo</th>
                            <th>Dni</th>
                            <th>Nombres</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Estado</th>
                            <th>Principal</th>
                            <th>Datos</th>
                            <th>Data Adjunta</th>
                            <th>Anular</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>EST</th>
                            <th>Tipo Planilla</th>
                            <th>Sucursal Anexo</th>
                            <th>Cod.</th>
                            <th>Dni</th>
                            <th>Nombres</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Estado</th>
                            <th>Principal</th>
                            <th>Datos</th>
                            <th>Data Adjunta</th>
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
                                    <input type="hidden" name="CantItems" id="CantItems">
                                   <input type="text" class="form-control" name="nom_trab" id="nom_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Ap.Paterno(*):</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apepat_trab" id="apepat_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Ap.Materno(*):</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apemat_trab" id="apemat_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Id.trabajador(*):</label>
                                <div class="col-lg-1">
                                   <input type="text" readonly class="form-control" name="id_trab" id="id_trab"  autocomplete="off">
                                </div>
                             
                           </div>


                             <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Direccion(*):</label>
                                <div class="col-lg-2">
                                  <input type="text" class="form-control" name="dir_trab" id="dir_trab"  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Urbanizacion(*):</label>
                                <div class="col-lg-2">
                                  <input type="text" class="form-control" name="urb_trab" id="urb_trab"  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Distrito(*):</label>
                                <div class="col-lg-2">
                                  <select id="id_distrito" name="id_distrito" class="form-control selectpicker" data-live-search="true"></select>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Departamento:</label>
                                <div class="col-lg-2">
                                  <input type="text" class="form-control" name="departamento" id="departamento"  autocomplete="off">
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
                                  <input type="date" class="form-control" name="fec_nac_trab" id="fec_nac_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Lugar Nac:</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="lug_nac_trab" id="lug_nac_trab"  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Edad</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" readonly  name="edad_trab" id="edad_trab">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Nacionalidad</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="nacionalidad" id="nacionalidad"  autocomplete="off">
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
                                  <select id="id_tip_doc" name="id_tip_doc" class="form-control selectpicker" data-live-search="true" required></select>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Dni(*):</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="num_doc_trab" id="num_doc_trab" required  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Tlf. Docimicilio:</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="num_tlf_dom" id="num_tlf_dom"  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Tlf. Celular:</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="num_tlf_cel" id="num_tlf_cel"  autocomplete="off"> 
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">E-Mail</label>
                                <div class="col-lg-2">
                                  <input type="text" class="form-control" name="email_trab" id="email_trab"  autocomplete="off">
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
                                <select id="id_sucursal" name="id_sucursal" class="form-control selectpicker" data-live-search="true" required></select>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Funcion(*):</label>
                                <div class="col-lg-2">
                                <select id="id_funcion" name="id_funcion" class="form-control selectpicker" data-live-search="true"></select>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Area(*):</label>
                                <div class="col-lg-2">
                                <select id="id_area" name="id_area" class="form-control selectpicker" data-live-search="true"></select>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Turno(*):</label>
                                <div class="col-lg-2">
                                <select id="id_turno" name="id_turno" class="form-control selectpicker" data-live-search="true"></select>
                                </div>
                            </div>

                            

                            <div class="form-group  col-xs-12">

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Cond.Laboral:</label>
                                <div class="col-lg-1">
                                <select id="id_tip_plan" name="id_tip_plan" class="form-control selectpicker" data-live-search="true"></select>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fec.Ing.Actual:</label>
                                <div class="col-lg-2">
                                <input type="date" class="form-control" name="fec_ing_trab" id="fec_ing_trab"  autocomplete="off" required>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fecha Cese:</label>
                                <div class="col-lg-2">
                                <input type="date" class="form-control" name="fec_sal_trab" id="fec_sal_trab"  autocomplete="off">
                                </div>
                            </div>


                            <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Remuneracion:</label>
                                <div class="col-lg-1">
                                <input type="text" class="form-control" name="sueldo_trab" id="sueldo_trab"  autocomplete="off">
                                </div>
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fec.Ing.Ant2:</label>
                                <div class="col-lg-2">
                                <input type="date" class="form-control" name="fec_ing2" id="fec_ing2"  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fec.Cese.Ant2:</label>
                                <div class="col-lg-2">
                                <input type="date" class="form-control" name="fec_sal2" id="fec_sal2"  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Motivo Salida:</label>
                                <div class="col-lg-3">
                                <input type="text" class="form-control" name="mot_sal2" id="mot_sal2"  autocomplete="off">
                                </div>


                                
                            </div>


                            <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Bono:</label>
                                <div class="col-lg-1">
                                <input type="text" class="form-control" name="bono_trab" id="bono_trab"  autocomplete="off">
                                </div>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fec.Ing.Ant1:</label>
                                <div class="col-lg-2">
                                <input type="date" class="form-control" name="fec_ing1" id="fec_ing1"  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fec.Cese.Ant1:</label>
                                <div class="col-lg-2">
                                <input type="date" class="form-control" name="fec_sal1" id="fec_sal1"  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Motivo Salida:</label>
                                <div class="col-lg-3">
                                <input type="text" class="form-control" name="mot_sal1" id="mot_sal1"  autocomplete="off">
                                </div>
                             </div>

                             <div class="form-group  col-xs-12">
                                
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Bono Destajo:</label>
                                <div class="col-lg-1">
                                <input type="text" class="form-control" name="bono_des_trab" id="bono_des_trab"  autocomplete="off">
                                </div>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fec.Ing Interno:</label>
                                <div class="col-lg-2">
                                <input type="date" class="form-control" name="fec_ing_interno" id="fec_ing_interno"  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fec.Cese Interno:</label>
                                <div class="col-lg-2">
                                <input type="date" class="form-control" name="fec_sal_interno" id="fec_sal_interno"  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Motivo Salida:</label>
                                <div class="col-lg-3">
                                <input type="text" class="form-control" name="mot_sal_interno" id="mot_sal_interno"  autocomplete="off">
                                </div>

                            </div>
                     
                     
                     
                            

                            <div class="form-group  col-xs-12">

                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Asig.Familiar:</label>
                                    <div class="col-lg-1">
                                    <input type="text" class="form-control" name="asig_trab" id="asig_trab"  autocomplete="off">
                                    </div>  

                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Pago Especial:</label>
                                      <div class="col-lg-2">
                                      <select id="id_pag_esp" name="id_pag_esp" class="form-control selectpicker" data-live-search="true"></select>
                                      </div>


                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Observaciones:</label>
                                    <div class="col-lg-6">
                                    <input type="text" class="form-control" name="obs_trab" id="obs_trab"  autocomplete="off">
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
                                    
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fin.ContratoAnterior:</label>
                                    <div class="col-lg-2">
                                      <input type="date" class="form-control" name="fecfin_con_ant" id="fecfin_con_ant"  autocomplete="off">
                                    </div>
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Fin.ContratoActual:</label>
                                    <div class="col-lg-2">
                                      <input type="date" class="form-control" name="fecfin_con_act" id="fecfin_con_act"  autocomplete="off">
                                    </div>
                                    <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Codigo.Cusp:</label>
                                    <div class="col-lg-2">
                                      <input type="text" class="form-control" name="cusp_trab" id="cusp_trab"  autocomplete="off">
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

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">FEC.NAC</label>
                               
                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">APELLIDOS y NOMBRES</label>
                               
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">OCUPACION</label>
                                
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">DEPENDE DE UD</label>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">TELEFONO</label>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">FECHA DE ENTREGA DE DATOS</label>
                          </div>

                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Padre/ Vive:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="viv_pad" id="viv_pad"  autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_pad" id="nom_pad"  autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_pad" id="ocu_pad"  autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_pad" id="dep_pad"  autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="tel_pad" id="tel_pad"  autocomplete="off">
                                </div>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>

                                <div class="col-lg-2">
                                   <input type="date"  class="form-control" name="fec_rec_dat" id="fec_rec_dat"  autocomplete="off">
                                </div>
                             
                          </div>


                             <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Madre/ Vive:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="viv_mad" id="viv_mad"  autocomplete="off">
                                </div>
                                 <div class="col-lg-2">
                                   <input type="text"  class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_mad" id="nom_mad"  autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_mad" id="ocu_mad"  autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_mad" id="dep_mad"  autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="tel_mad" id="tel_mad"  autocomplete="off">
                                </div>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label" ALIGN="center">COD.TRAB</label>
                              


                            </div>


                              <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Conguye/ Vive:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="viv_con" id="viv_con"  autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control"  readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_con" id="nom_con"  autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_con" id="ocu_con"  autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_con" id="dep_con"  autocomplete="off">
                                </div>
                                 <div class="col-lg-1">
                                   <input type="text" class="form-control" name="tel_con" id="tel_con"  autocomplete="off">
                                </div>

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" readonly name="prueba" id="prueba"  autocomplete="off">
                                </div>
                            </div>


                             <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Hijos/FecNac.</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control"  readonly >
                                </div>
                                <div class="col-lg-2">
                                   <input type="date"  class="form-control" name="nac_hij1" id="nac_hij1"  autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_hij1" id="nom_hij1"  autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_hij1" id="ocu_hij1" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_hij1" id="dep_hij1" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="tel_hij1" id="tel_hij1" autocomplete="off">
                                </div>
                                
                            </div>



                               <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Hijos/FecNac.</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="date"  class="form-control" name="nac_hij2" id="nac_hij2" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_hij2" id="nom_hij2" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_hij2" id="ocu_hij2" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_hij2" id="dep_hij2" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="tel_hij2" id="tel_hij2" autocomplete="off">
                                </div>
                            </div>


                              <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Hijos/FecNac.:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="date"  class="form-control" name="nac_hij3" id="nac_hij3" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_hij3" id="nom_hij3" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_hij3" id="ocu_hij3" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_hij3" id="dep_hij3" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="tel_hij3" id="tel_hij3" autocomplete="off">
                                </div>
                            </div>


                              <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Hijos/FecNac.</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="date"  class="form-control" name="nac_hij4" id="nac_hij4" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_hij4" id="nom_hij4"  autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_hij4" id="ocu_hij4" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_hij4" id="dep_hij4" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="tel_hij4" id="tel_hij4" autocomplete="off">
                                </div>
                            </div>


                               <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                 <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Otro:</label>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_otro" id="nom_otro" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text" class="form-control" name="ocu_otro" id="ocu_otro" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="dep_otro" id="dep_otro" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="tel_otro" id="tel_otro" autocomplete="off">
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
                                   <input type="text" class="form-control" name="nom_fam_con" id="nom_fam_con" autocomplete="off">
                                </div>
                                <div class="col-lg-1">
                                   <input type="text"  class="form-control" name="par_fam_con" id="par_fam_con" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control" name="are_fam_con" id="are_fam_con" autocomplete="off">
                                </div>
                          </div>

                       </div>



                       <div class="box-header with-border">


                          <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">NIVEL</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">CENTRO DE ESTUDIO</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">CARRERA</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">GRADO</label>
                               
                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">DESDE(MES/AÑO)</label>
                               
                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">HASTA(MES/AÑO)</label>

                          </div>

                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Primaria:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_pri" id="cen_est_pri" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control"  name="grado_pri" id="grado_pri" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_ini_pri" id="fec_ini_pri" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_fin_pri" id="fec_fin_pri" autocomplete="off">
                                </div>
                               
                          </div> 

                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Secundaria:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_sec" id="cen_est_sec" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control"  name="grado_sec" id="grado_sec" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_ini_sec" id="fec_ini_sec" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_fin_sec" id="fec_fin_sec" autocomplete="off">
                                </div>
                               
                          </div>


                          <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Superior:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_sup" id="cen_est_sup" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control"  name="carrera_sup" id="carrera_sup" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control"  readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_des_sup" id="fec_des_sup" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_has_sup" id="fec_has_sup" autocomplete="off">
                                </div>
                               
                          </div>



                          <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Tecnico:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_tec" id="cen_est_tec" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="carrera_tec" id="carrera_tec" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_ini_tec" id="fec_ini_tec" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_fin_tec" id="fec_fin_tec" autocomplete="off">
                                </div>
                               
                          </div>



                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Especialidad:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_esp" id="cen_est_esp" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control"  name="especialidad" id="especialidad" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control"  readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_ini_esp" id="fec_ini_esp" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_fin_esp" id="fec_fin_esp" autocomplete="off">
                                </div>
                               
                          </div>


                          <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Otros:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_otros" id="cen_est_otros" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="carrera_otros" id="carrera_otros" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control" readonly>
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_ini_otros" id="fec_ini_otros" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_fin_otros" id="fec_fin_otros" autocomplete="off">
                                </div>
                               
                          </div>



                       </div>



                      <div class="box-header with-border">



                          <div class="form-group  col-xs-12">
                                <label class="col-col-lg--2 col-md-2 col-sm-2 control-label">IDIOMAS</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">CENTRO DE ESTUDIO</label>

                                <label class="col-col-lg-3 col-md-3 col-sm-3 control-label">NIVEL(BASICO, INTERMEDIO o AVANZADO)</label>

                                
                          </div>

                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="des_idioma" id="des_idioma" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_idioma" id="cen_est_idioma" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nivel_idioma" id="nivel_idioma" autocomplete="off">
                                </div>
                                
                             </div>



                          <div class="form-group  col-xs-12">
                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">CURSOS DE COMPUTACION</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">CENTRO DE ESTUDIO</label>

                                <label class="col-col-lg-3 col-md-3 col-sm-3 control-label">NIVEL(BASICO, INTERMEDIO o AVANZADO)</label>

                          </div>


                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="des_comp" id="des_comp" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="cen_est_comp" id="cen_est_comp" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control" name="nivel_comp" id="nivel_comp" autocomplete="off">
                                </div>
                                
                               
                          </div>





                      </div>

                      <div class="box-header with-border">


                         <div class="form-group  col-xs-12">
                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">EMPRESA</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">CARGO</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">FUNCIONES</label>
                               
                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">DESDE(MES/AÑO)</label>
                               
                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">HASTA(MES/AÑO)</label>

                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">MOTIVO DE CESE</label>

                          </div>

                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_emp_exp1" id="nom_emp_exp1" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="car_exp1" id="car_exp1" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control" name="fun_exp1" id="fun_exp1" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_ini_exp1" id="fec_ini_exp1" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_fin_exp1" id="fec_fin_exp1" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="mot_ces_exp1" id="mot_ces_exp1" autocomplete="off">
                                </div>
                          </div>


                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_emp_exp2" id="nom_emp_exp2" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="car_exp2" id="car_exp2" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control" name="fun_exp2" id="fun_exp2" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_ini_exp2" id="fec_ini_exp2" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_fin_exp2" id="fec_fin_exp2" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="mot_ces_exp2" id="mot_ces_exp2" autocomplete="off">
                                </div>
                          </div>



                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="nom_emp_exp3" id="nom_emp_exp3" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="car_exp3" id="car_exp3" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text"  class="form-control" name="fun_exp3" id="fun_exp3" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_ini_exp3" id="fec_ini_exp3" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="date" class="form-control" name="fec_fin_exp3" id="fec_fin_exp3" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="mot_ces_exp3" id="mot_ces_exp3" autocomplete="off">
                                </div>
                            </div>




                      </div>


                      <div class="box-header with-border">

                            <!-- fila 1 -->
                             <div class="form-group  col-xs-12">
                                  <label class="col-col-lg-5 col-md-5 col-sm-5 control-label">Tiene antecedentes de enfermedades cardiacas y/o oncologicas? Mencionelas</label>
                                  <div class="col-lg-4">
                                     <input type="text" class="form-control" name="tie_enf_car_onc" id="tie_enf_car_onc" autocomplete="off">
                                  </div>
                             </div>

                             <div class="form-group  col-xs-12">
                                  <label class="col-col-lg-5 col-md-5 col-sm-5 control-label">Actualmente sufre de algun tipo de alergia/medicamento</label>
                                  <div class="col-lg-4">
                                     <input type="text" class="form-control" name="tie_enf_ale_rec" id="tie_enf_ale_rec" autocomplete="off">
                                  </div>
                             </div>


                              <div class="form-group  col-xs-12">
                                  <label class="col-col-lg-5 col-md-5 col-sm-5 control-label">Actualmente sufre de alguna enfermedad? Cual?</label>
                                  <div class="col-lg-4">
                                     <input type="text" class="form-control" name="nom_enf_car_onc" id="nom_enf_car_onc" autocomplete="off">
                                  </div>
                              </div>


                      </div>


                       <div class="box-header with-border">

                                    <div class="form-group  col-xs-12">
                                        <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Grup.Sanguineo:</label>
                                        <div class="col-lg-2">
                                          <select id="id_gru_san" name="id_gru_san" class="form-control selectpicker" data-live-search="true"></select>
                                        </div>
                                        
                                        <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Peso:</label>
                                        <div class="col-lg-2">
                                        <input type="text" class="form-control" name="peso" id="peso" autocomplete="off">
                                        </div>
                                        <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Talla:</label>
                                        <div class="col-lg-2">
                                        <input type="text" class="form-control" name="talla" id="talla" autocomplete="off">
                                        </div>
                                    </div>

                       </div>




                     





                        <div class="box-header with-border">

                            <!-- fila 1 -->
                             <div class="form-group  col-xs-12">
                                  <label class="col-col-lg-2 col-md- col-sm-2 control-label">Esta afiliado a ONP?(SI/NO)</label>
                                  <div class="col-lg-1">
                                     <input type="text" class="form-control" name="afi_onp" id="afi_onp" autocomplete="off">
                                  </div>
                                 
                             </div>


                              <div class="form-group  col-xs-12">
                                  <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">Esta afiliado a AFP?(SI/NO)</label>
                                  <div class="col-lg-1">
                                     <input type="text" class="form-control" name="afi_afp" id="afi_afp" autocomplete="off">
                                  </div>
                                  <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Cual?</label>
                                  <div class="col-lg-2">
                                     <input type="text" class="form-control" name="nom_afi_afp" id="nom_afi_afp" autocomplete="off">
                                  </div>
                              </div>


                        </div>


                          <div class="form-group  col-xs-12">
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Código:</label>
                            <input type="text" class="form-control" name="codigo" id="codigo" readonly placeholder="Código Barras">
                            <button class="btn btn-success" type="button" onclick="generarbarcode()">Generar</button>
                            <button class="btn btn-info" type="button" onclick="imprimir()">Imprimir</button>
                            <div id="print">
                              <svg id="barcode"></svg>
                            </div>
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




                    <div class="panel-body" id="formularioregistros_data_adjunta">
                        <form name="formulario_data_adjunta" id="formulario_data_adjunta" method="POST">

                

                            
                            <input type="hidden" class="form-control" name="id_trab_data_adjunta" id="id_trab_data_adjunta" >
                             

                             <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                               <label>Foto:</label>
                               <input type="file" class="form-control" name="foto_trab" id="foto_trab">
                               <input type="hidden" name="imagenactual_foto_trab" id="imagenactual_foto_trab">
                               <img src="" width="37px" height="30px" id="foto_trab_muestra">
                             </div>


                             <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                               <label>Hijo1:</label>
                               <input type="file" class="form-control" name="dat_hij1" id="dat_hij1">
                               <input type="hidden" name="imagenactual_dat_hij1" id="imagenactual_dat_hij1">
                               <img src="" width="37px" height="30px" id="dat_hij1_muestra">
                             </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                              <label>Hij2:</label>
                              <input type="file" class="form-control" name="dat_hij2" id="dat_hij2">
                              <input type="hidden" name="imagenactual_dat_hij2" id="imagenactual_dat_hij2">
                              <img src="" width="37px" height="30px" id="dat_hij2_muestra">
                            </div>


                           <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                             <label>Hijo3:</label>
                             <input type="file" class="form-control" name="dat_hij3" id="dat_hij3">
                             <input type="hidden" name="imagenactual_dat_hij3" id="imagenactual_dat_hij3">
                             <img src="" width="37px" height="30px" id="dat_hij3_muestra">
                           </div>

                           <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                             <label>Hijo4:</label>
                             <input type="file" class="form-control" name="dat_hij4" id="dat_hij4">
                             <input type="hidden" name="imagenactual_dat_hij4" id="imagenactual_dat_hij4">
                             <img src="" width="37px" height="30px" id="dat_hij4_muestra">
                           </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Data Conyuge:</label>
                                <input type="file" class="form-control" name="dat_con" id="dat_con">
                                <input type="hidden" name="imagenactual_dat_con" id="imagenactual_dat_con">
                                <img src="" width="37px" height="30px" id="dat_con_muestra">
                            </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Recibo Luz y/o Agua:</label>
                                <input type="file" class="form-control" name="dat_luz_agua" id="dat_luz_agua">
                                <input type="hidden" name="imagenactual_dat_luz_agua" id="imagenactual_dat_luz_agua">
                                <img src="" width="37px" height="30px" id="dat_luz_agua_muestra">
                            </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Antecedentes Policiales:</label>
                                <input type="file" class="form-control" name="dat_ant_pol" id="dat_ant_pol">
                                <input type="hidden" name="imagenactual_dat_ant_pol" id="imagenactual_dat_ant_pol">
                                <img src="" width="37px" height="30px" id="dat_ant_pol_muestra">
                            </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Certificado Medico:</label>
                                <input type="file" class="form-control" name="dat_cer_med" id="dat_cer_med">
                                <input type="hidden" name="imagenactual_dat_cer_med" id="imagenactual_dat_cer_med">
                                <img src="" width="37px" height="30px" id="dat_cer_med_muestra">
                            </div>



                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Declaracion Jurada Domicilio:</label>
                                <input type="file" class="form-control" name="dat_dec_dom" id="dat_dec_dom">
                                <input type="hidden" name="imagenactual_dat_dec_dom" id="imagenactual_dat_dec_dom">
                                <img src="" width="37px" height="30px" id="dat_dec_dom_muestra">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Curriculum Vitae:</label>
                                <input type="file" class="form-control" name="dat_cv" id="dat_cv">
                                <input type="hidden" name="imagenactual_dat_cv" id="imagenactual_dat_cv">
                                <img src="" width="37px" height="30px" id="dat_cv_muestra">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Grados y Titulos:</label>
                                <input type="file" class="form-control" name="dat_gra_tit" id="dat_gra_tit">
                                <input type="hidden" name="imagenactual_dat_gra_tit" id="imagenactual_dat_gra_tit">
                                <img src="" width="37px" height="30px" id="dat_gra_tit_muestra">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Idiomas:</label>
                                <input type="file" class="form-control" name="dat_idi" id="dat_idi">
                                <input type="hidden" name="imagenactual_dat_idi" id="imagenactual_dat_idi">
                                <img src="" width="37px" height="30px" id="dat_idi_muestra">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Certificados Tecnicos:</label>
                                <input type="file" class="form-control" name="dat_cer_tec" id="dat_cer_tec">
                                <input type="hidden" name="imagenactual_dat_cer_tec" id="imagenactual_dat_cer_tec">
                                <img src="" width="37px" height="30px" id="dat_cer_tec_muestra">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Documentos Adicionales:</label>
                                <input type="file" class="form-control" name="dat_adi" id="dat_adi">
                                <input type="hidden" name="imagenactual_dat_adi" id="imagenactual_dat_adi">
                                <img src="" width="37px" height="30px" id="dat_adi_muestra">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Certificado Trabajo1:</label>
                                <input type="file" class="form-control" name="dat_cer_tra1" id="dat_cer_tra1">
                                <input type="hidden" name="imagenactual_dat_cer_tra1" id="imagenactual_dat_cer_tra1">
                                <img src="" width="37px" height="30px" id="dat_cer_tra1_muestra">
                            </div>



                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Certificado Trabajo2:</label>
                                <input type="file" class="form-control" name="dat_cer_tra2" id="dat_cer_tra2">
                                <input type="hidden" name="imagenactual_dat_cer_tra2" id="imagenactual_dat_cer_tra2">
                                <img src="" width="37px" height="30px" id="dat_cer_tra2_muestra">
                            </div>



                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Certificado Trabajo3:</label>
                                <input type="file" class="form-control" name="dat_cer_tra3" id="dat_cer_tra3">
                                <input type="hidden" name="imagenactual_dat_cer_tra3" id="imagenactual_dat_cer_tra3">
                                <img src="" width="37px" height="30px" id="dat_cer_tra3_muestra">
                            </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Certificado Responsabilides1:</label>
                                <input type="file" class="form-control" name="dat_cer_res1" id="dat_cer_res1">
                                <input type="hidden" name="imagenactual_dat_cer_res1" id="imagenactual_dat_cer_res1">
                                <img src="" width="37px" height="30px" id="dat_cer_res1_muestra">
                            </div>


                             <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Certificado Responsabilides2:</label>
                                <input type="file" class="form-control" name="dat_cer_res2" id="dat_cer_res2">
                                <input type="hidden" name="imagenactual_dat_cer_res2" id="imagenactual_dat_cer_res2">
                                <img src="" width="37px" height="30px" id="dat_cer_res2_muestra">
                            </div>


                             <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Certificado Responsabilides3:</label>
                                <input type="file" class="form-control" name="dat_cer_res3" id="dat_cer_res3">
                                <input type="hidden" name="imagenactual_dat_cer_res3" id="imagenactual_dat_cer_res3">
                                <img src="" width="37px" height="30px" id="dat_cer_res3_muestra">
                            </div>




                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Pasaporte:</label>
                                <input type="file" class="form-control" name="dat_pas" id="dat_pas">
                                <input type="hidden" name="imagenactual_dat_pas" id="imagenactual_dat_pas">
                                <img src="" width="37px" height="30px" id="dat_pas_muestra">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Brevete:</label>
                                <input type="file" class="form-control" name="dat_bre" id="dat_bre">
                                <input type="hidden" name="imagenactual_dat_bre" id="imagenactual_dat_bre">
                                <img src="" width="37px" height="30px" id="dat_bre_muestra">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Planilla -Hoja de resumen de liquidacion 1:</label>
                                <input type="file" class="form-control" name="dat_pla_liq1" id="dat_pla_liq1">
                                <input type="hidden" name="imagenactual_dat_pla_liq1" id="imagenactual_dat_pla_liq1">
                                <img src="" width="37px" height="30px" id="dat_pla_liq1_muestra">
                            </div>

                          

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Planilla -Hoja de resumen de liquidacion 2:</label>
                                <input type="file" class="form-control" name="dat_pla_liq2" id="dat_pla_liq2">
                                <input type="hidden" name="imagenactual_dat_pla_liq2" id="imagenactual_dat_pla_liq2">
                                <img src="" width="37px" height="30px" id="dat_pla_liq2_muestra">
                            </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Planilla -Hoja de resumen de liquidacion 3:</label>
                                <input type="file" class="form-control" name="dat_pla_liq3" id="dat_pla_liq3">
                                <input type="hidden" name="imagenactual_dat_pla_liq3" id="imagenactual_dat_pla_liq3">
                                <img src="" width="37px" height="30px" id="dat_pla_liq3_muestra">
                            </div>




                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Interno -Hoja de resumen de liquidacion 1:</label>
                                <input type="file" class="form-control" name="dat_int_liq1" id="dat_int_liq1">
                                <input type="hidden" name="imagenactual_dat_int_liq1" id="imagenactual_dat_int_liq1">
                                <img src="" width="37px" height="30px" id="dat_int_liq1_muestra">
                            </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Interno -Hoja de resumen de liquidacion 2:</label>
                                <input type="file" class="form-control" name="dat_int_liq2" id="dat_int_liq2">
                                <input type="hidden" name="imagenactual_dat_int_liq2" id="imagenactual_dat_int_liq2">
                                <img src="" width="37px" height="30px" id="dat_int_liq2_muestra">
                            </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Interno -Hoja de resumen de liquidacion 3:</label>
                                <input type="file" class="form-control" name="dat_int_liq3" id="dat_int_liq3">
                                <input type="hidden" name="imagenactual_dat_int_liq3" id="imagenactual_dat_int_liq3">
                                <img src="" width="37px" height="30px" id="dat_int_liq3_muestra">
                            </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Cts1:</label>
                                <input type="file" class="form-control" name="dat_car_ret_cts1" id="dat_car_ret_cts1">
                                <input type="hidden" name="imagenactual_dat_car_ret_cts1" id="imagenactual_dat_car_ret_cts1">
                                <img src="" width="37px" height="30px" id="dat_car_ret_cts1_muestra">
                            </div>
                            

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Cts2:</label>
                                <input type="file" class="form-control" name="dat_car_ret_cts2" id="dat_car_ret_cts2">
                                <input type="hidden" name="imagenactual_dat_car_ret_cts2" id="imagenactual_dat_car_ret_cts2">
                                <img src="" width="37px" height="30px" id="dat_car_ret_cts2_muestra">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Cts3:</label>
                                <input type="file" class="form-control" name="dat_car_ret_cts3" id="dat_car_ret_cts3">
                                <input type="hidden" name="imagenactual_dat_car_ret_cts3" id="imagenactual_dat_car_ret_cts3">
                                <img src="" width="37px" height="30px" id="dat_car_ret_cts3_muestra">
                            </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Alta de Registro1:</label>
                                <input type="file" class="form-control" name="dat_alt_reg1" id="dat_alt_reg1">
                                <input type="hidden" name="imagenactual_dat_alt_reg1" id="imagenactual_dat_alt_reg1">
                                <img src="" width="37px" height="30px" id="dat_alt_reg1_muestra">
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Alta de Registro2:</label>
                                <input type="file" class="form-control" name="dat_alt_reg2" id="dat_alt_reg2">
                                <input type="hidden" name="imagenactual_dat_alt_reg2" id="imagenactual_dat_alt_reg2">
                                <img src="" width="37px" height="30px" id="dat_alt_reg2_muestra">
                            </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Alta de Registro3:</label>
                                <input type="file" class="form-control" name="dat_alt_reg3" id="dat_alt_reg3">
                                <input type="hidden" name="imagenactual_dat_alt_reg3" id="imagenactual_dat_alt_reg3">
                                <img src="" width="37px" height="30px" id="dat_alt_reg3_muestra">
                            </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Baja de Registro1:</label>
                                <input type="file" class="form-control" name="dat_baj_reg1" id="dat_baj_reg1">
                                <input type="hidden" name="imagenactual_dat_baj_reg1" id="imagenactual_dat_baj_reg1">
                                <img src="" width="37px" height="30px" id="dat_baj_reg1_muestra">
                            </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Baja de Registro2:</label>
                                <input type="file" class="form-control" name="dat_baj_reg2" id="dat_baj_reg2">
                                <input type="hidden" name="imagenactual_dat_baj_reg2" id="imagenactual_dat_baj_reg2">
                                <img src="" width="37px" height="30px" id="dat_baj_reg2_muestra">
                            </div>


                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Baja de Registro3:</label>
                                <input type="file" class="form-control" name="dat_baj_reg3" id="dat_baj_reg3">
                                <input type="hidden" name="imagenactual_dat_baj_reg3" id="imagenactual_dat_baj_reg3">
                                <img src="" width="37px" height="30px" id="dat_baj_reg3_muestra">
                            </div>



                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Carta Renuncia:</label>
                                <input type="file" class="form-control" name="dat_car_ren" id="dat_car_ren">
                                <input type="hidden" name="imagenactual_dat_car_ren" id="imagenactual_dat_car_ren">
                                <img src="" width="37px" height="30px" id="dat_car_ren_muestra">
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