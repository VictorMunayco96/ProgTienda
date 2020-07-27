<?php
session_start();
require_once "../Modelo/MVenta.php";

$MVenta= new MVenta();

$IdVenta=isset($_POST["IdVenta"]) ? limpiarCadena($_POST["IdVenta"]):"" ;
$IdCliente=isset($_POST["IdCliente"]) ? limpiarCadena($_POST["IdCliente"]):"";
$TipoComprobante=isset($_POST["TipoComprobante"]) ? limpiarCadena($_POST["TipoComprobante"]):"";
$SerieCompro=isset($_POST["SerieCompro"]) ? limpiarCadena($_POST["SerieCompro"]):"";
$NumCompro=isset($_POST["NumCompro"]) ? limpiarCadena($_POST["NumCompro"]):"";
$TotalVenta=isset($_POST["TotalVenta"]) ? limpiarCadena($_POST["TotalVenta"]):"";
$Impuesto=isset($_POST["Impuesto"]) ? limpiarCadena($_POST["Impuesto"]):"";
$IdUsuario=$_SESSION["IdUsuario"];
$IdSucursal=$_SESSION["IdSucursal"];
switch ($_GET["Op"]){

case 'GuardaryEditar':
if(empty($IdVenta)){
$Rspta=$MVenta->Insertar($IdSucursal, $IdCliente, $TipoComprobante, $SerieCompro, $NumCompro, $TotalVenta,  $Impuesto, $IdUsuario,$_POST["IdIngresoTienda"], $_POST["Cantidad"], $_POST["Precio"]);
echo $Rspta ? "VENTA REGISTRADA" : "NO SE PUDO REGISTRAR TODOS LOS DATOS DEL INGRESO";

}
break;

case 'Anular':

$Rspta=$MVenta->Anular($IdVenta);
echo $Rspta ? "ANULADO" : "NO SE PUDO ANULAR";

break;





case 'Mostrar':

    $Rspta=$MVenta->Mostrar($IdVenta);
    echo json_encode($Rspta); 

break;


case 'listarDetalle':
    //Recibimos el idingreso
    $id=$_GET['id'];

    $rspta = $MVenta->listarDetalle($id);
    $total=0;
    echo '<thead style="background-color:#A9D0F5">
    <th>Opciones</th>
    <th>Articulo</th>
    <th>Cantidad</th>
    <th>Precio Venta</th>
    <th>Subtotal</th>
                            </thead>';

    while ($reg = $rspta->fetch_object())
            {
                echo '<tr class="filas"><td></td><td>'.$reg->Nombre." ".$reg->Descripcion.'</td><td>'.$reg->Cantidad.'</td><td>'.$reg->PrecioVentaXMenor.'</td><td>'.$reg->PrecioVentaXMenor*$reg->Cantidad.'</td></tr>';
                $total=$total+($reg->PrecioVentaXMenor*$reg->Cantidad);
            }
    echo '<tfoot>
    <th>TOTAL</th>
    <th></th>
    <th></th>
    <th></th>
  
   
    
    <th><h4 id="Total">S/. '.$total.' </h4><input type="hidden" name="TotalVenta" id="TotalVenta"></th>
    
                            </tfoot>';
break;




case 'Listar':

    $Rspta=$MVenta->Listar($IdSucursal);

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>($Reg->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdVenta.')"><i class="fa fa-eye"></i></button>'.
            ' <button class="btn btn-danger" onclick="Anular('.$Reg->IdVenta.')"><i class="fa fa-close"></i></button>':
            '<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdVenta.')"><i class="fa fa-eye"></i></button>',
            "1"=>$Reg->TipoComprobante,
            "2"=>$Reg->SerieCompro."-".$Reg->NumCompro,
            "3"=>$Reg->Nombres." ".$Reg->Apellidos,
            "4"=>$Reg->Fecha,
            "5"=>$Reg->Impuesto,
           
            "6"=>$Reg->TotalVenta,
            "7"=>$Reg->Usuario,
         
            "8"=>($Reg->Estado)?'<span class="label bg-green">Aceptado</span>':
            '<span class="label bg-red">Anulado</span>'
        
        );
    }

    $Result = array(

        "sEcho"=>1,
        "iTotalRecords"=>count($Data),
        "ITotalDisplayRecords"=>count($Data),
        "aaData"=>$Data);

        echo json_encode($Result);


break;


case "SelectCliente":

    require_once "../Modelo/MCliente.php";
    $MCliente = new MCliente();

    $Rspta=$MCliente->SelectCliente();

    while($Reg = $Rspta->fetch_object()){

        echo '<option value='.$Reg->IdCliente.'>'.$Reg->NumDocumento." - ".$Reg->Nombres." ".$Reg->Apellidos.'</option>';

    }


break;



case "SelectProductoV":
    
    require_once "../Modelo/MIngresoTienda.php";
$MIngresoTienda= new MIngresoTienda();
    $Rspta=$MIngresoTienda->SelectProductoV($IdSucursal);

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>'<button class="btn btn-warning" onclick="AgregarDetalle('.$Reg->IdIngresoTienda.',\''.$Reg->Nombre.'\''.',\''.$Reg->Descripcion.'\''.',\''.$Reg->PrecioVentaXMenor.'\')"><span class="fa fa-plus"></span></button>',
            "1"=>$Reg->Nombre,
            "2"=>$Reg->Descripcion,
            "3"=>$Reg->PrecioVentaXMenor,
            "4"=>$Reg->CodigoBarra,
            "5"=>"<img src='../Files/Productos/".$Reg->imagen."' height='50px' width='50px' >"
          
          
        );
    }

    $Result = array(

        "sEcho"=>1,
        "iTotalRecords"=>count($Data),
        "ITotalDisplayRecords"=>count($Data),
        "aaData"=>$Data);

        echo json_encode($Result);

break;




}

?>