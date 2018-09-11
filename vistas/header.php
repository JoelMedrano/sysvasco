<?php
if (strlen(session_id()) < 1)
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Corp Vasco SAC</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/icono.png">
    <link rel="shortcut icon" href="../public/img/icono.png">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">

    <!--=====================================
    PLUGINS DE CSS
    ======================================-->

    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">

    <!-- SweetAlert 2 -->
    <script src="plugins/sweetalert2/sweetalert2.all.js"></script>
       <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>


      <!-- Daterange picker -->
     <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">

     <!-- Morris chart -->
     <link rel="stylesheet" href="bower_components/morris.js/morris.css">

  </head>
  <body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>JF</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>VASCO</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">
                    <p>
                      www.jackyform.com.pe   Desarrollando Software
                      <small>Diana Godos - Joel Medrano</small>
                    </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">

                    <div class="pull-right">
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            <?php
            if ($_SESSION['escritorio']==1)
            {
              echo '<li>
              <a href="escritorio.php">
                <i class="fa fa-tasks"></i> <span>Escritorio</span>
              </a>
            </li>';
            }
            ?>
            <?php
            if ($_SESSION['almacen']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="articulo.php"><i class="fa fa-circle-o"></i> Artículos</a></li>
                <li><a href="categoria.php"><i class="fa fa-circle-o"></i> Categorías</a></li>
              </ul>
            </li>';
            }
            ?>

            <?php
            if ($_SESSION['compras']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ingreso.php"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                <li><a href="proveedor.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>
              </ul>
            </li>';
            }
            ?>

            <?php
            if ($_SESSION['ventas']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="venta.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
                <li><a href="cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
              </ul>
            </li>';
            }
            ?>

            <?php
            if ($_SESSION['acceso']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>

              </ul>
            </li>';
            }
            ?>

            <?php
            if ($_SESSION['consultac']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Compras</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="comprasfecha.php"><i class="fa fa-circle-o"></i> Consulta Compras</a></li>
              </ul>
            </li>';
            }
            ?>

             <?php
            if ($_SESSION['consultav']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ventasfechacliente.php"><i class="fa fa-circle-o"></i> Consulta Ventas</a></li>
              </ul>
            </li>';
            }
            ?>

             <?php
            if ($_SESSION['rrhh']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-heartbeat"></i> <span>Recursos Humanos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Maestros</a></li>
                <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Registro</a></li>
                <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Control</a></li>
                <li><a href="vacaciones.php"><i class="fa fa-circle-o"></i> Vacaciones</a></li>
                <li><a href="trabajador.php"><i class="fa fa-circle-o"></i> Trabajador</a></li>
                <li><a href="refrigerio.php"><i class="fa fa-circle-o"></i> Refrigerio</a></li>
              </ul>
            </li>';
            }
            ?>

             <?php
            if ($_SESSION['reloj']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-hourglass-o"></i> <span>Reloj</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="reloj.php"><i class="fa fa-circle-o"></i> Reloj</a></li>
                <li><a href="reporte_diario_asistencia.php"><i class="fa fa-circle-o"></i> Reporte Diario Asistencia</a></li>
                <li><a href="reporte_mensual_asistencia.php"><i class="fa fa-circle-o"></i> Reporte Mensual Asistencia</a></li>
              </ul>
            </li>';
            }
            ?>

            <?php
            if ($_SESSION['calendarios']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-calendar"></i> <span>Calendario</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="permiso_personal.php"><i class="fa fa-circle-o"></i> Permisos</a></li>


              </ul>
            </li>';
            }
            ?>



            <?php
            if ($_SESSION['udp']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-scissors"></i> <span>U D P</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="marca.php"><i class="fa fa-circle-o"></i> Marcas</a></li>
                <li><a href="modelo.php"><i class="fa fa-circle-o"></i> Modelos</a></li>
                <li><a href="cotizacion.php"><i class="fa fa-circle-o"></i> Cotizacion</a></li>
                <li><a href="detalle_cotizacion.php"><i class="fa fa-circle-o"></i> Editar Cotizacion</a></li>

              </ul>
            </li>';
            }
            ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
