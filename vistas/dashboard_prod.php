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

  ////////////////////////////////////////////////////////////////

    require_once "../modelos/Produccion.php";

    $produccion = new Produccion();

    //Datos para mostrar el gráfico de barras de la produccion del mes
    $prod = $produccion->prodMes();
    $fechasp='';
    $totalesp='';
        while ($regfechap= $prod->fetch_object()) {
        $fechasp=$fechasp.'"'.$regfechap->dia .'",';
        $totalesp=$totalesp.$regfechap->suma .',';
        }

    //Quitamos la última coma
    $fechasp=substr($fechasp, 0, -1);
    $totalesp=substr($totalesp, 0, -1);

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
                                <h1 class="box-title">PRODUCCION - E20  <a href="produccion.php" class="btn btn-success" role="button">Nuevo Ingreso</a></h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->
                            <div class="panel-body table-responsive" id="listadoregistros">

                            <div class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-12">

                                <label>Rango de Búsqueda</label>

                                <div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                    <label>Fecha Inicio</label>
                                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php $d=strtotime("first day of this month"); echo date("Y-m-d",$d); ?>">
                                </div>
                                <div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                    <label>Fecha Fin</label>
                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                            </div>

                            <div class="form-group col-lg-10 col-md-6 col-sm-6 col-xs-12">
                                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <th>Cod. Movimiento</th>
                                        <th>Documento</th>
                                        <th>Fecha Emisión</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <th>Cod. Movimiento</th>
                                        <th>Documento</th>
                                        <th>Fecha Emisión</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                    </tfoot>
                                </table>

                            </div>
                            
                            <!--Grafico--> 

                            <div class="panel-body" id="grafico">

                                <div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            Produccion del mes
                                        </div>
                                        <div class="box-body">
                                            <canvas id="produccion" width="1200" height="300"></canvas>
                                        </div>
                                    </div>
                                </div>



                                                               

                            </div>
                            <div class="panel-body" style="height: 400px;" id="formularioregistros">
                                <form name="formulario" id="formulario" method="POST">
                                    <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <label>Cliente(*):</label>
                                        <input type="hidden" name="idventa" id="idventa">
                                        <select id="idcliente" name="idcliente" class="form-control selectpicker"
                                            data-live-search="true" required>

                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Fecha(*):</label>
                                        <input type="date" class="form-control" name="fecha_hora" id="fecha_hora">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Tipo Comprobante(*):</label>
                                        <select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker"
                                            required="">
                                            <option value="Boleta">Boleta</option>
                                            <option value="Factura">Factura</option>
                                            <option value="Ticket">Ticket</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <label>Serie:</label>
                                        <input type="text" class="form-control" name="serie_comprobante" id="serie_comprobante"
                                            maxlength="7" placeholder="Serie">
                                    </div>
                                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <label>Número:</label>
                                        <input type="text" class="form-control" name="num_comprobante" id="num_comprobante"
                                            maxlength="10" placeholder="Número" required="">
                                    </div>
                                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <label>Impuesto:</label>
                                        <input type="text" class="form-control" name="impuesto" id="impuesto" required="">
                                    </div>
                                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a data-toggle="modal" href="#myModal">
                                            <button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span>
                                                Agregar Artículos</button>
                                        </a>
                                    </div>

                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                            <thead style="background-color:#A9D0F5">
                                                <th>Opciones</th>
                                                <th>Artículo</th>
                                                <th>Cantidad</th>
                                                <th>Precio Venta</th>
                                                <th>Descuento</th>
                                                <th>Subtotal</th>
                                            </thead>
                                            <tfoot>
                                                <th>TOTAL</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <h4 id="total">S/. 0.00</h4><input type="hidden" name="total_venta" id="total_venta">
                                                </th>
                                            </tfoot>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>
                                            Guardar</button>

                                        <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i
                                                class="fa fa-arrow-circle-left"></i> Cancelar</button>
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

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width: 65% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione un Artículo</h4>
        </div>
        <div class="modal-body">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Código</th>
                <th>Stock</th>
                <th>Precio Venta</th>
                <th>Imagen</th>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <th>Opciones</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Código</th>
                <th>Stock</th>
                <th>Precio Venta</th>
                <th>Imagen</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin modal -->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/dashboard_prod.js"></script>

<script src="../public/js/chart.min.js"></script>
<script src="../public/js/Chart.bundle.min.js"></script>

<script type="text/javascript">
var ctx = document.getElementById("produccion").getContext('2d');
var produccion = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechasp; ?>],
        datasets: [{
            label: 'produccion en S/ de los últimos 10 días',
            data: [<?php echo $totalesp; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>

<?php
}
ob_end_flush();
?>
