<?php

/*function show_name()
{
    return 'eman';
}*/

use Illuminate\Support\Facades\Config;

function getLanguages()
{
    return \App\Models\Language::active()->select()->get();
}

function getDefaultLanguage()
{
    //get the Default Language
    return Config::get('app.locale');
}

//save images
function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    return 'images/' . $folder . '/' . $filename;
}
