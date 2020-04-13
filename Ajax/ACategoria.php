<?php

require_once "../Modelo/MCategoria.php";

$MCategoria= new MCategoria();

$IdCategoria=isset($_POST["IdCategoria"]) ? limpiarCadena($_POST["IdCategoria"]):"" ;
$IdTipoProducto=isset($_POST["IdTipoProducto"]) ? limpiarCadena($_POST["IdTipoProducto"]):"";
$Categoria=isset($_POST["Categoria"]) ? limpiarCadena($_POST["Categoria"]):"";


switch ($_GET["Op"]){

case 'GuardaryEditar':
if(empty($IdCategoria)){
$Rspta=$MCategoria->Insertar($IdTipoProducto, $Categoria);
echo $Rspta ? "REGISTRADO" : "NO SE PUDO REGISTRAR";

}else{

    $Rspta=$MCategoria->Editar($IdTipoProducto,$TipoProducto,$Categoria);
    echo $Rspta ? "EDITADO" : "NO SE PUDO EDITAR";
    

}
break;

case 'Desactivar':

$Rspta=$MCategoria->Desactivar($IdCategoria);
echo $Rspta ? "DESACTIVADO" : "NO SE PUDO DESACTIVAR";

break;



case 'Activar':

    $Rspta=$MCategoria->Activar($IdCategoria);
    echo $Rspta ? "ACTIVADO" : "NO SE PUDO ACTIVAR";
    
    break;

case 'Mostrar':

    $Rspta=$MCategoria->Mostrar($IdCategoria);
    echo json_encode($Rspta); 

break;

case 'Listar':

    $Rspta=$MCategoria->Listar();

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>($Reg->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdCategoria.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="Desactivar('.$Reg->IdCategoria.')"><i class="fa fa-close"></i></button>':
            '<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdCategoria.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-success" onclick="Activar('.$Reg->IdCategoria.')"><i class="fa fa-check"></i></button>',
            "1"=>$Reg->Categoria,
            "2"=>$Reg->TipoProducto,
            "3"=>($Reg->Estado)?'<span class="label bg-green">Activado</span>':
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


case "SelectTipoProducto":

    require_once "../Modelo/MTipoProducto.php";
    $MTipoProducto = new MTipoProducto();

    $Rspta=$MTipoProducto->SelectTipoProducto();

    while($Reg = $Rspta->fetch_object()){

        echo '<option value='.$Reg->IdTipoProducto.'>'.$Reg->TipoProducto.'</option>';

    }


break;



}

?>