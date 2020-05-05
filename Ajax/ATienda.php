<?php

require_once "../Modelo/MTienda.php";

$MTienda= new MTienda();


$IdTienda=isset($_POST["IdTienda"]) ? limpiarCadena($_POST["IdTienda"]):"";
$RazonSocial=isset($_POST["RazonSocial"]) ? limpiarCadena($_POST["RazonSocial"]):"";
 $Ruc=isset($_POST["Ruc"]) ? limpiarCadena($_POST["Ruc"]):""; 
 


switch ($_GET["Op"]){



case 'GuardaryEditar':
    if(empty($IdTienda)){
        $Rspta=$MTienda->Insertar($RazonSocial,$Ruc);
        echo $Rspta ? "REGISTRADO" : "NO SE PUDO REGISTRAR";
        
        }else{
        
            $Rspta=$MTienda->Editar($IdTienda,$RazonSocial,$Ruc);
            echo $Rspta ? "EDITADO" : "NO SE PUDO EDITAR";
            
        
        }
break;

case 'Desactivar':

$Rspta=$MTienda->Desactivar($IdTienda);
echo $Rspta ? "DESACTIVADO" : "NO SE PUDO DESACTIVAR";

break;



case 'Activar':

    $Rspta=$MTienda->Activar($IdTienda);
    echo $Rspta ? "ACTIVADO" : "NO SE PUDO ACTIVAR";
    
    break;

case 'Mostrar':

    $Rspta=$MTienda->Mostrar($IdTienda);
    echo json_encode($Rspta); 

break;

case 'Listar':

    $Rspta=$MTienda->Listar();

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>($Reg->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdTienda.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="Desactivar('.$Reg->IdTienda.')"><i class="fa fa-close"></i></button>':
            '<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdTienda.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-success" onclick="Activar('.$Reg->IdTienda.')"><i class="fa fa-check"></i></button>',
            "1"=>$Reg->RazonSocial,
            "2"=>$Reg->Ruc,
            
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





}

?>