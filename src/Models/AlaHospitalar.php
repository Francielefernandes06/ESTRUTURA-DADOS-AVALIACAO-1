<?php
// src/Models/AlaHospitalar.php

class AlaHospitalar {
    private array $leitos;

    public function __construct(int $capacidade) {
        if ($capacidade < 1) {
            throw new QuantidadeMinimaInvalidaException("A quantidade mínima de leitos deve ser maior que zero.");
        }
        $this->leitos = array_fill(0, $capacidade, null);
    }

    // Aloca um paciente em um leito disponível
    public function alocarPaciente(Paciente $paciente): void {
        foreach ($this->leitos as $indice => $leito) {
            if ($leito === null) {
                $this->leitos[$indice] = $paciente;
                echo "Paciente '{$paciente->nome}' alocado no leito {$indice}.\n";
                return;
            }
        }
        throw new LeitoCheioException("Todos os leitos estão ocupados.");
    }

    // Remove um paciente de um leito
    public function removerPaciente(string $nomePaciente): void {
        foreach ($this->leitos as $indice => $leito) {
            if ($leito !== null && $leito->nome === $nomePaciente) {
                $this->leitos[$indice] = null;
                echo "Paciente '{$nomePaciente}' removido do leito {$indice}.\n";
                return;
            }
        }
        throw new PacienteNaoEncontradoException("Paciente '{$nomePaciente}' não encontrado na ala.");
    }

    public function listarLeitos(): void {
        foreach ($this->leitos as $indice => $leito) {
            echo "Leito {$indice}: " . ($leito ? $leito->nome : "Vazio") . "\n";
        }
    }
}
