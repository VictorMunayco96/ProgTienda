<?php

require "../Config/Conexion.php";

    Class MPedido{

        public function __construct(){



        }

        public function Insertar($CantidadBatch, $Observacion, $CantidadKG, $IdUsuario, $NumSemana, $IdPedidoSemanal, $TipoTransporte){

         
           
            $Sql="Insert into Pedido (CantidadBatch, Observacion, Fecha, Estado, CantidadKG, IdUsuario, NumSemana, EstadoP, IdPedidoSemanal,TipoTransporte) 
            values('$CantidadBatch','$Observacion',(select now()),1,'$CantidadKG','$IdUsuario','$NumSemana',0,'$IdPedidoSemanal','$TipoTransporte');";

            return EjecutarConsulta($Sql);

        }       
        
        public function Editar($IdPedido, $CantidadBatch, $Observacion, $CantidadKG, $IdUsuario, $NumSemana, $IdPedidoSemanal, $TipoTransporte){

            $Sql=" Update Pedido set CantidadBatch='$CantidadBatch', Observacion='$Observacion', Fecha=(Select now()),CantidadKG='$CantidadKG', IdUsuario='$IdUsuario',NumSemana='$NumSemana',EstadoP=0,IdPedidoSemanal='$IdPedidoSemanal', TipoTransporte='$TipoTransporte' 
             where IdPedido='$IdPedido';";
            
            return EjecutarConsulta($Sql);

        }

        public function Desactivar ($IdPedido){

            $Sql=" Update Pedido set Estado=0 where IdPedido='$IdPedido';";
            
            return EjecutarConsulta($Sql);

        }


        public function Activar ($IdPedido){

            $Sql=" Update Pedido set Estado=1 where IdPedido='$IdPedido';";
            
            return EjecutarConsulta($Sql);

        }

        public function Aceptar ($IdPedido){

            $Sql=" Update Pedido set EstadoP=1 where IdPedido='$IdPedido';";
            
            return EjecutarConsulta($Sql);

        }

        public function Rechazar ($IdPedido){

            $Sql=" Update Pedido set EstadoP=0 where IdPedido='$IdPedido';";
            
            return EjecutarConsulta($Sql);

        }

        public function Mostrar($IdPedido){

            $Sql="Select * from Pedido
            where IdPedido='$IdPedido'";
            return EjecutarConsultaSImpleFila($Sql);

        }

        public function ListarPedidoSemanal ($IdCabeceraPedido, $NumSemana){

        

            $Sql="SELECT PS.IdPedidoSemanal,DD.DestinoDes, DB.DestinoBloq ,DP.DescProd, PS.CantidadBatch, PS.CantidadKG, 
            ifnull((Select sum(VA.CantidadBatch) from Variaciones VA 
           
           where VA.EstadoVA=1 and VA.Estado=1 and VA.IdPedidoSemanal=PS.IdPedidoSemanal and PS.NumSemana=$NumSemana),0) as CantidadVA,
           
           ifnull((ifnull((PS.CantidadBatch),0) +  ifnull((Select sum(VA.CantidadBatch) from Variaciones VA 
           
           where VA.EstadoVA=1 and VA.Estado=1 and VA.IdPedidoSemanal=PS.IdPedidoSEmanal and PS.NumSemana=$NumSemana),0)),0) as TotalFinal,

           ifnull((Select sum(P.CantidadBatch) from Pedido P 
                       
                       where P.EstadoP=1 and P.Estado=1 and P.IdPedidoSEmanal=PS.IdPedidoSemanal and P.NumSemana=$NumSemana),0) as Avance,
           
           PS.Observacion, PS.Fecha, 
           (Select count(P.EstadoP) from Pedido P 
                       
                       where P.EstadoP=0 and P.Estado=1 and P.IdPedidoSEmanal=PS.IdPedidoSemanal and P.NumSemana=$NumSemana) as Pendiente, 
           U.Usuario,PS.Estado from PedidoSemanal PS 
                       inner join Usuario U on U.IdUsuario=PS.IdUsuario
                       inner join DescProd DP on DP.IdDescProd=PS.IdDescProd
                       inner join CabeceraPedido CP on CP.IdCabeceraPedido=PS.IdCabeceraPedido
                       inner join DestinoBloq DB on DB.IdDestinoBloq=PS.IdDestinoBloq
                       inner join DestinoDesc DD on DD.IdDestinoDesc=CP.IdDestinoDesc where PS.NumSemana=$NumSemana and PS.IdCabeceraPedido=$IdCabeceraPedido;";


            return EjecutarConsulta($Sql);

        }

        public function ListarCabeceraPedido($NumSemana){

            
            $Sql=" SELECT
            CP.IdCabeceraPedido, 
            CP.IdDestinoDesc, 
            DD.DestinoDes,
            CP.OrdenEnvio, 
            CP.Estado,
            ifnull((ifnull((Select Sum(PS.CantidadBatch) from PedidoSemanal PS where PS.EstadoPS=1 and PS.Estado=1 and PS.IdCabeceraPedido=CP.IdCabeceraPedido and PS.NumSemana=$NumSemana),0) +  ifnull((Select sum(VA.CantidadBatch) from Variaciones VA 
            inner join PedidoSemanal PS on PS.IdPedidoSemanal=VA.IdPedidoSemanal
            where VA.EstadoVA=1 and VA.Estado=1 and PS.IdCabeceraPedido=CP.IdCabeceraPedido and PS.NumSemana=$NumSemana),0)),0) as TotalMezclas,
            
            (Select count(P.IdPedido) from Pedido P inner join PedidoSemanal PS on PS.IdPedidoSemanal=P.IdPedidoSemanal 
             where PS.IdCabeceraPedido=CP.IDCabeceraPedido and P.NumSemana=$NumSemana and P.Estado=1 and P.EstadoP=0) as Pendiente,
            
            ifnull((Select sum(P.CantidadBatch) from Pedido P inner join PedidoSemanal PS on PS.IdPedidoSemanal=P.IdPedidoSemanal 
             where PS.IdCabeceraPedido=CP.IDCabeceraPedido and P.NumSemana=$NumSemana and P.Estado=1 and P.EstadoP=1),0) as CanPed  
             
                        from CabeceraPedido CP
                        inner join DestinoDesc DD on DD.IdDestinoDesc=CP.IdDestinoDesc;  ";
            
            return EjecutarConsulta($Sql);

        }


        public function ListarPedido($IdPedidoSemanal){

            
            $Sql="    SELECT P.IdPedido,DD.DestinoDes,DB.DestinoBloq ,P.CantidadBatch, P.Observacion, P.Fecha,  P.Estado, P.CantidadKG, U.Usuario, P.NumSemana, P.EstadoP,DP.DescProd ,P.IdPedidoSemanal, P.TipoTransporte from Pedido P 
 inner join Usuario U on U.IdUsuario=P.IdUsuario
 inner join PedidoSemanal PS on PS.IdPedidoSemanal=P.IdPedidoSemanal
 inner join DestinoBloq DB on DB.IdDestinoBloq=PS.IdDestinoBloq
 inner join DestinoDesc DD on DD.IdDestinoDesc=DB.IdDestinoDesc
            inner join DescProd DP on DP.IdDescProd=PS.IdDescProd where P.IdPedidoSemanal=$IdPedidoSemanal; ";
            
            return EjecutarConsulta($Sql);

        }




        public function Select (){

            $Sql="Select * from DestinoDesc where Estado=1;";
            
            return EjecutarConsulta($Sql);

        }


}
