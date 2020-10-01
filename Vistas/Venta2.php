<?php


ob_start();
session_start();

if(!isset($_SESSION["IdUsuario"])){

  header("LOCATION: Login.php");

}else{

require 'Header.php';

if($_SESSION["Ventas"]==1){
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-log-5 col-md-5 col-sm-5 col-xs5">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title"> PUNTO DE VENTA
                         
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->



                 

                    <div class="panel-body" >
                    
                    


                    <div class="form-group col-log-12 col-md-12 col-sm-12 col-xs12">


                    <table id="Detalles" class="table table-striped table-bordered table-condensed table-hover" >

<thead style="background-color:#A9D0F5">

<th>Opciones</th>
<th>Articulo</th>
<th>Cantidad</th>
<th>Precio Venta</th>

<th>Subtotal</th>

</thead>

<tbody>
</tbody>
<tfood>


<th>TOTAL</th>
<th></th>
<th></th>
<th></th>


<th><h4 id="Total">S/. 0.00</h4><input type="hidden" name="TotalVenta" id="TotalVenta"></th>

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
















              <div class="col-log-7 col-md-7 col-sm-7 col-xs7">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title"> PRODUCTOS
                          
                    
                           
                        <div class="box-tools pull-right">
                        </div>


                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->



                 

                 

                  

                






                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->

</div>






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

<script type="text/javascript" src="Scripts/Venta.js"></script>

<?php 

}
ob_end_flush();
?>