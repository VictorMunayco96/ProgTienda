<?php

require "../Config/Conexion.php";

    Class MUsuario{

        public function __construct(){



        }

        public function Insertar( $IdPersonal, $Usuario, $Contraseña, $TipoUsuario,$Permiso){

            $Sql="Insert into Usuario ( IdPersonal, Usuario, Contraseña, TipoUsuario,Estado) values('$IdPersonal', '$Usuario', '$Contraseña', '$TipoUsuario',1)";

           // return EjecutarConsulta($Sql);
           $IdUsuarioNew=EjecutarConsulta_RetornarID($Sql);

           $Num_Elementos=0;

           $Sw=true;

           while($Num_Elementos< count($Permiso)){

            $Sql_Detalle = "Insert into DetallePermiso(IdUsuario, IdPermiso) values ('$IdUsuarioNew','$Permiso[$Num_Elementos]')";

            EjecutarConsulta($Sql_Detalle) or $Sw = false;

            $Num_Elementos=$Num_Elementos+1;

           }

           return $Sw;

        }       
        
        public function Editar($IdUsuario, $IdPersonal, $Usuario, $Contraseña, $TipoUsuario){

            $Sql="Update Usuario set IdPersonal='$IdPersonal', Usuario='$Usuario', Contraseña='$Contraseña', TipoUsuario='$TipoUsuario' where IdUsuario='$IdUsuario';";
            
            return EjecutarConsulta($Sql);

            //ELIMINAR TODOS REGISTROS ASIGNADOS
            $SqlDel="delete from DetallePermiso where IdUsuario='$IdUsuario'";

            EjecutarConsulta($SqlDel);

            //INGRESAR PERMISOS

            $Num_Elementos=0;

            $Sw=true;
 
            while($Num_Elementos< count($Permiso)){
 
             $Sql_Detalle = "Insert into DetallePermiso(IdUsuario, IdPermiso) values ('$IdUsuario','$Permiso[$Num_Elementos]')";
 
             EjecutarConsulta($Sql_Detalle) or $Sw = false;
 
             $Num_Elementos=$Num_Elementos+1;
 
            }
 
            return $Sw;


        }

        public function Desactivar ($IdUsuario){

            $Sql=" Update Usuario set Estado=0 where IdUsuario='$IdUsuario';";
            
            return EjecutarConsulta($Sql);

        }


        public function Activar ($IdUsuario){

            $Sql=" Update Usuario set  Estado=1 where IdUsuario='$IdUsuario';";
            
            return EjecutarConsulta($Sql);

        }

        public function Mostrar($IdUsuario){

            $Sql="Select * from Usuario where IdUsuario='$IdUsuario'";
            return EjecutarConsultaSImpleFila($Sql);

        }

        public function Listar (){

            $Sql="Select U.IdUsuario, U.Usuario, U.Contrasena, U.TipoUsuario,P.Nombre,P.Apellido, U.Estado from Usuario U
            inner join Personal P on U.IdPersonal=P.IdPersonal";
            
            return EjecutarConsulta($Sql);

        }


        public function ListarMarcados($IdUsuario){

            $Sql="Select * from UsuarioPermiso where IdUsuario='$IdUsuario'";
            return EjecutarConsulta($Sql);
    
            }


                    //Función para verificar el acceso al sistema
    public function verificar($login,$clave)
    {
        $sql="Select U.IdUsuario, U.Usuario, U.Contrasena, U.TipoUsuario,U.IdPersonal,P.Nombre,P.Apellido,U.Estado from Usuario U
        inner join Personal P on U.IdPersonal=P.IdPersonal WHERE U.Usuario='$login' AND U.Contrasena='$clave' AND U.Estado='1'"; 
        return ejecutarConsulta($sql);  
    }



}