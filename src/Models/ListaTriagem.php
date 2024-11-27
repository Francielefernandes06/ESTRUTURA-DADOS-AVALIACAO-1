<?php
// src/Models/ListaTriagem.php
class No {
    public Paciente $paciente;
    public ?No $proximo;
    public ?No $anterior;

    public function __construct(Paciente $paciente) {
        $this->paciente = $paciente;
        $this->proximo = null;
        $this->anterior = null;
    }
}

class ListaTriagem {
    private ?No $inicio;
    private ?No $fim;

    public function __construct() {
        $this->inicio = null;
        $this->fim = null;
    }

    // Adiciona um paciente ao final da lista de triagem
    public function adicionarPaciente(Paciente $paciente): void {
        $novoNo = new No($paciente);

        if ($this->inicio === null) {
            $this->inicio = $novoNo;
            $this->fim = $novoNo;
        } else {
            $this->fim->proximo = $novoNo;
            $novoNo->anterior = $this->fim;
            $this->fim = $novoNo;
        }
        echo "Paciente '{$paciente->nome}' adicionado à triagem.\n";
    }

    // Remove um paciente específico da triagem
    public function removerPaciente(string $nomePaciente): void {
        $atual = $this->inicio;

        while ($atual !== null) {
            if ($atual->paciente->nome === $nomePaciente) {
                if ($atual->anterior !== null) {
                    $atual->anterior->proximo = $atual->proximo;
                } else {
                    $this->inicio = $atual->proximo;
                }

                if ($atual->proximo !== null) {
                    $atual->proximo->anterior = $atual->anterior;
                } else {
                    $this->fim = $atual->anterior;
                }

                echo "Paciente '{$nomePaciente}' removido da triagem.\n";
                return;
            }
            $atual = $atual->proximo;
        }
        var_dump($nomePaciente);
        //throw new PacienteNaoEncontradoException("Paciente '{$nomePaciente}' não encontrado na triagem.");
    }

    public function listarTriagem(): void {
        $atual = $this->inicio;
        if ($atual === null) {
            echo "A triagem está vazia.\n";
            return;
        }

        echo "Lista de triagem:\n";
        while ($atual !== null) {
            echo "- " . $atual->paciente->nome . "\n";
            $atual = $atual->proximo;
        }
    }
}
