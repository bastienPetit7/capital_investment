<?php

namespace App\Services\FileService;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class HandleSavingNameAndExtensionOfFileService
{
    public function getFileName(UploadedFile $file)
    {
        return pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
    }

    public function getExtension(UploadedFile $file): string
    {

        if($file->getClientOriginalExtension() === "")
        {
            return $file->guessClientExtension();
        }
        return $file->getClientOriginalExtension();
    }
}