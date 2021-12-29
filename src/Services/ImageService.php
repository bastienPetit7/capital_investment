<?php

namespace App\Services;


use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageService
{
    /**
     * @var ContainerBagInterface
     */
    protected ContainerBagInterface $containerBag;


    public function __construct(ContainerBagInterface $containerBag)
    {
        $this->containerBag = $containerBag;
    }

    public function saveImage(UploadedFile $uploadedFile, object $object) {

        $fileName = md5(uniqid()) . '.' . $uploadedFile->guessExtension();

        $uploadedFile->move(
            $this->containerBag->get('app_images_directory'),
            $fileName
        );

        $object->setImagePath('/uploads/images/' . $fileName);

    }

    public function editImage($imageOriginal, UploadedFile $uploadedFile, object $object) {

        $this->saveImage($uploadedFile,$object);

        if($imageOriginal !== null && $imageOriginal !== "")
        {
            $fileMainPictureOriginal = $this->containerBag->get('app_images_directory') . '/../..' . $imageOriginal;

            if(file_exists($fileMainPictureOriginal))
            {
                unlink( $fileMainPictureOriginal);
            }
        }
    }


}