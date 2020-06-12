<?php

require "../Config/Conexion.php";

    Class MIngresoTienda{

        public function __construct(){



        }

        public function Insertar($Cantidad, $IdSucursal, $IdUsuario, $PrecioVentaXMenor, $PrecioVentaXMayor, $IdDetalleCompra){

         
           
            $Sql="Insert into IngresoTienda (Cantidad, IdSucursal, IdUsuario, PrecioVentaXMenor, PrecioVentaXMayor,Estado, EstadoEnvio, IdDetalleCompra,FechaReg,FechaRecepcion) 
            values('$Cantidad', '$IdSucursal', '$IdUsuario', '$PrecioVentaXMenor', '$PrecioVentaXMayor', 1, 0 ,'$IdDetalleCompra',(Select Now()), null);";

            return EjecutarConsulta($Sql);

        }       
        
        public function Editar($IdIngresoTienda, $Cantidad, $IdSucursal, $IdUsuario, $PrecioVentaXMenor, $PrecioVentaXMayor, $IdDetalleCompra){

            $Sql=" Update IngresoTienda set Cantidad='$Cantidad', IdSucursal='$IdSucursal', IdUsuario='$IdUsuario', PrecioVentaXMenor='$PrecioVentaXMenor', PrecioVentaXMayor='$PrecioVentaXMayor', IdDetalleCompra='$IdDetalleCompra', FechaReg=(Select NOW())
             where IdIngresoTienda='$IdIngresoTienda';";
            
            return EjecutarConsulta($Sql);

        }

        public function Desactivar ($IdIngresoTienda){

            $Sql=" Update IngresoTienda set Estado=0 where IdIngresoTienda='$IdIngresoTienda';";
            
            return EjecutarConsulta($Sql);

        }


        public function Activar ($IdIngresoTienda){

            $Sql=" Update IngresoTienda set Estado=1 where IdIngresoTienda='$IdIngresoTienda';";
            
            return EjecutarConsulta($Sql);

        }

        public function Aceptar ($IdIngresoTienda){

            $Sql=" Update IngresoTienda set EstadoEnvio=1, FechaRecepcion=(Select now()) where IdIngresoTienda='$IdIngresoTienda';";
            
            return EjecutarConsulta($Sql);

        }

        public function Rechazar ($IdIngresoTienda){

            $Sql=" Update IngresoTienda set EstadoEnvio=0, FechaRecepcion=(Select now()) where IdIngresoTienda='$IdIngresoTienda';";
            
            return EjecutarConsulta($Sql);

        }


        public function Mostrar($IdIngresoTienda){

            $Sql="Select * from IngresoTienda
            where IdIngresoTienda='$IdIngresoTienda'";
            return EjecutarConsultaSImpleFila($Sql);

        }



        public function ListarCabeceraProducto(){

            
            $Sql=" Select P.IdProducto, P.Nombre, P.Descripcion, P.StockMinTienda, P.StockMinGeneral, 
            ifnull((Select sum(DC.Cantidad) from DetalleCompra DC where DC.IdProducto=P.IdProducto and DC.Estado=1),0) as Ingreso,
            
            
            ifnull((Select sum(IT.Cantidad) from IngresoTienda IT inner join DetalleCompra DC on DC.IdDetalleCompra=IT.IdDetalleCompra where DC.IdProducto=P.IdProducto and IT.Estado=1 and IT.EstadoEnvio=1),0) as TotalEnvio, 
            P.Estado
            
            from Producto P
            
            where P.Estado=1;              ";
            
            return EjecutarConsulta($Sql);

        }


        public function ListarDetalleCompra ($IdProducto){

        

            $Sql="Select DC.IdDetalleCompra, DC.IdCompra, DC.IdProducto,P.Nombre,P.Descripcion, DC.Cantidad, DC.PrecioCompra, DC.CodigoBarra, 
            ifnull((Select sum(IT.Cantidad) from IngresoTienda IT where IT.IdDetalleCompra=DC.IdDetalleCompra and IT.Estado=1 and IT.EstadoEnvio=1),0) as Distribuido,
            DC.Estado from DetalleCompra  DC 
            inner join Producto P on P.IdProducto=DC.IdProducto
            
            where DC.IdProducto=$IdProducto and DC.Estado=1 order by DC.IdDetalleCompra desc;";


            return EjecutarConsulta($Sql);

        }



        public function ListarIngresoTienda($IdDetalleCompra){

            
            $Sql="  Select IT.IdIngresoTienda,P.Nombre, P.Descripcion ,IT.Cantidad, IT.IdSucursal, S.Provincia, S.Direccion, IT.IdUsuario, U.Usuario,IT.PrecioVentaXMenor, IT.PrecioVentaXMayor, IT.Estado, IT.EstadoEnvio, IT.FechaReg, IT.FechaRecepcion from IngresoTienda IT 
            inner join Sucursal S on S.Idsucursal=IT.IdSucursal
            inner join DetalleCompra DC on DC.IdDetalleCompra=IT.IdDetalleCompra
            inner join Producto P on P.IdProducto= DC.IdProducto
            inner join Usuario U on U.IdUsuario=IT.IdUsuario where IT.IdDetalleCompra=$IdDetalleCompra; ";
            
            return EjecutarConsulta($Sql);

        }




     


}
?>