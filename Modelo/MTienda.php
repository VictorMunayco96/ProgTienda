<?php

require "../Config/Conexion.php";

    Class MTienda{

        public function __construct(){



        }

        public function Insertar($RazonSocial, $Ruc){

            $Sql="Insert into Tienda (RazonSocial, Ruc,Estado) values('$RazonSocial','$Ruc','1')";

            return EjecutarConsulta($Sql);

        }       
        
        public function Editar($IdTienda, $RazonSocial, $Ruc){

            $Sql=" Update Tienda set RazonSocial='$RazonSocial', Ruc='$Ruc' where IdTienda='$IdTienda';";
            
            return EjecutarConsulta($Sql);

        }

        public function Desactivar ($IdTienda){

            $Sql=" Update Tienda set Estado=0 where IdTienda='$IdTienda';";
            
            return EjecutarConsulta($Sql);

        }


        public function Activar ($IdTienda){

            $Sql=" Update Tienda set  Estado=1 where IdTienda='$IdTienda';";
            
            return EjecutarConsulta($Sql);

        }

        public function Mostrar($IdTienda){

            $Sql="Select * from Tienda where IdTienda='$IdTienda'";
            return EjecutarConsultaSImpleFila($Sql);

        }

        public function Listar (){

            $Sql="Select * from Tienda;";
            
            return EjecutarConsulta($Sql);

        }


        public function SelectTienda (){

            $Sql="Select * from Tienda where Estado=1;";
            
            return EjecutarConsulta($Sql);

        }



}




?>