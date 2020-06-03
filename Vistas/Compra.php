<?php


ob_start();
session_start();

if(!isset($_SESSION["IdUsuario"])){

  header("LOCATION: Login.php");

}else{

require 'Header.php';

if($_SESSION["Compras"]==1){
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
                          <h1 class="box-title">Compra
                            <button class="btn btn-success" onclick="MostrarForm(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="ListadoRegistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover" >

                        <thead>

                        <th>Opciones</th>
                        <th>Razon Social</th>
                        <th>Tipo Comprobante</th>
                        <th>N° Comprobante</th>
                        <th>Asunto</th>
                        <th>Descripcion</th>
                        <th>Impuesto</th>
                        <th>Total Compra</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Estado</th>

                        </thead>

                        <tbody>
                        
</tbody>
                      <tfoot>

                  
                      <th>Opciones</th>
                        <th>Razon Social</th>
                        <th>Tipo Comprobante</th>
                        <th>N° Comprobante</th>
                        <th>Asunto</th>
                        <th>Descripcion</th>
                        <th>Impuesto</th>
                        <th>Total Compra</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Estado</th>



                    </tfoot>
                      
                       



                        </table>
                    </div>

                    <div class="panel-body" style="height: 700px;" id="FormularioRegistros">
                    
                    <form name="Formulario" id="Formulario" method="POST">

               


                    <div class="form-group col-log-8 col-md-8 col-sm-12 col-xs-12">
                    <label>Proveedor:</label>
                    <select id="IdProveedor" name ="IdProveedor" class="form-control selectpicker" data-live-search="true"> </select>
                    </div>

                    <div class="form-group col-log-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Fecha:</label>
                    <input type="date" class="form-control"  name="FecNac" id="FecNac" required>
                    </div>

                    <div class="form-group col-log-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Tipo Comprobante:</label>
                    <select id="TipoComprobante" name ="TipoComprobante" class="form-control selectpicker" data-live-search="true"> 
                    <option value="BOLETA">BOLETA</option>
                    <option value="FACTURA">FACTURA</option>
                    <option value="TICKET">TICKET</option>
                    
                    </select>
                    </div>

                    <div class="form-group col-log-3 col-md-3 col-sm-6 col-xs-6">
                    <label>Serie:</label>
                    <input type="hidden" name="IdCompra" id="IdCompra">
                    <input type="text" class="form-control" placeholder="Serie" name="SerieCompro" id="SerieCompro" required>
                    </div>

                    <div class="form-group col-log-5 col-md-5 col-sm-6 col-xs-6">
                    <label>Numero:</label>
                    <input type="number" class="form-control" placeholder="Numero" name="NumCompro" id="NumCompro" required>
                    </div>


                    <div class="form-group col-log-4 col-md-4 col-sm-6 col-xs-6">
                    <label>Asunto:</label>
                    <input type="text" class="form-control" placeholder="Asunto" name="Asunto" id="Asunto" required>
                    </div>

                    <div class="form-group col-log-4 col-md-4 col-sm-6 col-xs-6">
                    <label>Descripcion:</label>
                    <input type="text" class="form-control" placeholder="Descripcion" name="Descripcion" id="Descripcion" required>
                    </div>

                    <div class="form-group col-log-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Impuesto:</label>
                    <input type="text" class="form-control" placeholder="Impuesto" name="Impuesto" id="Impuesto" required>
                    </div>



                    <div class="form-group col-log-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <a data-toggle="modal" href="#myModal">

                    <button id="btnAgregarArt" type="button" class="btn btn-primary" ><span class="fa fa-plus"></span>
                    Agregar Articulo</button>



                    </a>

                    </div>


                    <div class="form-group col-log-12 col-md-12 col-sm-12 col-xs-12">


                    <table id="Detalles" class="table table-striped table-bordered table-condensed table-hover" >

<thead style="background-color:#A9D0F5">

<th>Opciones</th>
<th>Articulo</th>
<th>Cantidad</th>
<th>Precio Compra</th>
<th>Codigo</th>
<th>Subtotal</th>

</thead>

<tbody>
</tbody>
<tfood>


<th>TOTAL</th>
<th></th>
<th></th>
<th></th>
<th></th>

<th><h4 id="Total">S/. 0.00</h4><input type="hidden" name="TotalCompra" id="TotalCompra"></th>

</tfood>

<tbody>
</tbody>




                    </table>


               
                    </div>

                  

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="Guardar">
                      <button class="btn btn-primary" type="submit" name="BtnGuardar" id="BtnGuardar" ><i class="fa fa-save"></i> Guardar</button>


                      <button class="btn btn-danger" onclick="CancelarForm()" type="button" id="BtnCancelar"><i class="fa fa-arrow-circle-left"></i>
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

   <!--Modal-->


   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione un Producto</h4>
        </div>
        <div class="modal-body">
          <table id="TblProductos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Código</th>
                <th>Imagen</th>
                <th>Categoria</th>
               
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
            <th>Opciones</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Código</th>
                <th>Imagen</th>
                <th>Categoria</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  



    <!--Fin-Modal-->
<?php
}
else{

require 'NoAcceso.php';

}

require 'Footer.php';
?>

<script type="text/javascript" src="Scripts/Compra.js"></script>

<?php 

}
ob_end_flush();
?>