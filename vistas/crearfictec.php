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
if ($_SESSION['udp']==1)
{
?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear Ficha Técnica
    
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
	<div class="row">

		<!-- FORMULARIO-->
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
			<div class="box box-success">
				<div class="box header with-border">
					
				</div>
				<div class="box-body">
					<form role="form" method="post">
						<div class="box">

							<!--=====================================
							=            ENTRADA DEL USUARIO            
							======================================-->

							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" class="form-control" id="nuevoUsuario" name="nuevoUsuario" value="Usuario Administrador" readonly>
								</div>
							</div>

							<!--=====================================
							=            ENTRADA DEL FICHA TECNICA            
							======================================-->

							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-code"></i></span>
									<input type="text" class="form-control" id="nuevaFicTec" name="nuevaFicTec" value="1001" readonly>
								</div>
							</div>


							<!--=====================================
							=            ENTRADA DEL MODELO            
							======================================-->

							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-puzzle-piece"></i></span>
									<select class="form-control" id="seleccionarModelo" name="seleccionarModelo" required>
										<option value="">Seleccionar Modelo</option>
									</select>
								</div>
							</div>							


						</div>
					</form>
				</div>
			</div>

		</div>
		
		<!-- TABLA MP-->
		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
			<div class="box box-warning">
				
			</div>			
		</div>
			

	</div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="scripts/fichastecnicas.js"></script>
<?php 
}
ob_end_flush();
?>