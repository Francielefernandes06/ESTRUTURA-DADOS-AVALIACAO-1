<?php

class QuantidadeMinimaInvalidaException extends Exception {}
class LeitoCheioException extends Exception {}
class PacienteNaoEncontradoException extends Exception {}

class AlaHospitalar {
    private string $nome;
    private int $capacidade;
    private array $leitos;

    public function __construct(string $nome, int $capacidade) {
        if ($capacidade < 1) {
            throw new QuantidadeMinimaInvalidaException("A quantidade mínima de leitos deve ser 1 ou mais.");
        }
        $this->nome = $nome;
        $this->capacidade = $capacidade;
        $this->leitos = array_fill(0, $capacidade, null); // Inicializa com leitos vazios (null)
    }

    public function alocarPaciente(string $paciente): void {
        foreach ($this->leitos as $indice => $ocupante) {
            if ($ocupante === null) {
                $this->leitos[$indice] = $paciente;
                echo "Paciente '$paciente' alocado no leito $indice na ala '{$this->nome}'.\n";
                return;
            }
        }
        throw new LeitoCheioException("Todos os leitos da ala '{$this->nome}' estão ocupados.");
    }

    public function removerPaciente(string $paciente): void {
        foreach ($this->leitos as $indice => $ocupante) {
            if ($ocupante === $paciente) {
                $this->leitos[$indice] = null;
                echo "Paciente '$paciente' removido do leito $indice na ala '{$this->nome}'.\n";
                return;
            }
        }
        throw new PacienteNaoEncontradoException("Paciente '$paciente' não encontrado na ala '{$this->nome}'.");
    }

    public function listarLeitos(): void {
        foreach ($this->leitos as $indice => $ocupante) {
            $status = $ocupante === null ? "vazio" : "ocupado por $ocupante";
            echo "Leito $indice: $status\n";
        }
    }
}

// Exemplo de uso:
try {
    $ala = new AlaHospitalar("Ala 1", 3); // Define a ala com 3 leitos
    $ala->alocarPaciente("Paciente 1");
    $ala->alocarPaciente("Paciente 2");
    $ala->listarLeitos();
    $ala->removerPaciente("Paciente 1");
    $ala->listarLeitos();
    $ala->alocarPaciente("Paciente 3");
    $ala->alocarPaciente("Paciente 4"); // Lançará LeitoCheioException
} catch (QuantidadeMinimaInvalidaException $e) {
    echo "Erro: " . $e->getMessage() . "\n";
} catch (LeitoCheioException $e) {
    echo "Erro: " . $e->getMessage() . "\n";
} catch (PacienteNaoEncontradoException $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
