<?php

require "../Config/Conexion.php";

    Class MPermiso{

        public function __construct(){



        }

        public function Insertar($Nombre){

            $Sql="Insert into Permiso (Nombre,Estado) values('$Nombre',1)";

            return EjecutarConsulta($Sql);

        }       
        
        public function Editar($IdPermiso, $Nombre){

            $Sql=" Update Permiso set Nombre='$Nombre' where IdPermiso='$IdPermiso';";
            
            return EjecutarConsulta($Sql);

        }

        public function Desactivar ($IdPermiso){

            $Sql=" Update Permiso set Estado=0 where IdPermiso='$IdPermiso';";
            
            return EjecutarConsulta($Sql);

        }


        public function Activar ($IdPermiso){

            $Sql=" Update Permiso set  Estado=1 where IdPermiso='$IdPermiso';";
            
            return EjecutarConsulta($Sql);

        }

        public function Mostrar($IdPermiso){

            $Sql="Select * from Permiso where IdPermiso='$IdPermiso'";
            return EjecutarConsultaSImpleFila($Sql);

        }

        public function Listar (){

            $Sql="Select * from Permiso;";
            
            return EjecutarConsulta($Sql);

        }


        public function Select (){

            $Sql="Select * from Permiso where Estado=1;";
            
            return EjecutarConsulta($Sql);

        }



}




?>