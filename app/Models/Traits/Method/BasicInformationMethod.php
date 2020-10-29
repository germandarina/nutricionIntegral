<?php

namespace App\Models\Traits\Method;

/**
 * Trait BasicInformationMethod.
 */
trait BasicInformationMethod
{
    public function getPhonesFrontAttribute()
    {
        if(!$this->phones)
            $this->load('phones');

        $full_phones = "";
        foreach ($this->phones as $phone){
            $full_phones .= "({$phone->code_area}) - {$phone->phone}  / ";
        }

        return trim($full_phones,' / ');
    }
}
