<?php

require "../Config/Conexion.php";

    Class MPersonal{

        public function __construct(){



        }

        public function Insertar($Nombre, $Apellido, $FecNac, $TipoDocumento, $NumDocumento, $Area,$Cargo,$IdSucursal){

            $Sql="Insert into Personal(Nombre, Apellido, FecNac, Estado, TipoDocumento, NumDocumento, Area,Cargo, IdSucursal) values('$Nombre', '$Apellido', '$FecNac', '1', '$TipoDocumento', '$NumDocumento', '$Area','$Cargo','$IdSucursal')";

            return EjecutarConsulta($Sql);

        }       
        
        public function Editar($IdPersonal, $Nombre, $Apellido, $FecNac, $TipoDocumento, $NumDocumento, $Area,$Cargo,$IdSucursal){

            $Sql=" Update Personal set Nombre='$Nombre', Apellido='$Apellido', FecNac='$FecNac', TipoDocumento='$TipoDocumento', NumDocumento='$NumDocumento', Area='$Area', Cargo='$Cargo',IdSucursal='$IdSucursal' where IdPersonal='$IdPersonal';";
            
            return EjecutarConsulta($Sql);

        }

        public function Desactivar ($IdPersonal){

            $Sql=" Update Personal set Estado=0 where IdPersonal='$IdPersonal';";
            
            return EjecutarConsulta($Sql);

        }


        public function Activar ($IdPersonal){

            $Sql=" Update Personal set  Estado=1 where IdPersonal='$IdPersonal';";
            
            return EjecutarConsulta($Sql);

        }

        public function Mostrar($IdPersonal){

            $Sql="Select * from Personal where IdPersonal='$IdPersonal'";
            return EjecutarConsultaSImpleFila($Sql);

        }

        public function Listar (){

            $Sql="Select P.IdPersonal, P.Nombre, P.Apellido, P.FecNac, P.Estado, P.TipoDocumento,P.NumDocumento ,P.Area, P.Cargo, S.Direccion, S.Departamento from Personal P inner join Sucursal S
             on S.IdSucursal=P.IdSucursal;";
            
            return EjecutarConsulta($Sql);

        }


        public function SelectPersonal (){

            $Sql="Select * from Personal where Estado=1;";
            
            return EjecutarConsulta($Sql);

        }



}




?>