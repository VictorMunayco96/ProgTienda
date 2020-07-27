<?php

require "../Config/Conexion.php";

    Class MVenta{

        public function __construct(){



        }

        public function Insertar($IdSucursal, $IdCliente, $TipoComprobante, $SerieCompro, $NumCompro, $TotalVenta,  $Impuesto, $IdUsuario, $IdIngresoTienda, $Cantidad, $Precio){

            $Sql="Insert into Venta(IdSucursal, IdCliente, TipoComprobante, SerieCompro,NumCompro ,Fecha, EstadoVenta, TotalVenta, Impuesto, Estado, IdUsuario) 
            values('$IdSucursal', '$IdCliente', '$TipoComprobante', '$SerieCompro','$NumCompro' ,(Select Now()), 1, '$TotalVenta', '$Impuesto', 1, '$IdUsuario')";

            /*echo "<script>
            alert('$IdUsuario'+ '$IdProveedor'+ '$TipoComprobante'+ '$SerieCompro'+ '$NumCompro'+ '$Fecha' +'$Asunto'+ '$Descripcion' +'0' +'$Impuesto'+ '$TotalCompra'+ '1');
          
</script>";*/

//return EjecutarConsulta($Sql);
            $IdVentaNew=EjecutarConsulta_RetornarID($Sql);

           /* echo "<script>
            alert('$IdVentaNew');
          
</script>";*/

            $Num_Elementos=0;

            

            $Sw=true;

            while($Num_Elementos< count($IdIngresoTienda)){

                $Sql_Detalle = "Insert into DetalleVenta(IdVenta, IdIngresoTienda, Cantidad, Precio) 
                values ('$IdVentaNew','$IdIngresoTienda[$Num_Elementos]', '$Cantidad[$Num_Elementos]','$Precio[$Num_Elementos]')";
    

               echo "<script>
                alert('$IdVentaNew'+' $IdIngresoTienda[$Num_Elementos]'+' $Cantidad[$Num_Elementos]'+' $Precio[$Num_Elementos]');
              
    </script>";
    

                EjecutarConsulta($Sql_Detalle) or $Sw = false;
    
                $Num_Elementos=$Num_Elementos+1;
    
               }
    
               return $Sw;

        }       
        
        

        public function Anular ($IdVenta){

            $Sql=" Update Venta set EstadoVenta=0 where IdVenta='$IdVenta';";
            
            return EjecutarConsulta($Sql);

        }


        


     /*   public function Recepcionar ($IdCompra){

            $Sql=" Update Compra set  EstadoCom=1 where IdCompra='$IdCompra';";
            
            return EjecutarConsulta($Sql);

        }
*/
        public function Mostrar($IdVenta){

            $Sql="SELECT * from Venta where IdVenta='$IdVenta'";
            return EjecutarConsultaSImpleFila($Sql);

        }


        
        public function listarDetalle($IdVenta)
	{
			$sql="Select DV.IdDetalleVenta, DV.IdVenta, DV.IdIngresoTienda, IT.PrecioVentaXMenor, P.Nombre, P.Descripcion, DV.Cantidad, DV.Precio from DetalleVenta DV
        inner join IngresoTienda IT on IT.IdIngresoTienda=DV.IdIngresoTienda
        inner join DetalleCompra DC on DC.IdDetalleCompra=IT.IdDetalleCompra
        inner join Producto P on P.IdProducto=DC.IdProducto 
        where DV.IdVenta='$IdVenta'";
		return ejecutarConsulta($sql);
	}

        public function Listar ($IdSucursal){

            $Sql="SELECT V.IdVenta, V.IdSucursal, V.IdCliente, C.Nombres, C.Apellidos ,V.TipoComprobante, V.SerieCompro, V.NumCompro,V.Fecha, V.EstadoVenta, V.TotalVenta, V.Impuesto, V.Estado, V.IdUsuario, U.Usuario from Venta V
            inner join Usuario U on U.Idusuario=V.IdUsuario 
            inner join Cliente C on C.IdCliente=V.IdCliente where V.IdSucursal='$IdSucursal';";
            
            return EjecutarConsulta($Sql);

        }


   



}

?>