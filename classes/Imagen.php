<?php

class Imagen{

    /**
     * Sube una imagen 
     */
    public function verImagen($directorio,$datosArchivo):string{


          //le damos un nuevo nombre
          $og_name = (explode(".", $datosArchivo['name']));
          $extension = end($og_name);
          $filename = time() . ".$extension";
  
          $fileUpload = move_uploaded_file($datosArchivo['tmp_name'], "$directorio/$filename");
  
          if (!$fileUpload) {
              throw new Exception("No se pudo subir la imagen");
          } else {
              return $filename;
          }
    }



    /**
     * Borra la imagen
     * @param string
     */
    public function borrarImagen($archivo): bool
    {

        if (file_exists(($archivo))) {

            echo "<pre>";
            print_r($archivo);
            echo "</pre>";

            $fileDelete =  unlink($archivo);

            if (!$fileDelete) {
                throw new Exception("No se pudo eliminar la imagen");
            } else {
                return TRUE;
            }
        }else{
            return FALSE;
        }
    }






    
}