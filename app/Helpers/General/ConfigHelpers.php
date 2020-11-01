<?php
namespace App\Helpers\General;

use DB;
use Log;

class ConfigHelpers
{

    public static function log_queries_details()
    {
        DB::listen(function ($query) {
            Log::info("Query: " . $query->sql);
            Log::info("Datos: " . json_encode($query->bindings));
            Log::info("Tiempo Ejecución: " . $query->time);
        });
    }

    public static function log_queries()
    {
        DB::listen(function($query) use(&$total_time){
            Log::info('Query: ' . $query->sql);
        });
    }

    public static function optimizarIndiceTabla($nombre_tabla)
    {
        return DB::statement("OPTIMIZE TABLE $nombre_tabla") and DB::statement("ANALYZE TABLE $nombre_tabla");
    }

//    public static function uploadImage(&$error, $fileField = 'image') {
//        $file = Input::file($fileField);
//
//        // Verifica la existencia del archivo.
//        if (empty($file)) {
//            $error = "Se produjo un error: No se subió ninguna imagen.";
//
//            return false;
//        }
//
//        // Verifica el tamaño minimo.
//        $minWidth = Config::get('settings.min_width_size');
//        $minHeight = Config::get('settings.min_height_size');
//
//        list($w, $h) = getimagesize($file->getRealPath());
//
//        if ($w < $minWidth && $h < $minHeight) {
//            $error = "Se produjo un error: las dimensiones de la imagen no son las correctas (Ancho mínimo: $minWidth px. Alto mínimo: $minHeight px)";
//
//            return false;
//        }
//
//        // Verifica el tipo de archivo.
//        $extensions = Config::get('settings.valid_upload_extension');
//        $extension = $file->getClientOriginalExtension();
//
//        if (!in_array($extension, $extensions)) {
//            $error = "Se produjo un error: Tipo erroneo. Solo se admitén " . implode(', ', $extensions);
//
//            return false;
//        }
//
//        // Verificar tamaño de archivo.
//        $maxSize = Config::get('settings.upload_max_size');
//        $size = $file->getClientSize();
//
//        if ($size > $maxSize)
//        {
//            $mbytes = round(Config::get('settings.upload_max_size') / 1024 /1024);
//            $error = "Se produjo un error: Tamaño máximo permitido $mbytes Mb).";
//
//            return false;
//        }
//
//        // Subir archivo.
//        $filename = $file->getClientOriginalName();
//        $destinationPath = Config::get('settings.upload_folder') . '/' .Config::get('settings.upload_images_folder');
//        $success = Input::file('image')->move($destinationPath, $filename);
//
//        if ($success)
//            return $filename;
//
//        $error = "Se produjo un error: Intente nuevamente";
//        return false;
//    }
//
//    public static function cropImage($image) {
//        $output = ['pathImageCropped' => false];
//
//        if (!empty($image))
//        {
//            $uploadFolder = \Config::get('settings.upload_folder');
//            $imageUploadFolder = \Config::get('settings.upload_images_folder');
//            $pathImage = "$uploadFolder/$imageUploadFolder/$image";
//            $pathImageCropped = str_replace('.', '_CROP.', $pathImage);
//
//            if (file_exists($pathImageCropped)) {
//                $size = getimagesize($pathImage);
//
//                $output['imagenSize'] = $size;
//                $output['pathImage'] = $pathImage;
//                $output['pathImageCropped'] = $pathImageCropped;
//            }
//        }
//
//        return $output;
//    }
}
