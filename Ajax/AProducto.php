<?php

require_once "../Modelo/MProducto.php";

$MProducto= new MProducto();


$IdProducto=isset($_POST["IdProducto"]) ? limpiarCadena($_POST["IdProducto"]):"";
$IdCategoria=isset($_POST["IdCategoria"]) ? limpiarCadena($_POST["IdCategoria"]):"";
 $Codigo=isset($_POST["Codigo"]) ? limpiarCadena($_POST["Codigo"]):""; 
 $Nombre=isset($_POST["Nombre"]) ? limpiarCadena($_POST["Nombre"]):""; 
 $StockMinTienda=isset($_POST["StockMinTienda"]) ? limpiarCadena($_POST["StockMinTienda"]):""; 
 $StockMinGeneral=isset($_POST["StockMinGeneral"]) ? limpiarCadena($_POST["StockMinGeneral"]):""; 
 $Descripcion=isset($_POST["Descripcion"]) ? limpiarCadena($_POST["Descripcion"]):""; 
 $imagen=isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]):"";


switch ($_GET["Op"]){



case 'GuardaryEditar':

	if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../Files/Productos/" . $imagen);
			}
		}






if(empty($IdProducto)){
$Rspta=$MProducto->Insertar($IdCategoria, $Codigo, $Nombre, $StockMinTienda, $StockMinGeneral, $Descripcion, $imagen);
echo $Rspta ? "REGISTRADO" : "NO SE PUDO REGISTRAR";

}else{

    $Rspta=$MProducto->Editar($IdProducto,$IdCategoria, $Codigo, $Nombre, $StockMinTienda, $StockMinGeneral, $Descripcion, $imagen);
    echo $Rspta ? "EDITADO" : "NO SE PUDO EDITAR";
    

}
break;

case 'Desactivar':

$Rspta=$MProducto->Desactivar($IdProducto);
echo $Rspta ? "DESACTIVADO" : "NO SE PUDO DESACTIVAR";

break;



case 'Activar':

    $Rspta=$MProducto->Activar($IdProducto);
    echo $Rspta ? "ACTIVADO" : "NO SE PUDO ACTIVAR";
    
    break;

case 'Mostrar':

    $Rspta=$MProducto->Mostrar($IdProducto);
    echo json_encode($Rspta); 

break;

case 'Listar':

    $Rspta=$MProducto->Listar();

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>($Reg->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdProducto.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="Desactivar('.$Reg->IdProducto.')"><i class="fa fa-close"></i></button>':
            '<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdProducto.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-success" onclick="Activar('.$Reg->IdProducto.')"><i class="fa fa-check"></i></button>',
            "1"=>$Reg->Nombre,
            "2"=>$Reg->Descripcion,
            "3"=>$Reg->StockMinTienda,
            "4"=>$Reg->StockMinGeneral,
            "5"=>$Reg->Codigo,
            "6"=>"<img src='../Files/Productos/".$reg->Imagen."' height='50px' width='50px' >",
            "7"=>$Reg->Categoria,
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


case "SelectCategoria":

    require_once "../Modelo/MCategoria.php";
    $MCategoria = new MCategoria();

    $Rspta=$MCategoria->SelectCategoria();

    while($Reg = $Rspta->fetch_object()){

        echo '<option value='.$Reg->IdCategoria.'>'.$Reg->Categoria.'</option>';

    }


break;



}

?>