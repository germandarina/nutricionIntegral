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

    public function recommendations(){
        return $this->hasMany(Recommendation::class,'basic_information_id');
    }

    public function textRecommendations(){
        return $this->hasMany(Recommendation::class,'basic_information_id')
            ->where('type',Recommendation::type_text);
    }

    public function imageRecommendations(){
        return $this->hasMany(Recommendation::class,'basic_information_id')
            ->where('type',Recommendation::type_img);
    }

}
