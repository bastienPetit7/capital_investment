<?php

namespace App\Services\FileService;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class HandleSavingFileService
{
    private ParameterBagInterface $parameterBag;
    private SluggerInterface $slugger;

    /**
     * @param ParameterBagInterface $parameterBag
     * @param SluggerInterface $slugger
     */
    public function __construct(ParameterBagInterface $parameterBag,SluggerInterface $slugger)
    {
        $this->parameterBag = $parameterBag;
        $this->slugger = $slugger;
    }

    public function save(UploadedFile $fileToSave, object $object) {

        $originalFileName = $fileToSave->getClientOriginalName();

        $sluggedOriginalFileName = $this->slugger->slug($originalFileName);

        $extension = $fileToSave->getClientOriginalExtension();
        if($extension === "")
        {
            $extension = $fileToSave->guessClientExtension();
        }

        $fileUniqName = $sluggedOriginalFileName . '-' .  md5(uniqid()) . '.' . $extension;

        $fileToSave->move(
            $this->parameterBag->get('app_files_directory'),
            $fileUniqName
        );

        $object->setPathToFile('/uploads/files/' . $fileUniqName);
    }

}