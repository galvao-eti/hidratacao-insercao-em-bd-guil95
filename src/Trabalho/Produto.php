<?php

namespace Trabalho;

/**
 * Description of Produto
 *
 * @author Guilherme
 */
class Produto {

    private $nome;
    private $valor;

    function getNome() {
        return $this->nome;
    }

    function getValor() {
        return $this->valor;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setValor($valor) {
        if ($valor < 1) {
            throw new \Exception("Valor deve ser maior ou igual a 1");
            return;
        }
        $this->valor = $valor;
    }

    use Traits\Hidratacao;

    public function saveBd(\PDO $conn) {
        $nome = $this->getNome();
        $valor = $this->getValor();
        try {
            $sql = "Insert into tbproduto (nome, valor) values (:nome, :valor)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":valor", $valor);
            $stmt->execute();
        } catch (\Exception $ex) {
            die("<pre>" . __FILE__ . " - " . __LINE__ . "\n" . print_r($ex, true) . "</pre>");
        }
    }

}
