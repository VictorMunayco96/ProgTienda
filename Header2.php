<?php 

if(strlen(session_id())<1)

session_start();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LA CALERA</title>
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
    <link rel="shortcut icon" href="https://images.squarespace-cdn.com/content/v1/5d4c75052f957a000169e9fe/1565291925889-TA1LVIHVUXNXYQIG6YUF/ke17ZwdGBToddI8pDm48kHP-EVIlrjiNaxi7lPtCjh1Zw-zPPgdn4jUwVcJE1ZvWhcwhEtWJXoshNdA9f1qD7UnCxNA8dHvmd7460Z7fbKFbFapufuf3KvMkaY525fM3blhAjVv6POBWHrxoABZaPQ/favicon.ico">

  <link rel="stylesheet" type="text/css" href="../Public/datatables/jquery.dataTables.min.css">
  <link href="../Public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
  <link href="../Public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>


  <link rel="stylesheet" type="text/css" href="../Public/css/bootstrap-select.min.css">

  </head>
  <body class="hold-transition skin-green-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">C</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>LA CALERA</b></span>
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
                  <img src="../Public/dist/img/Logouser.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['Nombre'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../Public/dist/img/Logouser.jpg" class="img-circle" alt="User Image">
                    <p>
                    <?php echo 'USUARIO: '.$_SESSION['Usuario'];?>
                      <small><?php echo 'Nº SEMANA: '.$_SESSION['NumSemana'];?></small>
                      <small><?php echo 'SECTOR: '.$_SESSION['Sector'];?></small>
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
            <li class="header"></li>
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
            if($_SESSION['Almacen']==1){ 
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ProveClien.php"><i class="fa fa-circle-o"></i> Proveedor/Cliente</a></li>
               
              </ul>
            </li>';
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
                <li><a href="CategoriaProd.php"><i class="fa fa-circle-o"></i> Categoria </a></li>
                <li><a href="Producto.php"><i class="fa fa-circle-o"></i> Producto </a></li>
                <li><a href="DescProd.php"><i class="fa fa-circle-o"></i> Descripcion Producto </a></li>
              </ul>
            </li>';
            }
            ?>
                   

                   <?php 
            if($_SESSION['Transporte']==1){ 
              echo '<li class="treeview">
              <a href="#">
              <i class="fa fa-truck"></i>
                <span>Transporte</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ConductorVehiculo.php"><i class="fa fa-circle-o"></i> Conductor y Vehiculo</a></li>
                <li><a href="Conductor.php"><i class="fa fa-circle-o"></i> Conductor </a></li>
                <li><a href="Vehiculo.php"><i class="fa fa-circle-o"></i> Vehiculo </a></li>
               
                <li><a href="EmpreTrans.php"><i class="fa fa-circle-o"></i> Empresa Transportista </a></li>
              </ul>
            </li>';
            }
            ?>
                   




                   <?php 
            if($_SESSION['Destino']==1){ 
              echo '<li class="treeview">
              <a href="#">
              <i class="fa fa-map"></i>
                <span>Destino</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="TipoDestino.php"><i class="fa fa-circle-o"></i> Tipo Destino</a></li>
                <li><a href="Destino.php"><i class="fa fa-circle-o"></i> Destino </a></li>
                <li><a href="DestinoDesc.php"><i class="fa fa-circle-o"></i> Descripcion </a></li>
                <li><a href="DestinoBloq.php"><i class="fa fa-circle-o"></i> Bloque </a></li>
                <li><a href="Galpon.php"><i class="fa fa-circle-o"></i> Galpon </a></li>
              </ul>
            </li>';
            }
            ?>
                   


                   <?php 
            if($_SESSION['Personal']==1){ 
              echo '<li class="treeview">
              <a href="#">
              <i class="fa fa-users"></i>
                <span>Personal</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Empleado.php"><i class="fa fa-circle-o"></i> Empleado</a></li>
              
              </ul>
            </li>
';
            }
            ?>
                   

                   <?php 
            if($_SESSION['Pedido']==1){ 
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-list"></i>
                <span>Pedido</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="CabeceraPedido.php"><i class="fa fa-circle-o"></i> Cabecera Pedido</a></li>
                <li><a href="PedidoSemanal.php"><i class="fa fa-circle-o"></i> Pedido Semanal</a></li>
                <li><a href="Pedido.php"><i class="fa fa-circle-o"></i> Pedido</a></li>
                <li><a href="Variaciones.php"><i class="fa fa-circle-o"></i> Variaciones</a></li>
              </ul>
            </li>';
            }
            ?>
                   

                   <?php 
            if($_SESSION['Panel']==1){ 
              echo ' <li class="treeview">
              <a href="#">
              <i class="fa fa-laptop"></i>
                <span>Panel</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Panel.php"><i class="fa fa-circle-o"></i> Panel</a></li>
                <li><a href="EstadoPlanta.php"><i class="fa fa-circle-o"></i>Estado Planta</a></li>
              </ul>
            </li>         ';
            }
            ?>
                   
                   <?php 
            if($_SESSION['Acceso']==1){ 
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
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
            if($_SESSION['ConsulProd']==1){ 
              echo ' <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Produccion</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ConsulBalanza.php"><i class="fa fa-circle-o"></i> Consulta Balanza 2</a></li> 
                <li><a href="ConsultaBalanza1.php"><i class="fa fa-circle-o"></i> Consulta Balanza 1</a></li>               
              </ul>
            </li>';
            }
            ?>

<?php 
            if($_SESSION['ConsulProd2']==1){ 
              echo '<li class="treeview">
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
