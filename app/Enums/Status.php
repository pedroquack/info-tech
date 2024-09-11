<?php

namespace App\Enums;

//Define o ENUM de Status da tarefa para facilitar na hora de especificar esses atributos
enum Status: string
{
    case CON = "CONCLUIDO";
    case AND = "EM ANDAMENTO";
}
