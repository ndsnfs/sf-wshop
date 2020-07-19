<?php
namespace App\UseCases\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Uploader
{
    /**
     * @var FileUploader[]
     */
    private $fileUploaderList = [];

    public function addUploader(FileUploader $fileUploader)
    {
        $this->fileUploaderList[] = $fileUploader;
    }

    public function upload(UploadedFile $uploadedFile, string $type)
    {
        foreach ($this->fileUploaderList as $fileUploader) {
            if ($fileUploader->getType() === $type) {
                return $fileUploader->upload($uploadedFile);
            }
        }

        throw new \Exception('Strategy not found!');
    }
}