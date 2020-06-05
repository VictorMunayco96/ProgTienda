<?php
session_start();
require_once "../Modelo/MCompra.php";

$MCompra= new MCompra();

$IdCompra=isset($_POST["IdCompra"]) ? limpiarCadena($_POST["IdCompra"]):"" ;
$IdUsuario=$_SESSION["IdUsuario"];
$IdProveedor=isset($_POST["IdProveedor"]) ? limpiarCadena($_POST["IdProveedor"]):"";
$TipoComprobante=isset($_POST["TipoComprobante"]) ? limpiarCadena($_POST["TipoComprobante"]):"";
$SerieCompro=isset($_POST["SerieCompro"]) ? limpiarCadena($_POST["SerieCompro"]):"";
$NumCompro=isset($_POST["NumCompro"]) ? limpiarCadena($_POST["NumCompro"]):"";
$Fecha=isset($_POST["Fecha"]) ? limpiarCadena($_POST["Fecha"]):"";
$Asunto=isset($_POST["Asunto"]) ? limpiarCadena($_POST["Asunto"]):"";
$Descripcion=isset($_POST["Descripcion"]) ? limpiarCadena($_POST["Descripcion"]):"";
$Impuesto=isset($_POST["Impuesto"]) ? limpiarCadena($_POST["Impuesto"]):"";
$TotalCompra=isset($_POST["TotalCompra"]) ? limpiarCadena($_POST["TotalCompra"]):"";

switch ($_GET["Op"]){

case 'GuardaryEditar':
if(empty($IdCompra)){
$Rspta=$MCompra->Insertar($IdUsuario, $IdProveedor, $TipoComprobante, $SerieCompro, $NumCompro, $Fecha, $Asunto, $Descripcion, $Impuesto, $TotalCompra, $_POST["IdProducto"],$_POST["Cantidad"],$_POST["PrecioCompra"],$_POST["CodigoBarra"]);

echo $IdUsuario." - ".$IdProveedor." - ". $TipoComprobante." - ". $SerieCompro." - ". $NumCompro." - ". $Fecha." - ". $Asunto." - ". $Descripcion." - ". $Impuesto." - ". $TotalCompra;
echo $Rspta ? "COMPRA REGISTRADA" : "NO SE PUDO REGISTRAR TODOS LOS DATOS DEL INGRESO";

}
break;

case 'Anular':

$Rspta=$MCompra->Anular($IdCompra);
echo $Rspta ? "ANULADO" : "NO SE PUDO ANULAR";

break;



case 'RECECIONAR':

    $Rspta=$MCompra->Recepcionar($IdCompra);
    echo $Rspta ? "RECEPCIONADO" : "NO SE PUDO RECEPCIONAR";
    
    break;

case 'Mostrar':

    $Rspta=$MCompra->Mostrar($IdCompra);
    echo json_encode($Rspta); 

break;

case 'Listar':

    $Rspta=$MCompra->Listar();

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>($Reg->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdCompra.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="Anular('.$Reg->IdCompra.')"><i class="fa fa-close"></i></button>':
            '<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdCompra.')"><i class="fa fa-pencil"></i></button>',
            "1"=>$Reg->RazonSocial,
            "2"=>$Reg->TipoComprobante,
            "3"=>$Reg->SerieCompro."-".$Reg->NumCompro,
            "4"=>$Reg->Asunto,
            "5"=>$Reg->Descripcion,
            "6"=>$Reg->Impuesto,
            "7"=>$Reg->TotalCompra,
            "8"=>$Reg->Fecha,
            "9"=>$Reg->Usuario,
         
            "10"=>($Reg->Estado)?'<span class="label bg-green">Aceptado</span>':
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


case "SelectProveedor":

    require_once "../Modelo/MProveedor.php";
    $MProveedor = new MProveedor();

    $Rspta=$MProveedor->SelectProveedor();

    while($Reg = $Rspta->fetch_object()){

        echo '<option value='.$Reg->IdProveedor.'>'.$Reg->RazonSocial.'</option>';

    }


break;



case "SelectProductoC":
    
    require_once "../Modelo/MProducto.php";
$MProducto= new MProducto();
    $Rspta=$MProducto->SelectProductoC();

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>'<button class="btn btn-warning" onclick="AgregarDetalle('.$Reg->IdProducto.',\''.$Reg->Nombre.'\')"><span class="fa fa-plus"></span></button>',
            "1"=>$Reg->Nombre,
            "2"=>$Reg->Descripcion,
      
            "3"=>$Reg->Codigo,
            "4"=>"<img src='../Files/Productos/".$Reg->imagen."' height='50px' width='50px' >",
            "5"=>$Reg->Categoria
          
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