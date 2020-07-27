<?php
ob_start();
session_start();
require_once "../Modelo/MTransferenciasPend.php";

$MTransferenciasPend= new MTransferenciasPend();


$IdSucursal=$_SESSION['IdSucursal'];
$IdIngresoTienda=isset($_POST["IdIngresoTienda"]) ? limpiarCadena($_POST["IdIngresoTienda"]):"" ;



switch ($_GET["Op"]){



case 'Aceptar':

        $Rspta=$MTransferenciasPend->Aceptar($IdIngresoTienda);
        echo $Rspta ? "ACEPTADO" : "NO SE PUDO ACEPTAR";
        
        break;









case 'ListarIngresoTienda':

  
    
        $RsptaVA=$MTransferenciasPend->ListarIngresoTienda($IdSucursal);
       
        $DataVA = Array();
    
        while($RegVA=$RsptaVA->fetch_object()){
    
            $DataVA[]=array(
             
                
    
    
    
                
                "0"=>($RegVA->EstadoEnvio==0)?'<button class="btn btn-success" onclick="Aceptar('.$RegVA->IdIngresoTienda.')"><i class="fa fa-check"></i></button>':'',
                "1"=>$RegVA->Nombre,
                "2"=>$RegVA->Descripcion,
                "3"=>$RegVA->Cantidad,
                "4"=>$RegVA->Provincia." - ".$RegVA->Direccion,
                
                "5"=>$RegVA->PrecioVentaXMenor,
                "6"=>$RegVA->PrecioVentaXMayor,
                "7"=>$RegVA->Usuario,
                "8"=>$RegVA->FechaReg,
                "9"=>$RegVA->FechaRecepcion,
               
                "10"=>($RegVA->EstadoEnvio)?'<span class="label bg-green">Aceptado</span>':
                '<span class="label bg-orange">Pendiente</span>',
                "11"=>($RegVA->Estado)?'<span class="label bg-green">Activado</span>':
                '<span class="label bg-red">Desactivado</span>'
                
                
            
            );
        }
    
        $Result = array(
    
            "sEcho"=>1,
            "iTotalRecords"=>count($DataVA),
            "ITotalDisplayRecords"=>count($DataVA),
            "aaData"=>$DataVA);
    
            echo json_encode($Result);
    
    
    
    
    
    
    
    
    break;
    
    



}

?>