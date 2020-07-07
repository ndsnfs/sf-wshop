<?php
namespace App\Entity;

use App\Entity\Domain\Media\Image;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class FeedbackDTO
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var string
     * @Assert\Email
     * @Assert\NotBlank
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @var array
     */
    private $images = [];

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    public function addImage(Image $image): void
    {
        $this->images[] = $image;
    }
}