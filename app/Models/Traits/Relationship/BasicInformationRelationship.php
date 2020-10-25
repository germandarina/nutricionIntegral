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

//    public function plans(){
//        return $this->hasMany(Plan::class,'basic_information_id');
//    }

}
