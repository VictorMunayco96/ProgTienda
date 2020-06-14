<?php

require "../Config/Conexion.php";

    Class MProveedor{

        public function __construct(){



        }

        public function Insertar( $RazonSocial, $TipoDocumento,$NumDocumento,$Rublo,$NumCelular,$Telf,$Correo){

            $Sql="Insert into Proveedor (RazonSocial, TipoDocumento,NumDocumento,Rublo,NumCelular,Telf,Correo, Estado) values('$RazonSocial', '$TipoDocumento','$NumDocumento','$Rublo','$NumCelular','$Telf','$Correo','1')";

            return EjecutarConsulta($Sql);

        }       
        
        public function Editar($IdProveedor, $RazonSocial, $TipoDocumento,$NumDocumento,$Rublo,$NumCelular,$Telf,$Correo){

            $Sql=" Update Proveedor set  RazonSocial='$RazonSocial', TipoDocumento='$TipoDocumento',NumDocumento='$NumDocumento',Rublo='$Rublo',NumCelular='$NumCelular',Telf='$Telf',Correo='$Correo' where IdProveedor='$IdProveedor';";
            
            return EjecutarConsulta($Sql);

        }

        public function Desactivar ($IdProveedor){

            $Sql=" Update Proveedor set Estado=0 where IdProveedor='$IdProveedor';";
            
            return EjecutarConsulta($Sql);

        }


        public function Activar ($IdProveedor){

            $Sql=" Update Proveedor set  Estado=1 where IdProveedor='$IdProveedor';";
            
            return EjecutarConsulta($Sql);

        }

        public function Mostrar($IdProveedor){

            $Sql="Select * from Proveedor where IdProveedor='$IdProveedor'";
            return EjecutarConsultaSImpleFila($Sql);

        }

        public function Listar (){

            $Sql="Select * from Proveedor;";
            
            return EjecutarConsulta($Sql);

        }


        public function SelectProveedor (){

            $Sql="Select * from Proveedor where Estado=1;";
            
            return EjecutarConsulta($Sql);

        }



}
?>



