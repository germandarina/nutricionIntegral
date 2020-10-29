<?php

namespace App\Models\Traits\Relationship;


use App\Models\Phone;

/**
 * Class BasicInformationRelationship.
 */
trait BasicInformationRelationship
{
    public function phones()
    {
        return $this->hasMany(Phone::class,'basic_information_id');
    }

    public function recomendations(){
        return $this->hasMany(Phone::class,'basic_information_id');
    }

}
