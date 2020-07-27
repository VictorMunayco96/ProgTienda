<?php

ob_start();
session_start();

require_once "../Modelo/MStocksPorSucursal.php";

$MStocksPorSucursal= new MStocksPorSucursal();


$IdSucursal=$_SESSION['IdSucursal'];


switch ($_GET["Op"]){



case 'Listar':

    $Rspta=$MStocksPorSucursal->Listar($IdSucursal);

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>$Reg->IdProducto,
            "1"=>$Reg->Nombre,
            "2"=>$Reg->Descripcion,
      
      
           
        
            "3"=>(($Reg->Ingreso-$Reg->Salida)>=$Reg->StockMinTienda)?'<span class="label bg-green">'.($Reg->Ingreso-$Reg->Salida).'</span>':
            (($Reg->Ingreso-$Reg->Salida)<=0)?'<span class="label bg-red">'.($Reg->Ingreso-$Reg->Salida).'</span>':
            '<span class="label bg-yellow">'.($Reg->Ingreso-$Reg->Salida).'</span>',
            "4"=>(($Reg->Ingreso-$Reg->Salida)>=$Reg->StockMinTienda)?'<span class="label bg-green">En Stock</span>':
            (($Reg->Ingreso-$Reg->Salida)<=0)?'<span class="label bg-red">Sin Stock</span>':
            '<span class="label bg-yellow">Agotandose</span>',
        
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