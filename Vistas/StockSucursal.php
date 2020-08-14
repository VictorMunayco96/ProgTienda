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
                          <h1 class="box-title">Stocks por Sucursal
                            
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="ListadoRegistros">
                       
                  
                    
                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Sucursal</label>
                    <select id="Sucursal" name ="Sucursal" class="form-control selectpicker" required> 
                
                  
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>

                  
                
                    
                    
                    </select>
                  
                    </div>
                    <div class="form-group col-log-12 col-md-12 col-sm-12 col-xs-12">
                   
                    <button class="btn btn-success" onclick="ListarPorSucursal()">Mostrar</button>
                    </div>
                    
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