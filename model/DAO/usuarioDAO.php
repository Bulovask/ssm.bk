<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/ssm.bk/model/DAO/BDPDO.php";

class UsuarioDAO {
    public static function get_user($user_id, $user_password, $admin = false) {
        try {
            $end = $admin ? " and idFuncaoUsuario = 1;" : " and idFuncaoUsuario != 1;";
            $sql = "SELECT id, idFuncaoUsuario FROM Usuario WHERE 
                (id=:user_id or cpf=:user_id) and senha=:user_password" . $end;
                    
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":user_id", $user_id);
            $p_sql->bindValue(":user_password", $user_password);
            $p_sql->execute();
            return count($p_sql->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Erro ao executar a função de salvar" . $e->getMessage();
        }
    }


}