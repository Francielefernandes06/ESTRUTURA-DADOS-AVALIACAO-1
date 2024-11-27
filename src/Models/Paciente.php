<?php
// src/Models/Paciente.php
class Paciente {
    public string $nome;

    public function __construct(string $nome) {
        $this->nome = $nome;
    }
}
