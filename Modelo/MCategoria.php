<?php

require "../Config/Conexion.php";

    Class MCategoria{

        public function __construct(){



        }

        public function Insertar($IdTipoProducto, $Categoria){

            $Sql="Insert into Categoria (IdTipoProducto, Categoria ,Estado) values('$IdTipoProducto','$Categoria','1')";

            return EjecutarConsulta($Sql);

        }       
        
        public function Editar($IdCategoria, $IdTipoProducto, $Categoria){

            $Sql=" Update Categoria set IdTipoProducto='$IdTipoProducto', Categoria='$Categoria' where IdCategoria='$IdCategoria';";
            
            return EjecutarConsulta($Sql);

        }

        public function Desactivar ($IdCategoria){

            $Sql=" Update Categoria set Estado=0 where IdCategoria='$IdCategoria';";
            
            return EjecutarConsulta($Sql);

        }


        public function Activar ($IdCategoria){

            $Sql=" Update Categoria set  Estado=1 where IdCategoria='$IdCategoria';";
            
            return EjecutarConsulta($Sql);

        }

        public function Mostrar($IdCategoria){

            $Sql="Select * from Categoria where IdCategoria='$IdCategoria'";
            return EjecutarConsultaSImpleFila($Sql);

        }

        public function Listar (){

            $Sql="Select C.IdCategoria, TP.TipoProducto, C.Categoria, C.Estado from Categoria C
            inner join TipoProducto TP on TP.IdTipoProducto=C.IdTipoProducto where C.Estado=1;";
            
            return EjecutarConsulta($Sql);

        }


        public function SelectCategoria (){

            $Sql="Select * from Categoria where Estado=1;";
            
            return EjecutarConsulta($Sql);

        }



}




?>