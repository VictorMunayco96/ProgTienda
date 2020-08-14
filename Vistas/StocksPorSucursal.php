<?php


ob_start();
session_start();

if(!isset($_SESSION["IdUsuario"])){

  header("LOCATION: Login.php");

}else{

require 'Header.php';

if($_SESSION["AlmacenSucursal"]==1){
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
                          <h1 class="box-title">Stock Almacen
                            <button class="btn btn-success" onclick="MostrarForm(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="ListadoRegistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" >

                        <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                   
                        <th>Stock</th>
                        <th>Estado</th>
                     
                      

                        </thead>

                        <tbody>
                        
</tbody>
                      <tfoot>
                      <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                   
                        <th>Stock</th>
                        <th>Estado</th>
                     
                      


                    </tfoot>
                      
                       



                        </table>
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
else{

require 'NoAcceso.php';

}

require 'Footer.php';
?>

<script type="text/javascript" src="Scripts/StocksPorSucursal.js"></script>

<?php 

}
ob_end_flush();
?>