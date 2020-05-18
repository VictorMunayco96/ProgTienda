<?php

require "../Config/Conexion.php";

    Class MSucursal{

        public function __construct(){



        }

        public function Insertar($IdTienda, $Direccion, $Departamento, $Provincia){

            $Sql="Insert into Sucursal (IdTienda,Direccion,Departamento,Provincia,Estado) values('$IdTienda','$Direccion','$Departamento','$Provincia',1)";

            return EjecutarConsulta($Sql);

        }       
        
        public function Editar($IdSucursal,$IdTienda, $Direccion, $Departamento, $Provincia){

            $Sql="Update Sucursal set IdTienda='$IdTienda', Direccion='$Direccion', Departamento='$Departamento', Provincia='$Provincia' where IdSucursal='$IdSucursal';";
            
            return EjecutarConsulta($Sql);

        }

        public function Desactivar ($IdSucursal){

            $Sql=" Update Sucursal set Estado=0 where IdSucursal='$IdSucursal';";
            
            return EjecutarConsulta($Sql);

        }


        public function Activar ($IdSucursal){

            $Sql=" Update Sucursal set  Estado=1 where IdSucursal='$IdSucursal';";
            
            return EjecutarConsulta($Sql);

        }

        public function Mostrar($IdSucursal){

            $Sql="Select * from Sucursal where IdSucursal='$IdSucursal'";
            return EjecutarConsultaSImpleFila($Sql);

        }

        public function Listar (){

            $Sql="Select S.IdSucursal, T.RazonSocial, S.Direccion, S.Departamento, S.Provincia, S.Estado from Sucursal S inner join Tienda T on T.IdTienda=S.IdTienda;";
            
            return EjecutarConsulta($Sql);

        }


        public function SelectSucursal (){

            $Sql="Select * from Sucursal where Estado=1;";
            
            return EjecutarConsulta($Sql);

        }



}