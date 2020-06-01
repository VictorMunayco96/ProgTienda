<?php
session_start();

require_once "../Modelo/MUsuario.php";

$MUsuario= new MUsuario();

$IdUsuario=isset($_POST["IdUsuario"]) ? limpiarCadena($_POST["IdUsuario"]):"" ;
$Usuario=isset($_POST["Usuario"]) ? limpiarCadena($_POST["Usuario"]):"";
$Contrasena=isset($_POST["Contrasena"]) ? limpiarCadena($_POST["Contrasena"]):"";
$TipoUsuario=isset($_POST["TipoUsuario"]) ? limpiarCadena($_POST["TipoUsuario"]):"";
$IdPersonal=isset($_POST["IdPersonal"]) ? limpiarCadena($_POST["IdPersonal"]):"";
$IdSucursal=isset($_POST["IdSucursal"]) ? limpiarCadena($_POST["IdSucursal"]):"";


switch ($_GET["Op"]){

case 'GuardaryEditar':

    $ClaveHash=hash("SHA256",$Contrasena);
if(empty($IdUsuario)){

$Rspta=$MUsuario->Insertar($IdPersonal, $Usuario, $Contrasena, $TipoUsuario,$_POST['Permiso'],$IdSucursal);
echo $Rspta ? "REGISTRADO" : "NO SE PUDO REGISTRAR";

}else{

    $Rspta=$MUsuario->Editar($IdUsuario,$Usuario, $Contrasena, $TipoUsuario, $IdPersonal,$_POST['Permiso'],$IdSucursal);
    echo $Rspta ? "EDITADO" : "NO SE PUDO EDITAR";
    

}
break;

case 'Desactivar':

$Rspta=$MUsuario->Desactivar($IdUsuario);
echo $Rspta ? "DESACTIVADO" : "NO SE PUDO DESACTIVAR";

break;



case 'Activar':

    $Rspta=$MUsuario->Activar($IdUsuario);
    echo $Rspta ? "ACTIVADO" : "NO SE PUDO ACTIVAR";
    
    break;

case 'Mostrar':

    $Rspta=$MUsuario->Mostrar($IdUsuario);
    echo json_encode($Rspta); 

break;

case 'Listar':

    $Rspta=$MUsuario->Listar();

    $Data = Array();

    while($Reg=$Rspta->fetch_object()){

        $Data[]=array(

            "0"=> ($Reg->Estado)?'<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdUsuario.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="Desactivar('.$Reg->IdUsuario.')"><i class="fa fa-close"></i></button>':
            '<button class="btn btn-warning" onclick="Mostrar('.$Reg->IdUsuario.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-success" onclick="Activar('.$Reg->IdUsuario.')"><i class="fa fa-check"></i></button>',
            "1"=>$Reg->Usuario,
           
            "2"=>$Reg->TipoUsuario,
            "3"=>$Reg->Nombre." ".$Reg->Apellido,
            
            "4"=>$Reg->Direccion." - ".$Reg->Departamento,
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

case "SelectPersonal":

    require_once "../Modelo/MPersonal.php";
    $MPersonal = new MPersonal();

    $Rspta=$MPersonal->SelectPersonal();

    while($Reg = $Rspta->fetch_object()){

        echo '<option value=' .$Reg->IdPersonal.'>'.$Reg->Nombre." ".$Reg->Apellido.'</option>';

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


case "Permiso":
    require_once "../Modelo/MPermiso.php";
    $MPermiso = new MPermiso();
    $Rspta=$MPermiso->Listar();

//obtener permisos asignados
$Id=$_GET['Id'];
$Marcados=$MUsuario->ListarMarcados($Id);

$Valores=array();

while($Per = $Marcados->fetch_object()){

array_push($Valores, $Per->IdPermiso);

}



    while($Reg = $Rspta->fetch_object()){

        
        $Sw=in_array($Reg->IdPermiso,$Valores)?'checked':'';
        echo '<li><input type="checkbox" '.$Sw.' name="Permiso[]" value="'.$Reg->IdPermiso.'"> '.$Reg->Nombre.'</li>';

    }

    break;

    case 'verificar':
        $logina=limpiarCadena($_POST['logina']);
        $clavea=limpiarCadena($_POST['clavea']);
 
     
 
        $rspta=$MUsuario->verificar($logina, $clavea);
 
        $fetch=$rspta->fetch_object();
 
        if (isset($fetch))
        {
            //Declaramos las variables de sesión
           $_SESSION['IdUsuario']=$fetch->IdUsuario;
           $_SESSION['Nombre']=$fetch->Nombre.' '.$fetch->Apellido;
           $_SESSION['Usuario']=$fetch->Usuario;
           $_SESSION['IdSucursal']=$fetch->IdSucursal;
        
           $_SESSION['TipoUsuario']=$fetch->TipoUsuario;

           
        

            
            //Obtenemos los permisos del usuario
            $marcados = $MUsuario->ListarMarcados($fetch->IdUsuario);
   
            //Declaramos el array para almacenar todos los permisos marcados
           $valores=array();
 
            //Almacenamos los permisos marcados en el array
           while ($per = $marcados->fetch_object())
                {
                    array_push($valores, $per->IdPermiso);
                }
 
            //Determinamos los accesos del usuario
  
            in_array(1,$valores)?$_SESSION['Escritorio']=1:$_SESSION['Escritorio']=0;
            in_array(2,$valores)?$_SESSION['Producto']=1:$_SESSION['Producto']=0;
            in_array(3,$valores)?$_SESSION['Almacen']=1:$_SESSION['Almacen']=0;
            in_array(4,$valores)?$_SESSION['Compras']=1:$_SESSION['Compras']=0;
            in_array(5,$valores)?$_SESSION['Ventas']=1:$_SESSION['Ventas']=0;
            in_array(6,$valores)?$_SESSION['Personal']=1:$_SESSION['Personal']=0;
            
            in_array(7,$valores)?$_SESSION['Acceso']=1:$_SESSION['Acceso']=0;
            in_array(8,$valores)?$_SESSION['ConsulCompras']=1:$_SESSION['ConsulCompras']=0;
            in_array(9,$valores)?$_SESSION['ConsulVentas']=1:$_SESSION['ConsulVentas']=0;
  
        }
        echo json_encode($fetch);
    break;


    case "Salir":

    session_unset();

    session_destroy();

    header("Location: ../index.php");
    
    break;


    

}

?>