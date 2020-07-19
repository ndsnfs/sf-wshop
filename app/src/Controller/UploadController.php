<?php
namespace App\Controller;

use App\Entity\Domain\File\SlicedImage;
use App\UseCases\File\Uploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UploadController
{
    /**
     * @Route("/upload", name="upload")
     */
    public function handle(
        Request $request,
        Uploader $fileUploader,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    )
    {
        /** @var UploadedFile $file */
        $file = $request->files->get('file');
        $fileType = $request->request->get('type');
        $file = $fileUploader->upload($file, $fileType);
        return new JsonResponse($serializer->normalize($file));
    }
}