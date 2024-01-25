<?php

namespace App\Events;

class VerificarMaxCapacidad
{
    public $tablaSessionId;
    public $cantidadEntradas;

    public function __construct($tablaSessionId, $cantidadEntradas)
    {
        $this->tablaSessionId = $tablaSessionId;
        $this->cantidadEntradas = $cantidadEntradas;
    }
}