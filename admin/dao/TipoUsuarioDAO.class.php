<?php

class TipoUsuarioDAO {

	public function __construct() {
        $this->conexao = Conexao::getConexao();
    }

    public function buscarPorID($tipoUsuarioID) {
        try {

            $row = $this->conexao->query("SELECT * FROM tipo_usuario tu WHERE id_tipo_usuario = $tipoUsuarioID ")->fetch(PDO::FETCH_SERIALIZE);

            if (isset ($row['id_tipo_usuario']) && $row['id_tipo_usuario'] > 0) {
                $tipoUsuario = new TipoUsuarioBean($row['id_tipo_usuario'], $row['tipo']);
                return $tipoUsuario;
            } else {
                return null;
            }
        } catch (PDOException $err) {
            throw new Exception("Erro TipoUsuarioDAO:" . $err->getMessage());
        }
    }

 	private function getWhere($tipoUsuarioID) {

        $where = " WHERE 1 = 1 ";

    	if (isset($login) ) {
            $where = $where . " AND tu.id_tipo_usuario like '%$tipoUsuarioID%' ";
        }
        
        return $where;
    }
}

?>