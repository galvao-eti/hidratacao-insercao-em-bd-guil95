<?php

namespace Trabalho;

/**
 * Description of Usuario
 *
 * @author Guilherme
 */
class Usuario {

    private $email;
    private $senha;

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        if (strlen($senha) < 6) {
            throw new \Exception("Senha deve ter no mínimo 6 digitos");
            return;
        }
        $this->senha = $senha;
    }

    use Traits\Hidratacao;

    public function saveBd(\PDO $conn) {
        $email = $this->getEmail();
        $senha = $this->getSenha();
        try {
            $sql = "Insert into tbusuario (email, senha) values (:email, :senha)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $senha);
            $stmt->execute();
        } catch (Exception $ex) {
            die("<pre>" . __FILE__ . " - " . __LINE__ . "\n" . print_r($ex, true) . "</pre>");
        }
    }

}
