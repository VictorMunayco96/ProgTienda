<?php

require_once "../Modelo/MPersonal.php";

$MPersonal= new MPersonal();

$IdPersonal=isset($_POST["IdPersonal"]) ? limpiarCadena($_POST["IdPersonal"]):"" ;
$Nombre=isset($_POST["Nombre"]) ? limpiarCadena($_POST["Nombre"]):"";
$Apellido=isset($_POST["Apellido"]) ? limpiarCadena($_POST["Apellido"]):"";
$FecNac=isset($_POST["FecNac"]) ? limpiarCadena($_POST["FecNac"]):"";
$TipoDocumento=isset($_POST["TipoDocumento"]) ? limpiarCadena($_POST["TipoDocumento"]):"";
$NumDocumento=isset($_POST["NumDocumento"]) ? limpiarCadena($_POST["NumDocumento"]):"";
$Area=isset($_POST["Area"]) ? limpiarCadena($_POST["Area"]):"";
$Cargo=isset($_POST["Cargo"]) ? limpiarCadena($_POST["Cargo"]):"";

switch ($_GET["Op"]){

case 'GuardaryEditar':
if(empty($IdPersonal)){
$Rspta=$MPersonal->Insertar($Nombre, $Apellido, $FecNac, $TipoDocumento, $NumDocumento, $Area,$Cargo);
echo $Rspta ? "REGISTRADO" : "NO SE PUDO REGISTRAR";

}else{

    $Rspta=$MPersonal->Editar($IdPersonal, $Nombre, $Apellido, $FecNac, $TipoDocumento, $NumDocumento, $Area,$Cargo);
    echo $Rspta ? "EDITADO" : "NO SE PUDO EDITAR";
    

}
break;

case 'Desactivar':

$Rspta=$MPersonal->Desactivar($IdPersonal);
echo $Rspta ? "DESACTIVADO" : "NO SE PUDO DESACTIVAR";

break;



case 'Activar':

    $Rspta=$MPersonal->Activar($IdPersonal);
    echo $Rspta ? "ACTIVADO" : "NO SE PUDO ACTIVAR";
    
    break;

case 'Mostrar':

    $Rspta=$MPersonal->Mostrar($IdPersonal);
    echo json_encode($Rspta); 

break;

case 'Listar':

    $Rspta=$MPersonal->Listar();

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>($Reg->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdPersonal.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="Desactivar('.$Reg->IdPersonal.')"><i class="fa fa-close"></i></button>':
            '<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdPersonal.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-success" onclick="Activar('.$Reg->IdPersonal.')"><i class="fa fa-check"></i></button>',
            "1"=>$Reg->Nombre,
            "2"=>$Reg->Apellido,
            "3"=>$Reg->FecNac,
            "4"=>$Reg->TipoDocumento,
            "5"=>$Reg->NumDocumento,
            "6"=>$Reg->Area,
            "7"=>$Reg->Cargo,
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