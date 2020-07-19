<?php
namespace App\UseCases\File;

use App\Entity\Domain\File\SlicedImage;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SlicedImageUploader extends FileUploader
{
    /**
     * @var ParameterBagInterface
     */
    private $params;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ImgResizer
     */
    private $imgResizer;

    public function __construct(
        ParameterBagInterface $params,
        Filesystem $filesystem,
        EntityManagerInterface $entityManager,
        ImgResizer $imgResizer
    )
    {
        $this->params = $params;
        $this->filesystem = $filesystem;
        $this->entityManager = $entityManager;
        $this->imgResizer = $imgResizer;
    }

    public function upload(UploadedFile $uploadedFile)
    {
        $publicDir = $this->params->get('public_dir');
        $uploadDir = $this->params->get('upload_dir') . DIRECTORY_SEPARATOR . date('Y-m-d');
        $fileName = Uuid::uuid4() . '.' . $uploadedFile->guessExtension();
        $fullPath = $publicDir
            . DIRECTORY_SEPARATOR
            . $uploadDir;
        $fullName = $uploadDir . DIRECTORY_SEPARATOR . $fileName;

        if (!$this->filesystem->exists($fullPath)) {
            $this->filesystem->mkdir($fullPath);
        }


        $img = new SlicedImage();
        $img->setPath($fullName);

        $uploadedFile->move($fullPath, $fileName);
        $this
            ->imgResizer
            ->setSourcePath($fullName)
            ->setDistPath($fullName)
            ->resize(500);
        $this
            ->imgResizer
            ->setSourcePath($fullName)
            ->setDistPath($img->getSmPath())
            ->resize(263);

        $this->entityManager->persist($img);
        $this->entityManager->flush();

        return $img;
    }

    public function getType(): string
    {
        return FileTypes::TYPE_SLICED_IMAGE;
    }
}