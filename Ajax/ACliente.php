<?php

ob_start();
session_start();

require_once "../Modelo/MCliente.php";

$MCliente= new MCliente();

$IdCliente=isset($_POST["IdCliente"]) ? limpiarCadena($_POST["IdCliente"]):"" ;
$TipoDocumento=isset($_POST["TipoDocumento"]) ? limpiarCadena($_POST["TipoDocumento"]):"";
$NumDocumento=isset($_POST["NumDocumento"]) ? limpiarCadena($_POST["NumDocumento"]):"";
$Nombres=isset($_POST["Nombres"]) ? limpiarCadena($_POST["Nombres"]):"";
$Apellidos=isset($_POST["Apellidos"]) ? limpiarCadena($_POST["Apellidos"]):"";
$RazonSocial=isset($_POST["RazonSocial"]) ? limpiarCadena($_POST["RazonSocial"]):"";

$FecNac=isset($_POST["FecNac"]) ? limpiarCadena($_POST["FecNac"]):"";

$NumCel=isset($_POST["NumCel"]) ? limpiarCadena($_POST["NumCel"]):"";
$Correo=isset($_POST["Correo"]) ? limpiarCadena($_POST["Correo"]):"";

$Direccion=isset($_POST["Direccion"]) ? limpiarCadena($_POST["Direccion"]):"";

$IdUsuario=$_SESSION['IdUsuario'];
$IdSucursal=$_SESSION['IdSucursal'];


switch ($_GET["Op"]){

case 'GuardaryEditar':
if(empty($IdCliente)){
$Rspta=$MCliente->Insertar($TipoDocumento, $NumDocumento, $Nombres, $Apellidos, $RazonSocial,$FecNac, $NumCel, $Correo, $Direccion,$IdUsuario, $IdSucursal);

echo $TipoDocumento.' - '. $NumDocumento.' - '.  $Nombres.' - '.  $Apellidos.' - '.  $RazonSocial.' - '. $FecNac.' - '.  $NumCel.' - '.  $Correo.' - '.  $Direccion.' - '. $IdUsuario.' - '.  $IdSucursal;

echo $Rspta ? "REGISTRADO" : "NO SE PUDO REGISTRAR";

}else{

    $Rspta=$MCliente->Editar($IdCliente,$TipoDocumento, $NumDocumento, $Nombres, $Apellidos, $RazonSocial, $FecNac, $NumCel, $Correo, $Direccion);
    echo $Rspta ? "EDITADO" : "NO SE PUDO EDITAR";
    

}
break;

case 'Desactivar':

$Rspta=$MCliente->Desactivar($IdCliente);
echo $Rspta ? "DESACTIVADO" : "NO SE PUDO DESACTIVAR";

break;



case 'Activar':

    $Rspta=$MCliente->Activar($IdCliente);
    echo $Rspta ? "ACTIVADO" : "NO SE PUDO ACTIVAR";
    
    break;

case 'Mostrar':

    $Rspta=$MCliente->Mostrar($IdCliente);
    echo json_encode($Rspta); 

break;

case 'Listar':

    $Rspta=$MCliente->Listar();

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>($Reg->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdCliente.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="Desactivar('.$Reg->IdCliente.')"><i class="fa fa-close"></i></button>':
            '<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdCliente.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-success" onclick="Activar('.$Reg->IdCliente.')"><i class="fa fa-check"></i></button>',
            "1"=>$Reg->TipoDocumento,
            "2"=>$Reg->NumDocumento,
            "3"=>$Reg->Nombres." ".$Reg->Apellidos,
            "4"=>$Reg->FecNac,
            "5"=>$Reg->NumCel,
            "6"=>$Reg->Correo,
            "7"=>$Reg->Direccion,
            "8"=>$Reg->Usuario,
            "9"=>$Reg->Direc." - ".$Reg->Provincia,
            "10"=>($Reg->Estado)?'<span class="label bg-green">Activado</span>':
            '<span class="label bg-red">Desactivado</span>'
        
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