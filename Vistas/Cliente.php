<?php

/*
ob_start();
session_start();

if(!isset($_SESSION["IdUsuario"])){

  header("LOCATION: Login.php");

}else{
*/
require 'Header.php';

/*if($_SESSION["Producto"]==1){
*/?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Cliente
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
                        <th>Tipo Documento</th>
                        <th>Num Documento</th>
                   
                        <th>Nombre Y Apellidos</th>
                        <th>Fecha Nacimiento</th>
                     
                        <th>Num Celular</th>
                        <th>Correo</th>
                        <th>Direccion</th>
                        <th>Usuario</th>
                        <th>Sucursal</th>
                   
                        <th>Estado</th>

                        </thead>

                        <tbody>
                        
</tbody>
                      <tfoot>
                      <th>Opciones</th>
                        <th>Tipo Documento</th>
                        <th>Num Documento</th>
                   
                        <th>Nombre Y Apellidos</th>
                        <th>Fecha Nacimiento</th>
                     
                        <th>Num Celular</th>
                        <th>Correo</th>
                        <th>Direccion</th>
                        <th>Usuario</th>
                        <th>Sucursal</th>
                   
                        <th>Estado</th>


                    </tfoot>
                      
                       



                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;" id="FormularioRegistros">
                    
                    <form name="Formulario" id="Formulario" method="POST">


                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Tipo Documento:</label> 
                    <select id="TipoDocumento" name ="TipoDocumento" class="form-control selectpicker" data-live-search="true" required> 
                    <option value="SELECCIONE UN CAMPO" selected>SELECCIONE UN CAMPO</option>
                    <option value="DNI">DNI</option>
                    <option value="RUC">RUC</option>
                    
                    </select>
                    </div>


                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>N° Documento:</label>
                    <input type="hidden" name="IdCliente" id="IdCliente">
                    <input type="number" class="form-control" placeholder="N° Documento" name="NumDocumento" id="NumDocumento" required>
                    </div>


                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Nombres:</label>
                    <input type="text" class="form-control" placeholder="Nombres" name="Nombres" id="Nombres" required>
                    
                    </div>

                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Apellidos:</label>
                    <input type="text" class="form-control" placeholder="Apellidos" name="Apellidos" id="Apellidos" required>
                    
                    </div>

                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Razon Social:</label>
                    <input type="text" class="form-control" placeholder="Razon Social" name="RazonSocial" id="RazonSocial" required>
                    
                    </div>

                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Fecha Nacimiento:</label>
                    <input type="date" class="form-control"  name="FecNac" id="FecNac" required>
                    
                    </div>

                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Direccion:</label>
                    <input type="text" class="form-control"  placeholder="Direccion" name="Direccion" id="Direccion" >
                    
                    </div>

                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>N° Celular:</label>
                    <input type="text" class="form-control"  name="NumCel" id="NumCel"  placeholder="N° Celular" >
                    
                    </div>


                    <div class="form-group col-log-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Correo:</label>
                    <input type="email" class="form-control"  name="Correo" id="Correo"  placeholder="Correo">
                    
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
/*}
else{

require 'NoAcceso.php';

}
*/
require 'Footer.php';
?>

<script type="text/javascript" src="Scripts/Cliente.js"></script>

<?php 
/*
}
ob_end_flush();*/
?>