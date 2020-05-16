<?php

require_once "../Modelo/MPermiso.php";

$MPermiso= new MPermiso();

$IdPermiso=isset($_POST["IdPermiso"]) ? limpiarCadena($_POST["IdPermiso"]):"" ;
$Nombre=isset($_POST["Nombre"]) ? limpiarCadena($_POST["Nombre"]):"";;

switch ($_GET["Op"]){

case 'GuardaryEditar':
if(empty($IdPermiso)){
$Rspta=$MPermiso->Insertar($Nombre);
echo $Rspta ? "REGISTRADO" : "NO SE PUDO REGISTRAR";

}else{

    $Rspta=$MPermiso->Editar($IdPermiso,$Nombre);
    echo $Rspta ? "EDITADO" : "NO SE PUDO EDITAR";
    

}
break;

case 'Desactivar':

$Rspta=$MPermiso->Desactivar($IdPermiso);
echo $Rspta ? "DESACTIVADO" : "NO SE PUDO DESACTIVAR";

break;



case 'Activar':

    $Rspta=$MPermiso->Activar($IdPermiso);
    echo $Rspta ? "ACTIVADO" : "NO SE PUDO ACTIVAR";
    
    break;

case 'Mostrar':

    $Rspta=$MPermiso->Mostrar($IdPermiso);
    echo json_encode($Rspta); 

break;

case 'Listar':

    $Rspta=$MPermiso->Listar();

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>($Reg->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdPermiso.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="Desactivar('.$Reg->IdPermiso.')"><i class="fa fa-close"></i></button>':
            '<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdPermiso.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-success" onclick="Activar('.$Reg->IdPermiso.')"><i class="fa fa-check"></i></button>',
            "1"=>$Reg->Nombre,
            "2"=>($Reg->Estado)?'<span class="label bg-green">Activado</span>':
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