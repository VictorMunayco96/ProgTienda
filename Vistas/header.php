<?php 

if(strlen(session_id())<1)

session_start();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Calicel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../Public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../Public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../Public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../Public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../Public/img/Logo.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../Public/datatables/jquery.dataTables.min.css">    
    <link href="../Public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../Public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../Public/css/bootstrap-select.min.css">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>CALICEL</b></span>
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
                  <img src="../Public/dist/img/Logo.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['Nombre'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../Public/dist/img/Logo.png" class="img-circle" alt="User Image">
                    <p>
                    <?php echo 'Usuario: '.$_SESSION['Usuario'];?>
                      <small>Calicel - 2020</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="../Ajax/AUsuario.php?Op=Salir" class="btn btn-default btn-flat">Cerrar</a>
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
         
            <li class="header">NAVEGATION</li>
            <?php
            if($_SESSION['Escritorio']==1){ 
              echo '<li>
              <a href="Escritorio.php">
                <i class="fa fa-tasks"></i> <span>Escritorio</span>
              </a>
            </li>     ';
            }
            ?>          
                   <?php 
            if($_SESSION['Producto']==1){ 
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-leaf"></i>
                <span>Producto</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="TipoProducto.php"><i class="fa fa-circle-o"></i> Tipo Producto</a></li>
                <li><a href="Categoria.php"><i class="fa fa-circle-o"></i> Categoria</a></li>
                <li><a href="Producto.php"><i class="fa fa-circle-o"></i> Producto</a></li>
              </ul>
            </li>';
            }
            ?>



<?php 
            if($_SESSION['Almacen']==1){ 
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-cubes"></i>
                <span>Almacen General</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="IngresoTienda.php"><i class="fa fa-circle-o"></i> Almacen Distribucion</a></li>
                <li><a href="StockSucursal.php"><i class="fa fa-circle-o"></i> Almacen Por Sucursal</a></li>
               
              </ul>
            </li>';
            }
            ?>

<?php 
            if($_SESSION['AlmacenSucursal']==1){ 
              echo '<li class="treeview">
              <a href="#">
              <i class="fa fa-archive"></i>
                <span>Almacen Sucursal</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="StocksPorSucursal.php"><i class="fa fa-circle-o"></i> Almacen Stocks</a></li>
                <li><a href="TransferenciasPend.php"><i class="fa fa-circle-o"></i> Transferencias Por Aceptar</a></li>
               
              </ul>
            </li>';
            }
            ?>



<?php 
            if($_SESSION['Compras']==1){ 
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Compra.php"><i class="fa fa-circle-o"></i> Compras</a></li>
                <li><a href="Proveedor.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>
              </ul>
            </li>';
            }
            ?>



<?php 
            if($_SESSION['Ventas']==1){ 
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Venta.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
                <li><a href="Cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
              </ul>
            </li>  ';
            }
            ?>

<?php 
            if($_SESSION['DatosTienda']==1){ 
              echo '  
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-folder"></i> <span>Datos Generales</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="Tienda.php"><i class="fa fa-circle-o"></i> Tienda</a></li>       
                  <li><a href="Sucursal.php"><i class="fa fa-circle-o"></i> Sucursales</a></li>   
                  <li><a href="Personal.php"><i class="fa fa-circle-o"></i> Personal</a></li>           
                </ul>
              </li>';
            }
            ?>


<?php 
            if($_SESSION['Acceso']==1){ 
              echo '    <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="Permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>
                
              </ul>
            </li>';
            }
            ?>

<?php 
            if($_SESSION['ConsulCompras']==1){ 
              echo '    <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Compras</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="consultacompras.php"><i class="fa fa-circle-o"></i> Consulta Compras</a></li>                
              </ul>
            </li>';
            }
            ?>

<?php 
            if($_SESSION['ConsulVentas']==1){ 
              echo '  
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-bar-chart"></i> <span>Consulta Ventas</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="consultaventas.php"><i class="fa fa-circle-o"></i> Consulta Ventas</a></li>                
                </ul>
              </li>';
            }
            ?>



            
            
            
                               
        
            <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
