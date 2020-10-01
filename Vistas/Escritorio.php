<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["IdUsuario"]))
{
  header("Location: Login.php");
}
else
{
require 'Header.php';

if ($_SESSION['Escritorio']==1)
{
 /*  require_once "../modelos/Consultas.php";
  $consulta = new Consultas();
  $rsptac = $consulta->totalcomprahoy();
  $regc=$rsptac->fetch_object();
  $totalc=$regc->total_compra;

  $rsptav = $consulta->totalventahoy();
  $regv=$rsptav->fetch_object();
  $totalv=$regv->total_venta;

  //Datos para mostrar el gráfico de barras de las compras
  $compras10 = $consulta->comprasultimos_10dias();
  $fechasc='';
  $totalesc='';
  while ($regfechac= $compras10->fetch_object()) {
    $fechasc=$fechasc.'"'.$regfechac->fecha .'",';
    $totalesc=$totalesc.$regfechac->total .','; 
  }

  //Quitamos la última coma
  $fechasc=substr($fechasc, 0, -1);
  $totalesc=substr($totalesc, 0, -1);

   //Datos para mostrar el gráfico de barras de las ventas
  $ventas12 = $consulta->ventasultimos_12meses();
  $fechasv='';
  $totalesv='';
  while ($regfechav= $ventas12->fetch_object()) {
    $fechasv=$fechasv.'"'.$regfechav->fecha .'",';
    $totalesv=$totalesv.$regfechav->total .','; 
  }

  //Quitamos la última coma
  $fechasv=substr($fechasv, 0, -1);
  $totalesv=substr($totalesv, 0, -1);
 */
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
                          <h1 class="box-title">Escritorio </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body">

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                          <div class="small-box bg-aqua">
                              <div class="inner">
                                <h4 style="font-size:17px;">
                                  <strong>S/ <?php echo '23456'; ?></strong>
                                </h4>
                                <p>Compras</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-bag"></i>
                              </div>
                              <a href="ingreso.php" class="small-box-footer">Compras <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                          <div class="small-box bg-orange">
                              <div class="inner">
                                <h4 style="font-size:17px;">
                                  <strong>S/ <?php echo '23456'; ?></strong>
                                </h4>
                                <p>Sucursal 1</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-bag"></i>
                              </div>
                              <a href="ingreso.php" class="small-box-footer">Sucursal 1<i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>





                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

                        <div class="info-box">
                        
                        <span class="info-box-icon bg-blue elevation-1"><i class="fa fa-user"></i></span>
                        
                        <div class="info-box-content">
              <span class="info-box-text">Total Clientes</span>
              <span class="info-box-number">
              2.00
              </span>
            </div>
                        
                        </div>
                        </div>

                        





                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>0.00</h3>

          <p>Total Ventas Anuladas</p>
        </div>
        <div class="icon">
          <i class="fa fa-user"></i>
        </div>
        <a href="ingreso.php" class="small-box-footer">Sucursal 1<i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    













                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                          <div class="small-box bg-green">
                              <div class="inner">
                                <h4 style="font-size:17px;">
                                  <strong>S/ <?php echo '23456'; ?></strong>
                                </h4>
                                <p>Ventas</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-bag"></i>
                              </div>
                              <a href="venta.php" class="small-box-footer">Ventas <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                          <div class="small-box bg-black">
                              <div class="inner">
                                <h4 style="font-size:17px;">
                                  <strong>S/ <?php echo '23456'; ?></strong>
                                </h4>
                                <p>Ventas</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-bag"></i>
                              </div>
                              <a href="venta.php" class="small-box-footer">Ventas <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    </div>

                 


                    <div class="panel-body">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="box box-primary">
                              <div class="box-header with-border">
                                Ventas de los últimos 12 meses
                              </div>
                              <div class="box-body">
                                <canvas id="ventas" width="400" height="100"></canvas>
                              </div>
                          </div>
                        </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                          <div class="box box-primary">
                              <div class="box-header with-border">
                                Compras de los últimos 10 días
                              </div>
                              <div class="box-body">
                              <canvas id="compras" width="400" height="200"></canvas>
                              </div>
                          </div>
                        </div>

             

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                          <div class="box box-primary">
                              <div class="box-header with-border">
                                Resumen de Ventas por Tienda
                              </div>
                              <div class="box-body">
                                <canvas id="resumenventas" width="400" height="400"></canvas>
                              </div>
                          </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                          <div class="box box-primary">
                              <div class="box-header with-border">
                                Resumen de Ventas por Tienda
                              </div>
                              <div class="box-body">
                                <canvas id="resv" width="400" height="200"></canvas>
                              </div>
                          </div>
                        </div>

                        <div class="row">
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="box">
          <div class="card-header border-0">
            <h3 class="card-title"><i class="fa fa-barcode"></i> Ranking de productos</h3>
            <div class="card-tools">
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
              <thead>
              <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Monto</th>
              </tr>
              </thead>
              <tbody> 
                <tr><td>ALVERJAS SIN PELAR</td><td>4</td><td>12</td><td>S/48.00</td></tr><tr><td>APIO</td><td>1.5</td><td>10</td><td>S/15.00</td></tr><tr><td>PAPA HUAYRO</td><td>3</td><td>4</td><td>S/12.00</td></tr><tr><td>ALBAHACA</td><td>1</td><td>2</td><td>S/2.00</td></tr><tr><td>PAPA BLANCA</td><td>2</td><td>1</td><td>S/2.00</td></tr>              <!--<tr>
                <td>Some Product</td>
                <td>S/13.00</td>
                <td>100</td>
                <td>S/1,300.00</td>
              </tr>
              <tr>
                <td>Another Product</td>
                <td>S/29.00</td>
                <td>
                    234</td>
                <td>S/2,000.00</td>
              </tr>
              <tr>
                <td>Amazing Product</td>
                <td>S/23.00</td>
                <td>198</td>
                <td>S/500.00</td>
              </tr>
              <tr>
                <td>Amazing Product</td>
                <td>S/23.00</td>
                <td>198</td>
                <td>S/500.00</td>
              </tr>
              <tr>
                <td>Another Product</td>
                <td>S/29.00</td>
                <td>234</td>
                <td>S/2,000.00</td>
              </tr>-->
              </tbody>
            </table>
          </div>
        </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="box">
          <div class="card-header border-0">
            <h3 class="card-title"><i class="fas fa-th-large"></i> Ranking de categorias</h3>
            <div class="card-tools">
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
              <thead>
              <tr>
                <th>Nombre</th>
                <th>Monto</th>
              </tr>
              </thead>
              <tbody>
                <tr><td>VERDURAS Y FRUTAS</td><td>S/79.00</td></tr>              </tbody>
            </table>
          </div>
        </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="box">
          <div class="card-header border-0">
            <h3 class="card-title"><i class="fas fa-user-friends"></i> Ranking de clientes</h3>
            <div class="card-tools">
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
              <thead>
              <tr>
                <th>Nombre</th>
                <th>Monto</th>
              </tr>
              </thead>
              <tbody>
                <tr><td>----</td><td>S/69.00</td></tr><tr><td>MARIA ELENA ROMERO  AGUILAR</td><td>S/5.00</td></tr><tr><td>CLIENTE VARIOS</td><td>S/5.00</td></tr>              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
      


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
  require 'NoAcceso.php';
}

require 'Footer.php';
?>

<script src="../Public/js/Chart.min.js"></script>
<script src="../Public/js/Chart.bundle.min.js"></script> 
<script type="text/javascript">
var ctx = document.getElementById('compras').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var ctx = document.getElementById('ventas').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [{
            label: '# of Votes',
            data: [56478,4566,4878,45148,45812,74845],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var ctx = document.getElementById("resumenventas");
var myChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ['OK', 'WARNING', 'CRITICAL', 'UNKNOWN'],
    datasets: [{
      label: '# of Tomatoes',
      data: [12, 19, 3, 5],
      backgroundColor: [
        'rgba(255,99,132,1)',
        'rgba(255, 240, 125, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(255, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
   	//cutoutPercentage: 40,
    responsive: false,

  }
});


var ctx = document.getElementById('resv').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [{
            label: '# of Votes',
            data: [56478,4566,4878,45148,45812,74845],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
        

        
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
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
