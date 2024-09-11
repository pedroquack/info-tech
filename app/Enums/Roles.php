<?php

namespace App\Enums;

//Define o ENUM de Cargos de usuário para facilitar na hora de especificar esses atributos
enum Roles: string
{
    case ADM = "ADMIN";
    case CLI = "CLIENTE";
}
