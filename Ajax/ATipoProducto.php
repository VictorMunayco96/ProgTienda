<?php

require_once "../Modelo/MTipoProducto.php";

$MTipoProducto= new MTipoProducto();

$IdTipoProducto=isset($_POST["IdTipoProducto"]) ? limpiarCadena($_POST["IdTipoProducto"]):"" ;
$TipoProducto=isset($_POST["TipoProducto"]) ? limpiarCadena($_POST["TipoProducto"]):"";


switch ($_GET["Op"]){

case 'GuardaryEditar':
if(empty($IdTipoProducto)){
$Rspta=$MTipoProducto->Insertar($TipoProducto);
echo $Rspta ? "REGISTRADO" : "NO SE PUDO REGISTRAR";

}else{

    $Rspta=$MTipoProducto->Editar($IdTipoProducto,$TipoProducto);
    echo $Rspta ? "EDITADO" : "NO SE PUDO EDITAR";
    

}
break;

case 'Desactivar':

$Rspta=$MTipoProducto->Desactivar($IdTipoProducto);
echo $Rspta ? "DESACTIVADO" : "NO SE PUDO DESACTIVAR";

break;



case 'Activar':

    $Rspta=$MTipoProducto->Activar($IdTipoProducto);
    echo $Rspta ? "ACTIVADO" : "NO SE PUDO ACTIVAR";
    
    break;

case 'Mostrar':

    $Rspta=$MTipoProducto->Mostrar($IdTipoProducto);
    echo json_encode($Rspta); 

break;

case 'Listar':

    $Rspta=$MTipoProducto->Listar();

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>($Reg->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdTipoProducto.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="Desactivar('.$Reg->IdTipoProducto.')"><i class="fa fa-close"></i></button>':
            '<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdTipoProducto.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-success" onclick="Activar('.$Reg->IdTipoProducto.')"><i class="fa fa-check"></i></button>',
            "1"=>$Reg->TipoProducto,
         
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