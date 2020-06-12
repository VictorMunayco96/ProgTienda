<?php

require "../Config/Conexion.php";

    Class MProducto{

        public function __construct(){



        }

        public function Insertar($IdCategoria, $Codigo, $Nombre, $StockMinTienda, $StockMinGeneral, $Descripcion, $imagen){

            $Sql="Insert into Producto (IdCategoria, Codigo, Nombre, StockMinTienda, StockMinGeneral,Descripcion, Imagen, Estado) 
            values('$IdCategoria', '$Codigo', '$Nombre', '$StockMinTienda', '$StockMinGeneral', '$Descripcion', '$imagen','1')";

            return EjecutarConsulta($Sql);

        }       
        
        public function Editar($IdProducto,$IdCategoria, $Codigo, $Nombre, $StockMinTienda, $StockMinGeneral, $Descripcion, $imagen){

            $Sql=" Update Producto set IdCategoria='$IdCategoria', Codigo='$Codigo', Nombre='$Nombre', StockMinTienda='$StockMinTienda', StockMinGeneral='$StockMinGeneral', Descripcion='$Descripcion', Imagen='$imagen' where IdProducto='$IdProducto';";
            
            return EjecutarConsulta($Sql);

        }

        public function Desactivar ($IdProducto){

            $Sql=" Update Producto set Estado=0 where IdProducto='$IdProducto';";
            
            return EjecutarConsulta($Sql);

        }


        public function Activar ($IdProducto){

            $Sql=" Update Producto set  Estado=1 where IdProducto='$IdProducto';";
            
            return EjecutarConsulta($Sql);

        }

        public function Mostrar($IdProducto){

            $Sql="Select IdProducto, IdCategoria, Codigo, Nombre, StockMinTienda, StockMinGeneral, Descripcion, Imagen as imagen, Estado  from Producto where IdProducto='$IdProducto'";
            return EjecutarConsultaSImpleFila($Sql);

        }

        public function Listar (){

            $Sql="Select P.IdProducto, C.Categoria, P.Codigo, P.Nombre, P.StockMinTienda, P.StockMinGeneral, P.Descripcion, P.Imagen as imagen, P.Estado from Producto P
            inner join Categoria C on C.IdCategoria= P.IdCategoria;";
            
            return EjecutarConsulta($Sql);

        }


        /* public function SelectProducto (){

            $Sql="Select * from TipoProducto where Estado=1;";
            
            return EjecutarConsulta($Sql);

        }
 */

        public function SelectProductoC (){

            $Sql="Select P.IdProducto, C.Categoria, P.Codigo, P.Nombre, P.StockMinTienda, P.StockMinGeneral, P.Descripcion, P.Imagen as imagen, P.Estado from Producto P
            inner join Categoria C on C.IdCategoria= P.IdCategoria where P.Estado='1';";
            
            return EjecutarConsulta($Sql);

        }



}

?>