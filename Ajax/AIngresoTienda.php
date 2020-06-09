<?php
ob_start();
session_start();
require_once "../Modelo/MIngresoTienda.php";

$MIngresoTienda= new MIngresoTienda();

$IdIngresoTienda=isset($_POST["IdIngresoTienda"]) ? limpiarCadena($_POST["IdIngresoTienda"]):"" ;
$Cantidad=isset($_POST["Cantidad"]) ? limpiarCadena($_POST["Cantidad"]):"";
$IdSucursal=isset($_POST["IdSucursal"]) ? limpiarCadena($_POST["IdSucursal"]):"";
$IdUsuario=$_SESSION['IdUsuario'];
$PrecioVentaXMenor=isset($_POST["PrecioVentaXMenor"]) ? limpiarCadena($_POST["PrecioVentaXMenor"]):"";
$PrecioVentaXMayor=isset($_POST["PrecioVentaXMayor"]) ? limpiarCadena($_POST["PrecioVentaXMayor"]):"";
$IdDetalleCompra=isset($_POST["IdDetalleCompra"]) ? limpiarCadena($_POST["IdDetalleCompra"]):"";



switch ($_GET["Op"]){

case 'GuardaryEditar':
if(empty($IdIngresoTienda)){

  
$Rspta=$MIngresoTienda->Insertar($Cantidad, $IdSucursal, $IdUsuario, $PrecioVentaXMenor, $PrecioVentaXMayor, $IdDetalleCompra);

echo $Rspta ? "REGISTRADO" : "NO SE PUDO REGISTRAR";

}else{

    $Rspta=$MIngresoTienda->Editar($IdIngresoTienda, $Cantidad, $IdSucursal, $IdUsuario, $PrecioVentaXMenor, $PrecioVentaXMayor, $IdDetalleCompra);
    echo $Rspta ? "EDITADO" : "NO SE PUDO EDITAR";
    

}
break;

case 'Desactivar':

$Rspta=$MIngresoTienda->Desactivar($IdIngresoTienda);
echo $Rspta ? "DESACTIVADO" : "NO SE PUDO DESACTIVAR";

break;



case 'Activar':

    $Rspta=$MIngresoTienda->Activar($IdIngresoTienda);
    echo $Rspta ? "ACTIVADO" : "NO SE PUDO ACTIVAR";
    
    break;

case 'Aceptar':

        $Rspta=$MIngresoTienda->Aceptar($IdIngresoTienda);
        echo $Rspta ? "ACEPTADO" : "NO SE PUDO ACEPTAR";
        
        break;

case 'Rechazar':

            $Rspta=$MIngresoTienda->Rechazar($IdIngresoTienda);
            echo $Rspta ? "RECHAZADO" : "NO SE PUDO RECHAZAR";
            
            break;

case 'Mostrar':
    
    $Rspta=$MIngresoTienda->Mostrar($IdIngresoTienda);
    echo json_encode($Rspta); 

break;


case 'ListarCabeceraProducto':

    
    $Rspta=$MIngresoTienda->ListarCabeceraProducto();

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=>'<button class="btn btn-success" onclick="ListarDetalleCompra('.$Reg->IdProducto.')"><i class="fa fa-eye"></i></button>',
       
            
            "1"=>$Reg->Nombre,
            "2"=>$Reg->Descripcion,
            "3"=>$Reg->StockMinTienda,
            "4"=>$Reg->StockMinGeneral,
            "5"=>($Reg->Ingreso-$Reg->TotalEnvio),
            "6"=>($Reg->StockMinGeneral<($Reg->Ingreso-$Reg->TotalEnvio))?'<span class="label bg-green">EN STOCK</span>':
            '<span class="label bg-yellow">AGOTANDOSE</span>',         

            "7"=>($Reg->Estado)?'<span class="label bg-green">Activado</span>':
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


case 'ListarDetalleCompra':

   
    $IdProducto=$_REQUEST['IdProducto'];
    
    
    
    
        $RsptaP=$MIngresoTienda->ListarDetalleCompra($IdProducto);
       
        $DataP = Array();
    
        while($RegP=$RsptaP->fetch_object()){
    
            $DataP[]=array(
    
             
                
    
    
    
                "0"=>'<button class="btn btn-success" onclick="AgregarIngresoTienda('.$RegP->IdDetalleCompra.')"><i class="fa fa-plus"></i></button>'.
                ' <button class="btn btn-warning" onclick="ListarIngresoTienda('.$RegP->IdDetalleCompra.')"><i class="fa fa-eye"></i></button>',
    
                "1"=>$RegP->Nombre,
                "2"=>$RegP->Descripcion,
                "3"=>$RegP->Cantidad,
              
                "4"=>$RegP->PrecioCompra,
                "5"=>$RegP->CodigoBarra,
               
              
                "6"=>$RegP->Distribuido,
             
               
                "7"=>($RegP->Estado)?'<span class="label bg-green">Activado</span>':
                '<span class="label bg-red">Desactivado</span>'
                
            
            );
        }
    
        $Result = array(
    
            "sEcho"=>1,
            "iTotalRecords"=>count($DataP),
            "ITotalDisplayRecords"=>count($DataP),
            "aaData"=>$DataP);
    
            echo json_encode($Result);
    
    
    
    


break;




case 'ListarIngresoTienda':

    $IdDetalleCompra=$_REQUEST['IdDetalleCompra'];
        
        
    if($_SESSION['TipoUsuario']=="DIGITADOR"){

        $RsptaVA=$MIngresoTienda->ListarIngresoTienda($IdDetalleCompra);
       
        $DataVA = Array();
    
        while($RegVA=$RsptaVA->fetch_object()){
    
            $DataVA[]=array(
    
             
                
    
    
    
                "0"=>($RegVA->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$RegVA->IdIngresoTienda.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-danger" onclick="Desactivar('.$RegVA->IdIngresoTienda.')"><i class="fa fa-close"></i></button>':
                '<button class="btn btn-warning" onclick="Mostrar('.$RegVA->IdIngresoTienda.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-success" onclick="Activar('.$RegVA->IdIngresoTienda.')"><i class="fa fa-check"></i></button>',
                "1"=>$RegVA->Nombre,
                "2"=>$RegVA->Descripcion,
                "3"=>$RegVA->Cantidad,
                "4"=>$RegVA->Provincia." - ".$RegVA->Direccion,
                
                "5"=>$RegVA->PrecioVentaXMenor,
                "6"=>$RegVA->PrecioVentaXMayor,
                "7"=>$RegVA->Usuario,
                "8"=>$RegVA->FechaReg,
               
                "9"=>($RegVA->EstadoEnvio)?'<span class="label bg-green">Aceptado</span>':
                '<span class="label bg-orange">Pendiente</span>',
                "10"=>($RegVA->Estado)?'<span class="label bg-green">Activado</span>':
                '<span class="label bg-red">Desactivado</span>'
                
            
            );
        }
    
        $Result = array(
    
            "sEcho"=>1,
            "iTotalRecords"=>count($DataVA),
            "ITotalDisplayRecords"=>count($DataVA),
            "aaData"=>$DataVA);
    
            echo json_encode($Result);
    
    
    
    }else{
    
    
        $RsptaVA=$MIngresoTienda->ListarIngresoTienda($IdDetalleCompra);
       
        $DataVA = Array();
    
        while($RegVA=$RsptaVA->fetch_object()){
    
            $DataVA[]=array(
             
                
    
    
    
                "0"=>($RegVA->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$RegVA->IdIngresoTienda.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-danger" onclick="Desactivar('.$RegVA->IdIngresoTienda.')"><i class="fa fa-close"></i></button>':
                '<button class="btn btn-warning" onclick="Mostrar('.$RegVA->IdIngresoTienda.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-success" onclick="Activar('.$RegVA->IdIngresoTienda.')"><i class="fa fa-check"></i></button>',
    
                "1"=>($RegVA->EstadoEnvio)?' <button class="btn btn-warning" onclick="Rechazar('.$RegVA->IdIngresoTienda.')"><i class="fa fa-close"></i></button>':
                ' <button class="btn btn-success" onclick="Aceptar('.$RegVA->IdIngresoTienda.')"><i class="fa fa-check"></i></button>',
                "2"=>$RegVA->Nombre,
                "3"=>$RegVA->Descripcion,
                "4"=>$RegVA->Cantidad,
                "5"=>$RegVA->Provincia." - ".$RegVA->Direccion,
                
                "6"=>$RegVA->PrecioVentaXMenor,
                "7"=>$RegVA->PrecioVentaXMayor,
                "8"=>$RegVA->Usuario,
                "9"=>$RegVA->FechaReg,
               
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
    
    
    
    
    }
    
    
    
    break;
    
    




    case "SelectSucursal":

        require_once "../Modelo/MSucursal.php";
        $MSucursal = new MSucursal();
    
        $Rspta=$MSucursal->SelectSucursal();
    
        while($Reg = $Rspta->fetch_object()){
    
            echo '<option value='.$Reg->IdSucursal.'>'.$Reg->Direccion."-".$Reg->Departamento.'</option>';
    
        }
    
    
    break;



















}

?>