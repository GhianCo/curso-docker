<?php 
class Permiso extends PermisoEntity {

    public static function getDistictCategoriasPadre(){
        global $pdo;

        $obj_vector = array();

        $sql = "select distinct	permiso_categoriapadre from permiso ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'PermisoEntity');
        $obj = array();
        while ($obj = $stmt->fetch()) {
            $obj_vector[] = $obj;
        }

        return array("permiso_array" => $obj_vector);
    }
    public static function getDistictCategorias($categoriaPadre){
        global $pdo;

        $obj_vector = array();

        $sql = "select distinct	permiso_categoria from permiso where permiso_categoriapadre='".$categoriaPadre."' and permiso_categoria!='0' ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'PermisoEntity');
        $obj = array();
        while ($obj = $stmt->fetch()) {
            $obj_vector[] = $obj;
        }

        return array("permiso_array" => $obj_vector);
    }
    public static function getPermisosSueltas($categoriaPadre,$usuario_id){
        global $pdo;

        $obj_vector = array();

        $sql = "select p.*,pu.permisousuario_id,pu.permisousuario_estado FROM permiso p left join permisousuario pu  on p.permiso_id=pu.permiso_id and pu.usuario_id='".$usuario_id."' 
		where p.permiso_categoriapadre='".$categoriaPadre."' and p.permiso_categoria='0' ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'PermisoEntity');
        $obj = array();
        while ($obj = $stmt->fetch()) {
            $obj_vector[] = $obj;
        }

        return array("permiso_array" => $obj_vector);
    }
    public static function getPermisosHijas($categoria,$categoriaPadre,$usuario_id){
        global $pdo;

        $obj_vector = array();

        $sql = "select p.*,pu.permisousuario_id,pu.permisousuario_estado FROM permiso p left join permisousuario pu  on p.permiso_id=pu.permiso_id and pu.usuario_id='".$usuario_id."' 
		where p.permiso_categoriapadre='".$categoriaPadre."' and p.permiso_categoria='".$categoria."' ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'PermisoEntity');
        $obj = array();
        while ($obj = $stmt->fetch()) {
            $obj_vector[] = $obj;
        }

        return array("permiso_array" => $obj_vector);
    }

    public static function listarPorBusqueda($busqueda = '',$limit)
    {
        global $pdo;
        $salida_vector = array();

        if ($busqueda == null || $busqueda == "") return $salida_vector;

        $sql = "SELECT * FROM permiso WHERE (permiso_descripcion like :busqueda or permiso_categoria like :busqueda) " . " LIMIT " . $limit ;

        $stmt = $pdo->prepare($sql);
        $busqueda = '%' . $busqueda . '%';
        $stmt->bindParam(':busqueda', $busqueda, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Permiso');
        $salida = array();

        while ($salida = $stmt->fetch()) {
            $salida_vector[] = $salida;
        }

        return array("permiso_array" => $salida_vector);
    }

 }
?>