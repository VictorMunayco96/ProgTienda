<?php

require "../Config/Conexion.php";

    Class MTipoProducto{

        public function __construct(){



        }

        public function Insertar($TipoProducto){

            $Sql="Insert into TipoProducto (TipoProducto, Estado) values('$TipoProducto','1')";

            return EjecutarConsulta($Sql);

        }       
        
        public function Editar($IdTipoProducto, $TipoProducto){

            $Sql=" Update TipoProducto set TipoProducto='$TipoProducto' where IdTipoProducto='$IdTipoProducto';";
            
            return EjecutarConsulta($Sql);

        }

        public function Desactivar ($IdTipoProducto){

            $Sql=" Update TipoProducto set Estado=0 where IdTipoProducto='$IdTipoProducto';";
            
            return EjecutarConsulta($Sql);

        }


        public function Activar ($IdTipoProducto){

            $Sql=" Update TipoProducto set  Estado=1 where IdTipoProducto='$IdTipoProducto';";
            
            return EjecutarConsulta($Sql);

        }

        public function Mostrar($IdTipoProducto){

            $Sql="Select * from TipoProducto where IdTipoProducto='$IdTipoProducto'";
            return EjecutarConsultaSImpleFila($Sql);

        }

        public function Listar (){

            $Sql="Select * from TipoProducto;";
            
            return EjecutarConsulta($Sql);

        }


        public function SelectTipoProducto (){

            $Sql="Select * from TipoProducto where Estado=1;";
            
            return EjecutarConsulta($Sql);

        }



}




?>