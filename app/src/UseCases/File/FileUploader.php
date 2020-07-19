<?php
namespace App\UseCases\File;

use App\Entity\Domain\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class FileUploader
{
    public static function allowedTypes()
    {
        return [
            FileTypes::TYPE_SLICED_IMAGE,
        ];
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return File
     */
    abstract public function upload(UploadedFile $uploadedFile);

    abstract public function getType() : string ;
}