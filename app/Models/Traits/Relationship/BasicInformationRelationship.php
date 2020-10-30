<?php

namespace App\Models\Traits\Relationship;


use App\Models\Phone;
use App\Models\Recommendation;

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
        return $this->hasMany(Recommendation::class,'basic_information_id');
    }

}
