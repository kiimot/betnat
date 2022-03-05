<?php

class Futbol extends EventoDeportivo{

    protected $logoEquipoLocal;
    protected $logoEquipoVisitante;
    protected $cuotaEquipoLocal;
    protected $cuotaEquipoVisitante;
    protected $cuotaEmpate;

    public function __construct($codigoEvento,$tipoEvento,$fechaEvento,$nombreEquipoLocal,$nombreEquipoVisitante,$logoEquipoLocal,$logoEquipoVisitante,$cuotaEquipoLocal,$cuotaEquipoVisitante,$cuotaEmpate){
        Parent::__construct($codigoEvento,$tipoEvento,$fechaEvento,$nombreEquipoLocal,$nombreEquipoVisitante);
        $this->logoEquipoLocal= $logoEquipoLocal;
        $this->logoEquipoVisitante = $logoEquipoVisitante;
        $this->cuotaEquipoLocal= $cuotaEquipoLocal;
        $this->cuotaEquipoVisitante = $cuotaEquipoVisitante;
        $this->cuotaEmpate= $cuotaEmpate;
    }

    public function calcularCuotaCombinada($cuotaFutbol){
        $suplemento = $cuotaFutbol / 10;
        $cuotaFutbolComb = $cuotaFutbol + $suplemento;
        return $cuotaFutbolComb;
    }

    /**
     * Get the value of cuotaEmpate
     */
    public function getCuotaEmpate()
    {
        return $this->cuotaEmpate;
    }

    /**
     * Set the value of cuotaEmpate
     */
    public function setCuotaEmpate($cuotaEmpate): self
    {
        $this->cuotaEmpate = $cuotaEmpate;

        return $this;
    } 

    /**
     * Get the value of cuotaEquipoVisitante
     */
    public function getCuotaEquipoVisitante()
    {
        return $this->cuotaEquipoVisitante;
    }

    /**
     * Set the value of cuotaEquipoVisitante
     */
    public function setCuotaEquipoVisitante($cuotaEquipoVisitante): self
    {
        $this->cuotaEquipoVisitante = $cuotaEquipoVisitante;

        return $this;
    } 

    /**
     * Get the value of cuotaEquipoLocal
     */
    public function getCuotaEquipoLocal()
    {
        return $this->cuotaEquipoLocal;
    }

    /**
     * Set the value of cuotaEquipoLocal
     */
    public function setCuotaEquipoLocal($cuotaEquipoLocal): self
    {
        $this->cuotaEquipoLocal = $cuotaEquipoLocal;

        return $this;
    } 

    /**
     * Get the value of logoEquipoVisitante
     */
    public function getLogoEquipoVisitante()
    {
        return $this->logoEquipoVisitante;
    }

    /**
     * Set the value of logoEquipoVisitante
     */
    public function setLogoEquipoVisitante($logoEquipoVisitante): self
    {
        $this->logoEquipoVisitante = $logoEquipoVisitante;

        return $this;
    } 

    /**
     * Get the value of logoEquipoLocal
     */
    public function getLogoEquipoLocal()
    {
        return $this->logoEquipoLocal;
    }

    /**
     * Set the value of logoEquipoLocal
     */
    public function setLogoEquipoLocal($logoEquipoLocal): self
    {
        $this->logoEquipoLocal = $logoEquipoLocal;

        return $this;
    }  


}


?>