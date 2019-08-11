<?php

namespace App\Models\Traits\Method;

/**
 * Trait EmployeeMethod.
 */
trait EmployeeMethod
{
    /**
     * @return bool
     */
    public function isPending()
    {
        return config('access.users.requires_approval') && ! $this->confirmed;
    }
}
