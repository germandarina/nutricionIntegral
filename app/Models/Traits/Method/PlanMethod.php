<?php

namespace App\Models\Traits\Method;

use App\Models\Patient;

/**
 * Trait PlanMethod.
 */
trait PlanMethod
{
    public function getStatusAttribute(){
        return $this->open ? 'Abierto' : 'Cerrado';
    }

    public static function calculateTMBFactorial($data)
    {
        $tmb         = 0;
        $parametro_1 = 0;
        $parametro_2 = 0;
        $gender      = $data['gender'];
        $age         = $data['age'];
        $weight      = $data['weight'];

        switch ($gender)
        {
            case Patient::gender_masc:

                if($age >= 0 && $age <= 2)
                {
                    $parametro_1 = 60.9;
                    $parametro_2 = -54;
                }

                if($age >= 3 && $age <= 9)
                {
                    $parametro_1 = 22.7;
                    $parametro_2 = 495;
                }

                if($age >= 10 && $age <= 17)
                {
                    $parametro_1 = 17.5;
                    $parametro_2 = 651;
                }

                if($age >= 18 && $age <= 29)
                {
                    $parametro_1 = 15.3;
                    $parametro_2 = 679;
                }

                if($age >= 30 && $age <= 60)
                {
                    $parametro_1 = 11.6;
                    $parametro_2 = 879;
                }

                if($age > 60){
                    $parametro_1 = 13.5;
                    $parametro_2 = 487;
                }
                break;
            case Patient::gender_fem:

                if($age >= 0 && $age <= 2)
                {
                    $parametro_1 = 61;
                    $parametro_2 = -51;
                }

                if($age >= 3 && $age <= 9)
                {
                    $parametro_1 = 22.5;
                    $parametro_2 = 499;
                }

                if($age >= 10 && $age <= 17)
                {
                    $parametro_1 = 12.2;
                    $parametro_2 = 746;
                }

                if($age >= 18 && $age <= 29)
                {
                    $parametro_1 = 14.7;
                    $parametro_2 = 496;
                }

                if($age >= 30 && $age <= 60)
                {
                    $parametro_1 = 8.7;
                    $parametro_2 = 829;
                }

                if($age > 60){
                    $parametro_1 = 10.5;
                    $parametro_2 = 596;
                }

                break;
        }

        $tmb = ($parametro_1*$weight) + $parametro_2;
        return $tmb;
    }

    public static function calculateTMBHarrisBenedict($data)
    {
        $tmb = 0;

        if($data['gender'] == Patient::gender_masc)
        {
            $tmb = 88.362 + (13.397 * $data['weight']) + (4.799 * $data['height']) - (5.677 * $data['age']);
        }
        else
        {
            $tmb = 477.593 + (9.247 * $data['weight']) + (3.098 * $data['height']) - (4.33 * $data['age']);
        }

        $result = $tmb * $data['activity'];

        return $result;
    }

    public static function calculateTMBMifflin($data)
    {
        $tmb = 0;

        if($data['gender'] == Patient::gender_masc)
        {
            $tmb = (10 * $data['weight']) + (6.25 * $data['height']) - (5 * $data['age']) + 5;
        }
        else
        {
            $tmb = (10 * $data['weight']) + (6.25 * $data['height']) - (5 * $data['age']) - 161;
        }

        return $tmb;
    }
}
