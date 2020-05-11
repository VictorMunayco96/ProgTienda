<?php

require_once "../Modelo/MProveedor.php";

$MProveedor= new MProveedor();

$IdProveedor=isset($_POST["IdProveedor"]) ? limpiarCadena($_POST["IdProveedor"]):"" ;
$RazonSocial=isset($_POST["RazonSocial"]) ? limpiarCadena($_POST["RazonSocial"]):"";
$TipoDocumento=isset($_POST["TipoDocumento"]) ? limpiarCadena($_POST["TipoDocumento"]):"";
$NumDocumento=isset($_POST["NumDocumento"]) ? limpiarCadena($_POST["NumDocumento"]):"";
$Rublo=isset($_POST["Rublo"]) ? limpiarCadena($_POST["Rublo"]):"";
$NumCelular=isset($_POST["NumCelular"]) ? limpiarCadena($_POST["NumCelular"]):"";
$Telf=isset($_POST["Telf"]) ? limpiarCadena($_POST["Telf"]):"";
$Correo=isset($_POST["Correo"]) ? limpiarCadena($_POST["Correo"]):"";


switch ($_GET["Op"]){

case 'GuardaryEditar':
if(empty($IdProveedor)){
$Rspta=$MProveedor->Insertar($RazonSocial, $TipoDocumento,$NumDocumento,$Rublo,$NumCelular,$Telf,$Correo);
echo $Rspta ? "REGISTRADO" : "NO SE PUDO REGISTRAR";

}else{

    $Rspta=$MProveedor->Editar($IdProveedor, $RazonSocial, $TipoDocumento,$NumDocumento,$Rublo,$NumCelular,$Telf,$Correo);
    echo $Rspta ? "EDITADO" : "NO SE PUDO EDITAR";
    

}
break;

case 'Desactivar':

$Rspta=$MProveedor->Desactivar($IdProveedor);
echo $Rspta ? "DESACTIVADO" : "NO SE PUDO DESACTIVAR";

break;



case 'Activar':

    $Rspta=$MProveedor->Activar($IdProveedor);
    echo $Rspta ? "ACTIVADO" : "NO SE PUDO ACTIVAR";
    
    break;

case 'Mostrar':

    $Rspta=$MProveedor->Mostrar($IdProveedor);
    echo json_encode($Rspta); 

break;

case 'Listar':

    $Rspta=$MProveedor->Listar();

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>($Reg->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdProveedor.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="Desactivar('.$Reg->IdProveedor.')"><i class="fa fa-close"></i></button>':
            '<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdProveedor.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-success" onclick="Activar('.$Reg->IdProveedor.')"><i class="fa fa-check"></i></button>',
            "1"=>$Reg->RazonSocial,
            "2"=>$Reg->TipoDocumento,
            "3"=>$Reg->NumDocumento,
            "4"=>$Reg->Rublo,
            "5"=>$Reg->NumCelular,
            "6"=>$Reg->Telf,
            "7"=>$Reg->Correo,
         
            "8"=>($Reg->Estado)?'<span class="label bg-green">Activado</span>':
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