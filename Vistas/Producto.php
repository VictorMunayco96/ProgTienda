<?php


ob_start();
session_start();

if(!isset($_SESSION["IdUsuario"])){

  header("LOCATION: Login.php");

}else{

require 'Header.php';

if($_SESSION["Producto"]==1){
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
                          <h1 class="box-title">Producto 
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
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Stock Min Tienda</th>
                        <th>Stock Min General</th>
                        <th>Codigo</th>
                        <th>Imagen</th>
                        <th>Categoria</th>
                        <th>Estado</th>

                        </thead>

                        <tbody>
                        
</tbody>
                      <tfoot>

                      <th>Opciones</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Stock Min Tienda</th>
                        <th>Stock Min General</th>
                        <th>Codigo</th>
                        <th>Imagen</th>
                        <th>Categoria</th>
                        <th>Estado</th>


                    </tfoot>
                      
                       



                        </table>
                    </div>

                    <div class="panel-body" style="height: 700px;" id="FormularioRegistros">
                    
                    <form name="Formulario" id="Formulario" method="POST">

                    <div class="form-group col-log-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Categoria:</label>
                    <input type="hidden" name="IdProducto" id="IdProducto">
                    <select id="IdCategoria" name ="IdCategoria" class="form-control selectpicker" data-live-search="true"> </select>
                    </div>

                  

              


                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" placeholder="Nombre" name="Nombre" id="Nombre" required>

                    </div>


                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Descripcion:</label>
                    <input type="text" class="form-control" placeholder="Descripcion" name="Descripcion" id="Descripcion" required>
                    </div>

                    
                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Stock Min Tienda:</label>
                    <input type="number" step="0.10" class="form-control" placeholder="Stock Min Tienda" name="StockMinTienda" id="StockMinTienda" required>
                    </div>


                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Stock Min General:</label>
                    <input type="number" step="0.10" class="form-control" placeholder="Stock Min General" name="StockMinGeneral" id="StockMinGeneral" required>
                    </div>




                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Imagen:</label>
                    <input type="file" class="form-control" placeholder="imagen" name="imagen" id="Imagen">
                    <input type="hidden" name="imagenactual" id="imagenactual">
                    <img src="" width="150px" height="120px" id="imagenmuestra">
                    </div>

                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Codigo:</label>
                    
                    <input type="number" class="form-control" placeholder="Codigo" name="Codigo" id="Codigo" required>
                    <button class="btn btn-success" type="button" onclick="GenerarBarcode()">Generar</button>
                            <button class="btn btn-info" type="button" onclick="imprimir()">Imprimir</button>
                            <div id="Print">
                              <svg id="Barcode"></svg>
                            </div>
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
<script type="text/javascript" src="../Public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../Public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="Scripts/Producto.js"></script>

<?php 

}
ob_end_flush();
?>