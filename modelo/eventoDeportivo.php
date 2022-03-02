<?php

include 'futbol.php';
include 'basquet.php';
include 'tenis.php';
abstract class EventoDeportivo{

    protected $codigoEvento;
    protected $tipoEvento;
    protected $fechaEvento;
    protected $nombreEquipoLocal;
    protected $nombreEquipoVisitante;


    public function __construct($codigoEvento,$tipoEvento,$fechaEvento,$nombreEquipoLocal,$nombreEquipoVisitante){
        $this->codigoEvento = $codigoEvento;
        $this->tipoEvento = $tipoEvento;
        $this->fechaEvento = $fechaEvento;
        $this->nombreEquipoLocal = $nombreEquipoLocal;
        $this->nombreEquipoVisitante = $nombreEquipoVisitante;
    }

    public abstract function calcularCuotaCombinada();

    /**
     * Get the value of nombreEquipoVisitante
     */
    public function getNombreEquipoVisitante()
    {
        return $this->nombreEquipoVisitante;
    }

    /**
     * Set the value of nombreEquipoVisitante
     */
    public function setNombreEquipoVisitante($nombreEquipoVisitante): self
    {
        $this->nombreEquipoVisitante = $nombreEquipoVisitante;

        return $this;
    }  

    /**
     * Get the value of nombreEquipoLocal
     */
    public function getNombreEquipoLocal()
    {
        return $this->nombreEquipoLocal;
    }

    /**
     * Set the value of nombreEquipoLocal
     */
    public function setNombreEquipoLocal($nombreEquipoLocal): self
    {
        $this->nombreEquipoLocal = $nombreEquipoLocal;

        return $this;
    }  

    /**
     * Get the value of fechaEvento
     */
    public function getFechaEvento()
    {
        return $this->fechaEvento;
    }

    /**
     * Set the value of fechaEvento
     */
    public function setFechaEvento($fechaEvento): self
    {
        $this->fechaEvento = $fechaEvento;

        return $this;
    }

    /**
     * Get the value of codigoEvento
     */
    public function getCodigoEvento()
    {
        return $this->codigoEvento;
    }

    /**
     * Set the value of codigoEvento
     */
    public function setCodigoEvento($codigoEvento): self
    {
        $this->codigoEvento = $codigoEvento;

        return $this;
    }

    /**
     * Get the value of tipoEvento
     */
    public function getTipoEvento()
    {
        return $this->tipoEvento;
    }

    /**
     * Set the value of tipoEvento
     */
    public function setTipoEvento($tipoEvento): self
    {
        $this->tipoEvento = $tipoEvento;

        return $this;
    }

    

}



?>