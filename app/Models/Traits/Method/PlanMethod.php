<?php

namespace App\Models\Traits\Method;

/**
 * Trait PlanMethod.
 */
trait PlanMethod
{
    public function getStatusAttribute(){
        return $this->open ? 'Abierto' : 'Cerrado';
    }
}
