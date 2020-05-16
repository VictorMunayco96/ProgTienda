<?php
session_start();

require_once "../Modelos/MUsuario.php";

$MUsuario= new MUsuario();

$IdUsuario=isset($_POST["IdUsuario"]) ? limpiarCadena($_POST["IdUsuario"]):"" ;
$Usuario=isset($_POST["Usuario"]) ? limpiarCadena($_POST["Usuario"]):"";
$Contrasena=isset($_POST["Contrasena"]) ? limpiarCadena($_POST["Contrasena"]):"";
$TipoUsuario=isset($_POST["TipoUsuario"]) ? limpiarCadena($_POST["TipoUsuario"]):"";
$IdEmpleado=isset($_POST["IdEmpleado"]) ? limpiarCadena($_POST["IdEmpleado"]):"";
$Sector=isset($_POST["Sectores"]) ? limpiarCadena($_POST["Sectores"]):"";

switch ($_GET["Op"]){

case 'GuardaryEditar':

    $ClaveHash=hash("SHA256",$Contrasena);
if(empty($IdUsuario)){

$Rspta=$MUsuario->Insertar($Usuario,$Contrasena,$TipoUsuario,$IdEmpleado,$_POST['Permiso'],$Sector);
echo $Rspta ? "REGISTRADO" : "NO SE PUDO REGISTRAR";

}else{

    $Rspta=$MUsuario->Editar($IdUsuario,$Usuario, $Contrasena, $TipoUsuario, $IdEmpleado,$_POST['Permiso'],$Sector);
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
            "3"=>$Reg->NombreE." ".$Reg->ApellidosE,
            "4"=>$Reg->Sector,
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

case "SelectEmpleado":

    require_once "../Modelos/MEmpleado.php";
    $MEmpleado = new MEmpleado();

    $Rspta=$MEmpleado->Select();

    while($Reg = $Rspta->fetch_object()){

        echo '<option value=' .$Reg->IdEmpleado.'>'.$Reg->NombreE." ".$Reg->ApellidosE.'</option>';

    }


break;

case "Permiso":
    require_once "../Modelos/MPermiso.php";
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
           $_SESSION['Nombre']=$fetch->NombreE.' '.$fetch->ApellidosE;
           $_SESSION['Usuario']=$fetch->Usuario;
           $_SESSION['Sector']=$fetch->Sector;
           $_SESSION['NumSemana']=date("W");
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
            in_array(2,$valores)?$_SESSION['Almacen']=1:$_SESSION['Almacen']=0;
            in_array(3,$valores)?$_SESSION['Producto']=1:$_SESSION['Producto']=0;
            in_array(4,$valores)?$_SESSION['Transporte']=1:$_SESSION['Transporte']=0;
            in_array(5,$valores)?$_SESSION['Destino']=1:$_SESSION['Destino']=0;
            in_array(6,$valores)?$_SESSION['Personal']=1:$_SESSION['Personal']=0;
            in_array(7,$valores)?$_SESSION['Pedido']=1:$_SESSION['Pedido']=0;
            in_array(8,$valores)?$_SESSION['Panel']=1:$_SESSION['Panel']=0;
            in_array(9,$valores)?$_SESSION['Acceso']=1:$_SESSION['Acceso']=0;
            in_array(10,$valores)?$_SESSION['ConsulProd']=1:$_SESSION['ConsulProd']=0;
            in_array(11,$valores)?$_SESSION['ConsulProd2']=1:$_SESSION['ConsulProd2']=0;
  
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