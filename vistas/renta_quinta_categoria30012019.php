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
                          <h1 class="box-title">Renta Quinta Categoria<button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>RQ</th>
                            <th>Año</th>
                            <th>Fecha de Pago</th>
                            <th>Ver</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>RQ</th>
                            <th>Año</th>
                            <th>Fecha de Pago</th>
                            <th>Ver</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">



                           <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Año:</label>
                            <input type="text" readonly class="form-control" name="Ano" id="Ano" autocomplete="off">
                            <input type="hidden"  class="form-control" name="id_cp" id="id_cp" >
                            <input type="hidden"  class="form-control" name="CantItems" id="CantItems">
                          </div>

                      
                           <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Fecha de Pago:</label>
                            <input type="text" readonly class="form-control" name="Descrip_fec_pag" id="Descrip_fec_pag"  autocomplete="off">
                          </div>

                        
                          <br>


                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"  align="right">
                            <a data-toggle="modal" href="#myModal">
                              <button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Agregar Trabajador</button>
                            </a>
                          </div>


                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                    <th>Item</th>
                                    <th>Trabajador</th>
                                    <th>Sueldo</th>
                                    <th>Bono Destajo</th>
                                    <th>Produccion(S/.)</th>
                                    <th>Diferencia</th>
                                    <th>Opciones</th>
                                </thead>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Opciones</th>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
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
<script type="text/javascript" src="scripts/renta_quinta_categoria.js"></script>
<?php 
}
ob_end_flush();
?>