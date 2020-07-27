<?php

require "../Config/Conexion.php";

    Class MStocksPorSucursal{

        public function __construct(){



        }

   

        public function Listar ($IdSucursal){

            $Sql="SELECT P.IdProducto, P.Nombre, P.Descripcion, P.StockMinTienda,
            ifnull((select sum(IT.Cantidad) from IngresoTienda IT inner join DetalleCompra DC on DC.IdDetalleCompra=IT.IdDetalleCompra where DC.IdProducto=P.IdProducto and IT.IdSucursal='$IdSucursal' and IT.EstadoEnvio=1 and IT.Estado=1
            ),0) as Ingreso,
            
            ifnull((select sum(DV.Cantidad) from DetalleVenta DV 
            inner join IngresoTienda IT on IT.IdIngresoTienda=DV.IdIngresoTienda 
            inner join DetalleCompra DC on DC.IdDetalleCompra= IT.IdDetalleCompra
            inner join Venta V on V.IdVenta=DV.IdVenta
            where DC.IdProducto=P.IdProducto and V.IdSucursal='$IdSucursal' and V.Estado=1),0) as Salida,P.Estado
            
            
            
            from Producto P where P.Estado=1;";
            
            return EjecutarConsulta($Sql);

        }


        



}