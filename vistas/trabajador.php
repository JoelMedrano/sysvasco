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
                          <h1 class="box-title">Trabajador <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> <a href="../reportes/rptarticulos.php" target="_blank"><button class="btn btn-info">Reporte</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Tipo Planilla</th>
                            <th>Sucursal Anexo</th>
                            <th>Dni</th>
                            <th>Nombres</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Tipo Planilla</th>
                            <th>Sucursal Anexo</th>
                            <th>Dni</th>
                            <th>Nombres</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                            <th>Opciones</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">



                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Id.trabajador(*):</label>
                            <input type="text" class="form-control" name="id_trab" id="id_trab"  required>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="hidden" name="idarticulo" id="idarticulo">
                            <input type="text" class="form-control" name="nom_trab" id="nom_trab"  required>
                          </div>

                         
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Ap.Paterno(*):</label>
                            <input type="text" class="form-control" name="apepat_trab" id="apepat_trab" required>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Ap.Materno(*):</label>
                            <input type="text" class="form-control" name="apemat_trab" id="apemat_trab"  required>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Tip.Doc(*):</label>
                            <select id="id_tip_doc" name="id_tip_doc" class="form-control selectpicker" data-live-search="true" required></select>
                           </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Nro.Doc(*):</label>
                            <input type="text" class="form-control" name="num_doc_trab" id="num_doc_trab"  required>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Funcion(*):</label>
                            <select id="id_funcion" name="id_funcion" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Area(*):</label>
                            <select id="id_area" name="id_area" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>

                           <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Tip.Planilla(*):</label>
                            <select id="id_tip_plan" name="id_tip_plan" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>

                            <!-- -->
                           <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Centro.Costos(*):</label>
                            <select id="id_cen_cost" name="id_cen_cost" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>

                           <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Tip.Mano Obra(*):</label>
                            <select id="id_tip_man_ob" name="id_tip_man_ob" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Sucursal(*):</label>
                            <select id="id_sucursal" name="id_sucursal" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>


                           <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Categoria Laboral(*):</label>
                            <select id="id_categoria" name="id_categoria" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>

                           <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Forma de Pago(*):</label>
                            <select id="id_form_pag" name="id_form_pag" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Tip.Contrato(*):</label>
                            <select id="id_tip_cont" name="id_tip_cont" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Est.Civil(*):</label>
                            <select id="id_est_civil" name="id_est_civil" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Regimen.Pensionario(*):</label>
                            <select id="id_reg_pen" name="id_reg_pen" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Comisión Actual(*):</label>
                            <select id="id_com_act" name="id_com_act" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Genero(*):</label>
                            <select id="id_genero" name="id_genero" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>


                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>T - Registro(*):</label>
                            <select id="id_t_registro" name="id_t_registro" class="form-control selectpicker" data-live-search="true" required></select>
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