<?php

require "../Config/Conexion.php";

    Class MTransferenciasPend{

        public function __construct(){



        }

       

   

        public function Aceptar ($IdIngresoTienda){

            $Sql=" Update IngresoTienda set EstadoEnvio=1, FechaRecepcion=(Select now()) where IdIngresoTienda='$IdIngresoTienda';";
            
            return EjecutarConsulta($Sql);

        }

 



        public function ListarIngresoTienda($IdSucursal){

            
            $Sql="   Select IT.IdIngresoTienda,P.Nombre, P.Descripcion ,IT.Cantidad, IT.IdSucursal, S.Provincia, S.Direccion, IT.IdUsuario, U.Usuario,IT.PrecioVentaXMenor, IT.PrecioVentaXMayor, IT.Estado, IT.EstadoEnvio, IT.FechaReg, IT.FechaRecepcion from IngresoTienda IT 
            inner join Sucursal S on S.Idsucursal=IT.IdSucursal
            inner join DetalleCompra DC on DC.IdDetalleCompra=IT.IdDetalleCompra
            inner join Producto P on P.IdProducto= DC.IdProducto
            inner join Usuario U on U.IdUsuario=IT.IdUsuario where IT.IdSucursal='$IdSucursal' and IT.EstadoEnvio=0 and IT.Estado=1; ";
            
            return EjecutarConsulta($Sql);

        }


     






     


}
?>