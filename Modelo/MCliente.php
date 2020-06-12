<?php

require "../Config/Conexion.php";

    Class MCliente{

        public function __construct(){



        }

        public function Insertar($TipoDocumento, $NumDocumento, $Nombres, $Apellidos, $RazonSocial,$FecNac, $NumCel, $Correo, $Direccion,$IdUsuario, $IdSucursal){

            $Sql="Insert into Cliente (TipoDocumento, NumDocumento, Nombres, Apellidos, RazonSocial,FecNac, NumCel, Correo, Direccion,IdUsuario, IdSucursal, Estado) 
            values('$TipoDocumento', '$NumDocumento', '$Nombres', '$Apellidos', '$RazonSocial','$FecNac', '$NumCel', '$Correo', '$Direccion','$IdUsuario', '$IdSucursal','1')";

            return EjecutarConsulta($Sql);

        }       
        
        public function Editar($IdCliente,$TipoDocumento, $NumDocumento, $Nombres, $Apellidos, $RazonSocial, $FecNac, $NumCel, $Correo, $Direccion){

            $Sql=" Update Cliente set TipoDocumento='$TipoDocumento', NumDocumento='$NumDocumento', Nombres='$Nombres', Apellidos='$Apellidos',RazonSocial='$RazonSocial', FecNac='$FecNac', NumCel='$NumCel', Correo='$Correo', Direccion='$Direccion' where IdCliente='$IdCliente';";
            
            return EjecutarConsulta($Sql);

        }

        public function Desactivar ($IdCliente){

            $Sql=" Update Cliente set Estado=0 where IdCliente='$IdCliente';";
            
            return EjecutarConsulta($Sql);

        }


        public function Activar ($IdCliente){

            $Sql=" Update Cliente set  Estado=1 where IdCliente='$IdCliente';";
            
            return EjecutarConsulta($Sql);

        }

        public function Mostrar($IdCliente){

            $Sql="Select * from Cliente where IdCliente='$IdCliente'";
            return EjecutarConsultaSImpleFila($Sql);

        }

        public function Listar (){

            $Sql="Select C.IdCliente , C.TipoDocumento, C.NumDocumento, C.Nombres, C.Apellidos, C.FecNac, C.NumCel, C.Correo, C.Estado, C.Direccion, C.IdUsuario, U.Usuario, C.IdSucursal, S.Direccion as Direc, S.Provincia from Cliente C
            inner join Usuario U on U.IdUsuario=C.Idusuario
            inner join Sucursal S on S.IdSucursal=C.IdSucursal;";
            
            return EjecutarConsulta($Sql);

        }


     

        public function SelectProductoVC (){

            $Sql="Select IdCliente, NumDocumento , Nombres, Apellidos  from Cliente C
            where Estado='1' and TipoDocumento='DNI';";
            
            return EjecutarConsulta($Sql);

        }



}

?>