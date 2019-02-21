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

    require_once "../modelos/Devolucion.php";

    $devolucion = new Devolucion();

    //Datos para mostrar el gráfico de barras de la devolucion del mes
    $dev = $devolucion->devMes();
    $fechasd='';
    $totalesd='';
        while ($regfechap= $dev->fetch_object()) {
        $fechasd=$fechasd.'"'.$regfechap->dia .'",';
        $totalesd=$totalesd.$regfechap->suma .',';
        }

    //Quitamos la última coma
    $fechasd=substr($fechasd, 0, -1);
    $totalesd=substr($totalesd, 0, -1);

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
                                <h1 class="box-title">Facturación - S03  <a href="produccion.php" class="btn btn-success" role="button">Nuevo Ingreso</a></h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->

                            <!-- RANGO DE HORAS -->
                            <div class="panel-body table-responsive" id="listadoregistros">

                                <!-- RANGO DE HORAS -->
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
                                <!-- RANGO DE HORAS -->

                                <!-- TABLA DE LISTADO -->

                                <div class="form-group col-lg-10 col-md-6 col-sm-6 col-xs-12">
                                    <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                        <thead>
                                            <th>Cod_Mov</th>
                                            <th>Documento</th>
                                            <th>Codigo</th>
                                            <th>Cliente</th>
                                            <th>Fecha Emisión</th>
                                            <th>Almacen</th>
                                            <th>Total</th>
                                            <th>Responsable</th>
                                            <th>Estado</th>
                                            <th>Aprobar</th>
                                            <th>Detalles</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <th>Cod_Mov</th>
                                            <th>Documento</th>
                                            <th>Codigo</th>
                                            <th>Cliente</th>
                                            <th>Fecha Emisión</th>
                                            <th>Almacen</th>
                                            <th>Total</th>
                                            <th>Responsable</th>
                                            <th>Estado</th>
                                            <th>Aprobar</th>
                                            <th>Detalles</th>
                                        </tfoot>
                                    </table>

                                </div>
                                </div><!-- /.box -->
                                <!-- TABLA DE LISTADO -->

                                <!--Grafico-->

                                <div class="panel-body" id="grafico">

                                    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
                                        <div class="box box-primary">
                                            <div class="box-header with-border">
                                                Devolucion del mes
                                            </div>
                                            <div class="box-body">
                                                <canvas id="devolucion" width="1200" height="300"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!--Grafico-->

                                <!--Detalle Movimientos-->

                                <div class="panel-body" id="formularioDetalle">
                                    <form name="formulario" id="formulario" method="POST">

                                        <div class="form-group col-lg-1 col-md-4 col-sm-4 col-xs-12">
                                            <label>Movimiento:</label>
                                            <b><input type="text" class="form-control" name="cod_mov" id="cod_mov" readonly></b>
                                        </div>

                                        <div class="form-group col-lg-1 col-md-4 col-sm-4 col-xs-12">
                                            <label>Documento:</label>
                                            <b><input type="text" class="form-control" name="num_mov" id="num_mov" readonly></b>
                                        </div>

                                        <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                            <label>Código:</label>
                                            <input type="text" class="form-control" name="cod_cli" id="cod_cli" readonly>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Cliente:</label>
                                            <input type="text" class="form-control" name="nom_cli" id="nom_cli" readonly>
                                        </div>

                                        <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                            <label>Vendedor:</label>
                                            <input type="text" class="form-control" name="nom_ven" id="nom_ven" readonly>
                                        </div>

                                        <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                            <label>Fecha:</label>
                                            <input type="date" class="form-control" name="fecha" id="fecha" readonly>
                                        </div>

                                        <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                            <label>Cantidad total:</label>
                                            <input type="text" class="form-control" name="cantidad" id="cantidad" readonly>
                                        </div>

                                        <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                            <label>Cantidad Primeras:</label>
                                            <input type="text" class="form-control" name="cant_primera" id="cant_primera" readonly>
                                        </div>

                                        <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                            <label>Cantidad Segundas:</label>
                                            <input type="text" class="form-control" name="cant_segunda" id="cant_segunda" readonly>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                            <label>Responsable</label>
                                            <input type="text" class="form-control" name="nom_ing" id="nom_ing" readonly>
                                        </div>

                                        <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                            <label>Aprobador Por</label>
                                            <input type="text" class="form-control" name="nom_apro" id="nom_apro" readonly>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-4 col-sm-4 col-xs-12">
                                        <hr>
                                        </div>

                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                                            </table>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>
                                                Guardar</button>

                                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>
                                                Cancelar</button>
                                        </div>
                                    </form>
                                </div>

                                <!--Detalle Movimientos-->

                                <!--Fin centro -->
                            
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
<script type="text/javascript" src="scripts/dash_fact.js"></script>

<script src="../public/js/chart.min.js"></script>
<script src="../public/js/Chart.bundle.min.js"></script>

<script type="text/javascript">
var ctx = document.getElementById("devolucion").getContext('2d');
var devolucion = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechasd; ?>],
        datasets: [{
            label: 'Devolucion en unidades de los últimos 10 días',
            data: [<?php echo $totalesd; ?>],
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
