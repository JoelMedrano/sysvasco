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
                          <h1 class="box-title">DETALLE DE FACTURAS </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Tipo</th>
                            <th>Documento</th>
                            <th>Fecha</th>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Peso del Pedido</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <th>Tipo</th>
                            <th>Documento</th>
                            <th>Fecha</th>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Peso del Pedido</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xs-12">
                            <label>Documento(*):</label>
                            <input type="text" class="form-control" name="documento" id="documento">
                          </div>

                          <div class="form-group col-lg-1 col-md-2 col-sm-3 col-xs-12">
                            <label>Cod. Cliente:</label>
                            <input type="text" class="form-control" name="cliente" id="cliente">
                          </div>

                          <div class="form-group col-lg-4 col-md-8 col-sm-6 col-xs-12">
                            <label>Cliente:</label>
                            <input type="text" class="form-control" name="nom_cliente" id="nom_cliente">
                          </div>

                          <div class="form-group col-lg-1 col-md-2 col-sm-3 col-xs-12">
                            <label>Cod Vendedor:</label>
                            <input type="text" class="form-control" name="vendedor" id="vendedor">
                          </div>

                          <div class="form-group col-lg-1 col-md-2 col-sm-3 col-xs-12">
                            <label>Total Unidades:</label>
                            <input type="text" class="form-control" name="und" id="und">
                          </div>

                          <div class="form-group col-lg-1 col-md-2 col-sm-3 col-xs-12">
                            <label>Total Soles:</label>
                            <input type="text" class="form-control" name="soles" id="soles">
                          </div>

                          <div class="form-group col-lg-2 col-md-6 col-sm-3 col-xs-12">
                            <label>Fecha(*):</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" >
                          </div>

                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover cell-border">
                              <thead style="background-color:#A9D0F5">

                                <tr>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th>S</th>
                                  <th>M</th>
                                  <th>L</th>
                                  <th>XL</th>
                                  <th>XXL</th>
                                  <th>XS</th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                </tr>

                                <tr>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th>28</th>
                                  <th>30</th>
                                  <th>32</th>
                                  <th>34</th>
                                  <th>36</th>
                                  <th>38</th>
                                  <th>40</th>
                                  <th>42</th>
                                  <th></th>
                                </tr>

                                <tr>
                                  <th>Opciones</th>
                                  <th>Modelo</th>
                                  <th>Color</th>
                                  <th>3</th>
                                  <th>4</th>
                                  <th>6</th>
                                  <th>8</th>
                                  <th>10</th>
                                  <th>12</th>
                                  <th>14</th>
                                  <th>16</th>
                                  <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">S/. 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
                                </tfoot>
                                <tbody>

                                </tbody>
                            </table>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
<script type="text/javascript" src="scripts/movs_facturas.js"></script>
<?php
}
ob_end_flush();
?>
