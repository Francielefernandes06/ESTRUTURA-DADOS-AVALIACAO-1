<?php


// public/index.php
include_once '../src/Models/AlaHospitalar.php';
include_once '../src/Models/ListaTriagem.php';
include_once '../src/Models/Paciente.php';

var_dump($_SERVER['REQUEST_URI']);
    
try {
    // Gerenciamento de Alas
    $ala = new AlaHospitalar(3);
    $paciente1 = new Paciente("Paciente 1");
    $paciente2 = new Paciente("Paciente 2");
    $paciente3 = new Paciente("Paciente 3");

    $ala->alocarPaciente($paciente1);
    $ala->alocarPaciente($paciente2);
    $ala->alocarPaciente($paciente3);

    $ala->listarLeitos();

    $ala->removerPaciente("Paciente 2");
    $ala->listarLeitos();

    // Gerenciamento de Triagem
    $triagem = new ListaTriagem();
    $triagem->adicionarPaciente($paciente1);
    $triagem->adicionarPaciente($paciente3);

    $triagem->listarTriagem();

    $triagem->removerPaciente("Paciente 1");
    $triagem->listarTriagem();
    $triagem->removerPaciente("Paciente 4"); // Deve lançar a exceção
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
