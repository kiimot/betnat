<?php

class Tenis extends EventoDeportivo{

    protected $nacionalidadEquipoLocal;
    protected $nacionalidadEquipoVisitante;
    protected $cuotaEquipoLocal;
    protected $cuotaEquipoVisitante;

    public function __construct($codigoEvento,$tipoEvento,$fechaEvento,$nombreEquipoLocal,$nombreEquipoVisitante,$nacionalidadEquipoLocal,$nacionalidadEquipoVisitante,$cuotaEquipoLocal,$cuotaEquipoVisitante){
        Parent::__construct($codigoEvento,$tipoEvento,$fechaEvento,$nombreEquipoLocal,$nombreEquipoVisitante);
        $this->nacionalidadEquipoLocal= $nacionalidadEquipoLocal;
        $this->nacionalidadEquipoVisitante = $nacionalidadEquipoVisitante;
        $this->cuotaEquipoLocal= $cuotaEquipoLocal;
        $this->cuotaEquipoVisitante = $cuotaEquipoVisitante;
    }

    public function calcularCuotaCombinada(){
        $this->cuotaEquipoLocal += 5;  
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
     * Get the value of nacionalidadEquipoVisitante
     */
    public function getNacionalidadEquipoVisitante()
    {
        return $this->nacionalidadEquipoVisitante;
    }

    /**
     * Set the value of nacionalidadEquipoVisitante
     */
    public function setNacionalidadEquipoVisitante($nacionalidadEquipoVisitante): self
    {
        $this->nacionalidadEquipoVisitante = $nacionalidadEquipoVisitante;

        return $this;
    } 

    /**
     * Get the value of nacionalidadEquipoLocal
     */
    public function getNacionalidadEquipoLocal()
    {
        return $this->nacionalidadEquipoLocal;
    }

    /**
     * Set the value of nacionalidadEquipoLocal
     */
    public function setNacionalidadEquipoLocal($nacionalidadEquipoLocal): self
    {
        $this->nacionalidadEquipoLocal = $nacionalidadEquipoLocal;

        return $this;
    }  


}


?>