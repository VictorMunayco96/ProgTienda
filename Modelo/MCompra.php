<?php

require "../Config/Conexion.php";

    Class MCompra{

        public function __construct(){



        }

        public function Insertar($IdUsuario, $IdProveedor, $TipoComprobante, $SerieCompro, $NumComprobante, $Fecha, $Asunto, $Descripcion, $EstadoCom, $Impuesto, $TotalCompra, $Estado, $IdProducto, $Cantidad, $PrecioCompra, $Codigobarra){

            $Sql="Insert into Compra (IdUsuario, IdProveedor, TipoComprobante, SerieCompro, NumComprobante, Fecha, Asunto, Descripcion, EstadoCom, Impuesto, TotalCompra, Estado) 
            values('$IdUsuario', '$IdProveedor', '$TipoComprobante', '$SerieCompro', '$NumComprobante', '$Fecha', '$Asunto', '$Descripcion', '0', '$Impuesto', '$TotalCompra', '1')";

            $IdCompraNew=EjecutarConsulta_RetornarID($Sql);

            $Num_Elementos=0;

            $Sw=true;

            while($Num_Elementos< count($IdProducto)){

                $Sql_Detalle = "Insert into DetalleCompra(IdCompra, IdProducto, Cantidad, PrecioCompra, CodigoBarra, Estado) 
                values ('$IdCompraNew','$IdProducto[$Num_Elementos]', '$Cantidad[$Num_Elementos]','$PrecioCompra[$Num_Elementos]','$CodigoBarra[$Num_Elementos]','1')";
    
                EjecutarConsulta($Sql_Detalle) or $Sw = false;
    
                $Num_Elementos=$Num_Elementos+1;
    
               }
    
               return $Sw;

        }       
        
        

        public function Anular ($IdCompra){

            $Sql=" Update Compra set Estado=0 where IdCompra='$IdCompra';";
            
            return EjecutarConsulta($Sql);

        }


        public function Recepcionar ($IdCompra){

            $Sql=" Update Compra set  EstadoCom=1 where IdCompra='$IdCompra';";
            
            return EjecutarConsulta($Sql);

        }

        public function Mostrar($IdCompra){

            $Sql="SELECT * from Compra where IdCompra='$IdCompra'";
            return EjecutarConsultaSImpleFila($Sql);

        }

        public function Listar (){

            $Sql="SELECT C.IdCompra, C.IdUsuario, U.Usuario, C.IdProveedor, P.RazonSocial, C.TipoComprobante, C.SerieCompro, C.NumCompro, C.Fecha, C.Asunto, C.Descripcion, C.EstadoCom, C.Impuesto, C.TotalCompra, C.Estado from Compra C
            inner join Usuario U on U.Idusuario=C.IdUsuario 
            inner join Proveedor P on P.IdProveedor=C.IdProveedor;";
            
            return EjecutarConsulta($Sql);

        }


   



}