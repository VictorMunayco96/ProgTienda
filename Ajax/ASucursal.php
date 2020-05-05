<?php

require_once "../Modelo/MSucursal.php";

$MSucursal= new MSucursal();

$IdSucursal=isset($_POST["IdSucursal"]) ? limpiarCadena($_POST["IdSucursal"]):"" ;
$IdTienda=isset($_POST["IdTienda"]) ? limpiarCadena($_POST["IdTienda"]):"";
$Direccion=isset($_POST["Direccion"]) ? limpiarCadena($_POST["Direccion"]):"";
$Departamento=isset($_POST["Departamento"]) ? limpiarCadena($_POST["Departamento"]):"";
$Provincia=isset($_POST["Provincia"]) ? limpiarCadena($_POST["Provincia"]):"";


switch ($_GET["Op"]){

case 'GuardaryEditar':
if(empty($IdSucursal)){
$Rspta=$MSucursal->Insertar($IdTienda,$Direccion, $Departamento, $Provincia);
echo $Rspta ? "REGISTRADO" : "NO SE PUDO REGISTRAR";

}else{

    $Rspta=$MSucursal->Editar($IdSucursal,$IdTienda,$Direccion, $Departamento, $Provincia);
    echo $Rspta ? "EDITADO" : "NO SE PUDO EDITAR";
    

}
break;

case 'Desactivar':

$Rspta=$MSucursal->Desactivar($IdSucursal);
echo $Rspta ? "DESACTIVADO" : "NO SE PUDO DESACTIVAR";

break;



case 'Activar':

    $Rspta=$MSucursal->Activar($IdSucursal);
    echo $Rspta ? "ACTIVADO" : "NO SE PUDO ACTIVAR";
    
    break;

case 'Mostrar':

    $Rspta=$MSucursal->Mostrar($IdSucursal);
    echo json_encode($Rspta); 

break;

case 'Listar':

    $Rspta=$MSucursal->Listar();

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>($Reg->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdSucursal.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="Desactivar('.$Reg->IdSucursal.')"><i class="fa fa-close"></i></button>':
            '<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdSucursal.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-success" onclick="Activar('.$Reg->IdSucursal.')"><i class="fa fa-check"></i></button>',
            "1"=>$Reg->RazonSocial,
            "2"=>$Reg->Direccion,
            "3"=>$Reg->Departamento,
            "4"=>$Reg->Provincia,
            "5"=>($Reg->Estado)?'<span class="label bg-green">Activado</span>':
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



case "SelectTienda":

    require_once "../Modelo/MTienda.php";
    $MTienda = new MTienda();

    $Rspta=$MTienda->SelectTienda();

    while($Reg = $Rspta->fetch_object()){

        echo '<option value='.$Reg->IdTienda.'>'.$Reg->RazonSocial.'</option>';

    }


break;





}

?>