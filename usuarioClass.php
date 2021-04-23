<?php
require_once ('datosObjectClass.inc.php');

    class Usuario extends DataObject {

        protected $datos = array(
            "nombre" => "", 
            "apellidos"=>"",
            "peso"=>"",
            "altura"=>"",
            "sexo"=>"",
            "password"=>""
            "email"=>"",
            );

        public function __construct( $datos ) {
            foreach ( $datos as $clave => $valor )
            if ( array_key_exists( $clave, $this->datos ) ) $this->datos[$clave] = $valor; 
        }
    
        public static function obtenerUsuarios( $filaInicio, $numeroFilas, $orden ) {
            $conexion = parent::conectar();
            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TABLA_USUARIOS . "
                ORDER BY “ . $orden . “LIMIT :filaInicio, :numeroFilas";
            try {
                $st = $conexion->prepare( $sql );
                $st->bindValue( ":filaInicio", $filaInicio, PDO::PARAM_INT );
                $st->bindValue( ":numeroFilas", $numeroFilas, PDO::PARAM_INT );
                $st->execute();
                $usuarios = array();
                foreach ( $st->fetchAll() as $fila ) {
                $usuario[] = new Usuario( $fila );
                }
                $st = $conexion->query( "SELECT found_rows() AS filasTotales" );
                $fila = $st->fetch();
                parent::desconectar( $conexion );
                return array( $frutas, $fila["filasTotales"] );
            } catch ( PDOException $e ) {
                parent::desconectar( $conexion );
                die( "Consulta fallida: " . $e->getMessage() );
            }
        }

        public static function obtenerUsuario( $nombre ) {
            $conexion = parent::conectar();
            $sql = "SELECT * FROM " . TABLA_USUARIO . " WHERE nombre = :nombre";
            try {
                $st = $conexion->prepare( $sql );
                $st->bindValue( ":nombre", $id, PDO::PARAM_VARCHAR );//PUEDE DAR FALLO
                $st->execute();
                $fila = $st->fetch();
                parent::desconectar( $conexion );
                if ( $fila ) return new Fruta( $fila );
            } catch ( PDOException $e ) {
                parent::desconectar( $conexion );
                die( "Consulta fallada: " . $e->getMessage() );
            }
        }

        public static function insertarUsuario()
        {  
            $conexion = parent::conectar();
            $sql = "INSERT INTO " . TABLA_USUARIO . " VALUES('". $this->datos[nombre] ."','" .$this->datos[apellidos]. 
            "','". $this->datos[peso] ."','". $this->datos[altura] ."','". $this->datos[sexo] ."','". $this->datos[password].
            "','". $this->datos[email]."')";
            try {
                $st = $conexion->prepare( $sql );
                $st->bindValue( ":nombre", $id, PDO::PARAM_VARCHAR );//PUEDE DAR FALLO
                $st->execute();
                $fila = $st->fetch();
                parent::desconectar( $conexion );
                if ( $fila ) return new Usuario( $fila );
            } catch ( PDOException $e ) {
                parent::desconectar( $conexion );
                die( "Consulta fallada: " . $e->getMessage() );
            }
        }

?>
