<?php

ob_start();
session_start();

if(!isset($_SESSION["IdUsuario"])){

  header("LOCATION: Login.php");

}else{


require 'Header.php';

if($_SESSION["Almacen"]==1){
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
                          <h1 class="box-title">Almacen Distribucion
                             <button class="btn btn-danger" onclick="MostrarForm(1)"><i class="fa fa-arrow-circle-left"></i> Volver</button></h1>

                        <div class="box-tools pull-right">
                        </div>
                    </div>
                 <!--    /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="ListadoCabecera">
                        <table id="tbllistadoC" class="table table-striped table-bordered table-condensed table-hover" >

                        <thead>

                        <th>Opciones</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Min por Tienda</th>
                        <th>Min por Almacen General</th>
                        <th>Stock</th>
                        <th>Estado Stock</th>
                        <th>Estado</th>

                        </thead>

                        <tbody>
                        
</tbody>
                      <tfoot>

                      <th>Opciones</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Min por Tienda</th>
                        <th>Min por Almacen General</th>
                        <th>Stock</th>
                        <th>Estado Stock</th>
                        <th>Estado</th>

                    </tfoot>
                      
                       



                        </table>
                    </div>

                    <div class="panel-body table-responsive" id="ListadoPedidoSemanal">
                        <table id="tbllistadoPS" class="table table-striped table-bordered table-condensed table-hover" >

                        <thead>

                        <th>Opciones</th>
                      
                        <th>nombre</th>
                      
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>Precio Compra</th>
                        <th>Codigo Barra</th>
                        <th>Distribuido</th>
                        <th>Estado</th>
                    
                        </thead>

                        <tbody>
                        
</tbody>
                      <tfoot>

                      <th>Opciones</th>
                      
                      <th>nombre</th>
                    
                      <th>Descripcion</th>
                      <th>Cantidad</th>
                      <th>Precio Compra</th>
                      <th>Codigo Barra</th>
                      <th>Distribuido</th>
                      <th>Estado</th>
                   

                    </tfoot>
                      
                       



                        </table>
                    </div>





                    <div class="panel-body table-responsive" id="ListadoPedido">
         <table id="tbllistadoPE" class="table table-striped table-bordered table-condensed table-hover" >

            <thead>

                        <th>Opciones</th>
                        <?php if($_SESSION['TipoUsuario']=='ADMINISTRADOR'){echo '<th>Aprobar/Cancelar</th>';}?>
                        <th>Producto</th>
                        <th>Descripcion</th>
                         <th>Cantidad Enviada</th>
                        <th>Sucursal</th>
                        <th>Precio por Menor</th>
                        <th>Precio por Mayor</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Estado Envio</th>
                        <th>Estado</th>
                       
                        
              
                       

                        </thead>

                        <tbody>
                        
</tbody>
                      <tfoot>

                      <th>Opciones</th>
                      <?php if($_SESSION['TipoUsuario']=='ADMINISTRADOR'){echo '<th>Aprobar/Cancelar</th>';}?>
                      <th>Producto</th>
                        <th>Descripcion</th>
                         <th>Cantidad Enviada</th>
                        <th>Sucursal</th>
                        <th>Precio por Menor</th>
                        <th>Precio por Mayor</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Estado Envio</th>
                        <th>Estado</th>
                       
                        
                    </tfoot>
                      
                       



                        </table>
                    </div>






                    <div class="panel-body" style="height: 400px;" id="FormularioRegistros">
                    
                    <form name="Formulario" id="Formulario" method="POST">

                                        
                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Cantidad:</label>
                    <input type="number" name="Cantidad" class="form-control" id="Cantidad" placeholder="Cantidad" required>
                    </div>





                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Sucursal:</label>
                    <select id="IdSucursal" name ="IdSucursal" class="form-control selectpicker"> 
                    
                    
                    </select>
                    </div>

                    
                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Precio Venta Por Mayor:</label>
                    <input type="hidden" name="IdIngresoTienda" id="IdIngresoTienda">
                    <input type="hidden" name="IdDetalleCompra" id="IdDetalleCompra">
                    <input type="number" class="form-control" placeholder="Precio por Mayor" name="PrecioVentaXMayor" id="PrecioVentaXMayor"  required>
                    </div>





                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Precio Venta Por Menor:</label>
                    <input type="number" class="form-control" placeholder="Precio por Menor" name="PrecioVentaXMenor" id="PrecioVentaXMenor"  required>
                    </div>






                  

                    

                  

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <button class="btn btn-primary" type="submit" name="BtnGuardar" id="BtnGuardar" ><i class="fa fa-save"></i> Guardar</button>


                      <button class="btn btn-danger" onclick="CancelarForm()" type="button"><i class="fa fa-arrow-circle-left"></i>
                    Cancelar</button>


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
else{

require 'NoAcceso.php';

}
require 'Footer.php';
?>

<script type="text/javascript" src="Scripts/IngresoTienda.js"></script>

<?php 

}
ob_end_flush();
?>