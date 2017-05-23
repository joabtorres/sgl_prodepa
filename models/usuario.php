<?php

/**
 * A classe 'usuario' é responsável para efetiva comandos sql no banco de dados, como, insert, update, select, delete, count;
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package models
 * @example classe usuario
 */
class usuario extends model {

    /**
     * String $numRows - referente q quantidade de linhas obtidas no select;
     * @access private
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    private $numRows;

    /**
     * Está função tem como objetivo retorna a quantidade de registro encontrados armazenados na variavel $numRows
     * @access public
     * @return int
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function getNumRows() {
        return $this->numRows;
    }

    /**
     * Está função é responsável para cadastrar novos registros;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return boolean 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function create($data) {
        $sql = $this->db->prepare('INSERT INTO sgl_usuario (nome_usuario, sobrenome_usuario, usuario_usuario, email_usuario, senha_usuario, cod_cidade_nucleo, cargo_usuario, sexo_usuario, statu_admin_usuario, img_usuario, statu_usuario) VALUES(:nome, :sobrenome, :usuario, :email, :senha, :nucleo, :cargo, :sexo, :nivel, :imagem, :statu);');
        $sql->bindValue(':nome', $data['nome']);
        $sql->bindValue(':sobrenome', $data['sobrenome']);
        $sql->bindValue(':usuario', $data['usuario']);
        $sql->bindValue(':email', $data['email']);
        $sql->bindValue(':senha', md5(sha1($data['senha'])));
        $sql->bindValue(':nucleo', $data['nucleo']);
        $sql->bindValue(':cargo', $data['cargo']);
        $sql->bindValue(':sexo', $data['sexo']);
        $sql->bindValue(':nivel', $data['nivel']);
        if (!empty($data['imagem'])) {
            $sql->bindValue(':imagem', $this->save_image($data['imagem']));
        } else {
            if ($data['sexo'] == 'M') {
                $sql->bindValue(':imagem', 'uploads/usuarios/user_masculino.png');
            } else {
                $sql->bindValue(':imagem', 'uploads/usuarios/user_feminino.png');
            }
        }
        $sql->bindValue(':statu', 1);
        $sql->execute();
    }

    /**
     * Está função é responsável para consultas no banco e retorna os resultados obtidos;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return array $sql->fetchAll() [caso encontre] | bollean FALSE [caso contrário] 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function read($sql_command, $data) {
        if (!empty($data)) {
            $sql = $this->db->prepare($sql_command);

            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();
        } else {
            $sql = $this->db->query($sql_command);
        }
        if ($sql->rowCount() > 0) {
            $this->numRows = $sql->rowCount();
            return $sql->fetchAll();
        } else {
            $this->numRows = 0;
            return FALSE;
        }
    }

    /**
     * Está função é responsável para consultas no banco e retorna os resultados de um unico registro;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return array $sql->fetchAll() [caso encontre] | bollean FALSE [caso contrário] 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function read_specific($sql_command, $data) {
        if (!empty($data)) {
            $sql = $this->db->prepare($sql_command);

            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();
        } else {
            $sql = $this->db->query($sql_command);
        }
        if ($sql->rowCount() > 0) {
            $this->numRows = $sql->rowCount();
            return $sql->fetch();
        } else {
            $this->numRows = 0;
            return FALSE;
        }
    }

    /**
     * Está função é responsável para altera um registro específico;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return bollean TRUE ou FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function update($data) {
        if (isset($data['senha_usuario']) && !empty($data['senha_usuario'])) {
            $sql = "UPDATE sgl_usuario SET nome_usuario=:nome_usuario, sobrenome_usuario=:sobrenome_usuario, usuario_usuario=:usuario_usuario, senha_usuario=:senha_usuario, cod_cidade_nucleo=:cod_cidade_nucleo, cargo_usuario=:cargo_usuario, sexo_usuario=:sexo_usuario, statu_admin_usuario=:statu_admin_usuario, img_usuario=:img_usuario, statu_usuario=:statu_usuario WHERE cod_usuario=:cod_usuario";
        } else {
            $sql = "UPDATE sgl_usuario SET nome_usuario=:nome_usuario, sobrenome_usuario=:sobrenome_usuario, usuario_usuario=:usuario_usuario, cod_cidade_nucleo=:cod_cidade_nucleo, cargo_usuario=:cargo_usuario, sexo_usuario=:sexo_usuario, statu_admin_usuario=:statu_admin_usuario, img_usuario=:img_usuario, statu_usuario=:statu_usuario WHERE cod_usuario=:cod_usuario";
        }
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':nome_usuario', $data['nome_usuario']);
        $sql->bindValue(':sobrenome_usuario', $data['sobrenome_usuario']);
        $sql->bindValue(':usuario_usuario', $data['usuario_usuario']);
        //verifica se foi setado a nova senha
        if (isset($data['senha_usuario']) && !empty($data['senha_usuario'])) {
            $sql->bindValue(':senha_usuario', md5(sha1($data['senha_usuario'])));
        }
        $sql->bindValue(':cod_cidade_nucleo', $data['cod_cidade_nucleo']);
        $sql->bindValue(':cargo_usuario', $data['cargo_usuario']);
        $sql->bindValue(':sexo_usuario', $data['sexo_usuario']);
        $sql->bindValue(':statu_admin_usuario', $data['statu_admin_usuario']);
        
        //selecionando imagem
        //se ela é um array $_FILE
        if (is_array($data['img_usuario'])) {
            $sql->bindValue(':img_usuario', $this->save_image($data['img_usuario']));
            //se não mudou de foto
        } else if (!isset($data['delete_img']) && !is_array($data['img_usuario'])) {
            $sql->bindValue(':img_usuario', $data['img_usuario']);
            //se mudou para foto padrão
        } else if (isset($data['delete_img'])) {
            $this->delete_image($data['img_usuario']);
            if ($data['sexo_usuario'] == 'M') {
                $sql->bindValue(':img_usuario', 'uploads/usuarios/user_masculino.png');
            } else {
                $sql->bindValue(':img_usuario', 'uploads/usuarios/user_feminino.png');
            }
        }
        $sql->bindValue(':statu_usuario', $data['statu_usuario']);
        $sql->bindValue(':cod_usuario', $data['cod_usuario']);
        $sql->execute();
        
        return $this->read_specific("SELECT * FROM sgl_usuario WHERE cod_usuario=:cod", array('cod' => $data['cod_usuario']));
    }

    /**
     * Está é responsável excluir um registro específico
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return boolean TRUE or FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function delete($sql_command, $data) {
        return false;
    }

    /**
     * Está função é responsável para salva uma imágem no diretório uploads/usuarios/
     * @access public
     * @return boolean TRUE or FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    private function save_image($file) {
        $imagem = array();
        $largura = 140;
        $altura = 140;
        $imagem['temp'] = $file['tmp_name'];
        $imagem['extensao'] = explode(".", $file['name']);
        $imagem['extensao'] = strtolower(end($imagem['extensao']));
        $imagem['name'] = md5(rand(1000, 900000) . time()) . '.' . $imagem['extensao'];
        $imagem['diretorio'] = 'uploads/usuarios';
        if ($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg' || $imagem['extensao'] == 'png') {

            list($larguraOriginal, $alturaOriginal) = getimagesize($imagem['temp']);
            $ratio = $larguraOriginal / $alturaOriginal;
            if ($largura / $altura > $ratio) {
                $largura = $altura * $ratio;
            } else {
                $altura = $largura / $ratio;
            }

            $imagem_final = imagecreatetruecolor($largura, $altura);

            if ($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg') {
                $imagem_original = imagecreatefromjpeg($imagem['temp']);
                imagecopyresampled($imagem_final, $imagem_original, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);
                imagejpeg($imagem_final, $imagem['diretorio'] . "/" . $imagem['name'], 90);
            } else if ($imagem['extensao'] == 'png') {
                $imagem_original = imagecreatefrompng($imagem['temp']);
                imagecopyresampled($imagem_final, $imagem_original, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);
                imagepng($imagem_final, $imagem['diretorio'] . "/" . $imagem['name']);
            }
            return $imagem['diretorio'] . "/" . $imagem['name'];
        } else {
            return null;
        }
    }

    /**
     * Está é responsável excluir uma imagem de usuário;
     * @param String $url_image - diretório do arquivo;
     * @access private
     * @return boolean TRUE or FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    private function delete_image($url_image) {
        if (!($url_image == 'uploads/usuarios/user_masculino.png' || $url_image == "uploads/usuarios/user_feminino.png") && file_exists($url_image)) {
            unlink($url_image);
        }
    }

}
