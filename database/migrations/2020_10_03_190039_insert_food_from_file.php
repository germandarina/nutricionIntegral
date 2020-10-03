<?php

use App\Models\Food;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertFoodFromFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        set_time_limit(-1);

        $file_path_nomencladores    = storage_path() . '/documentos/alimentos_sara_completo.csv';
        $file_alimentos         = fopen($file_path_nomencladores, "r");

        $contador = 0;
        while (($fila = fgetcsv($file_alimentos, 0, ";")) !== false) {
            if ($contador == 0) {
                $contador++;
                continue;
            }

            if ($contador > 447 || $fila[0] == "") {
                break;
            }

            $alimento                   = new Food();
            $alimento->food_group_id    = $fila[0];
            $alimento->name             = trim($fila[1]);
            $alimento->agua             = $this->evaluarValor($fila[2]);
            $alimento->energia_kcal     = $this->evaluarValor($fila[3]);
            $alimento->proteina         = $this->evaluarValor($fila[4]);
            $alimento->grasa_total      = $this->evaluarValor($fila[5]);
            $alimento->ac_grasos_saturados          = $this->evaluarValor($fila[6]);
            $alimento->ac_grasos_monoinsaturados    = $this->evaluarValor($fila[7]);
            $alimento->ac_grasos_poliinsaturados    = $this->evaluarValor($fila[8]);
            $alimento->colesterol                   = $this->evaluarValor($fila[9]);
            $alimento->carbohidratos_totales        = $this->evaluarValor($fila[10]);
            $alimento->fibra                        = $this->evaluarValor($fila[11]);
            $alimento->cenizas                  = $this->evaluarValor($fila[12]);
            $alimento->sodio                    = $this->evaluarValor($fila[13]);
            $alimento->potasio                  = $this->evaluarValor($fila[14]);
            $alimento->calcio                   = $this->evaluarValor($fila[15]);
            $alimento->fosforo                  = $this->evaluarValor($fila[16]);
            $alimento->hierro                   = $this->evaluarValor($fila[17]);
            $alimento->zinc                     = $this->evaluarValor($fila[18]);
            $alimento->niacina                  = $this->evaluarValor($fila[19]);
            $alimento->tiamina                  = $this->evaluarValor(0);
            $alimento->riboflavina              = $this->evaluarValor($fila[23]);
            $alimento->vitamina_c                   = $this->evaluarValor($fila[25]);
            $alimento->carbohidratos_disponibles    = $this->evaluarValor(0);

            if(!$alimento->save()){
                throw new \Exception("Error al importar alimento ".$fila[1]);
            }


            $contador++;
        }
        fclose($file_alimentos);
    }

    private function evaluarValor($valor){
        return empty($valor) ? 0 : (float) str_replace(',','.',$valor);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('delete from foods;');
    }
}
