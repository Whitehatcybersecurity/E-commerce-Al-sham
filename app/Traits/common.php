<?php

namespace App\Traits;


trait Common
{

    public function generateRandom($digit)
    {
        $min = pow(10, $digit - 1);
        $max = pow(10, $digit) - 1;
        return rand($min, $max);
    }

    public function fileUpload($fileinput, $filepath, $fileName)
    {
        $fileinput->move(public_path($filepath), $fileName);
        return $filepath . '/' . $fileName;
    }
}