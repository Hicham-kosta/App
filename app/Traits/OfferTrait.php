<?php

namespace App\Traits;

Trait OfferTrait //Pour etre utilisé dans n'importe quel fichier Controller ou dossier images
{
     function saveImage($photo, $folder)
    { // function dynamic

        $file_extension = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);

        return $file_name;
    }

}
