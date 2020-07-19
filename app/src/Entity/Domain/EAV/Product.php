<?php
namespace App\Entity\Domain\EAV;

use App\Entity\Domain\Category;
use App\Entity\Domain\File\SlicedImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Product
{
	/**
	 * @var int
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;
	/**
	 * @var Category
	 * @ORM\ManyToOne(targetEntity="App\Entity\Domain\Category")
	 */
	private $category;
	/**
	 * @var string
	 * @ORM\Column(name="name", type="string")
	 */
	private $name;
	/**
	 * @var ProductCharacteristic[]
	 * @ORM\OneToMany(
	 *     targetEntity="ProductCharacteristic",
	 *     mappedBy="product",
	 *     cascade={"all"},
	 *     orphanRemoval=true
	 * )
	 */
	private $characteristics;
    /**
     * @var SlicedImage[]
     * @ORM\ManyToMany(
     *     targetEntity="App\Entity\Domain\File\SlicedImage",
     *     orphanRemoval=true
     * )
     * @ORM\JoinTable(
     *     name="product_images",
     *     joinColumns={@ORM\JoinColumn(name="product_id",referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="image_id",referencedColumnName="id")}
     * )
     */
	private $images;

	public function __construct()
	{
		$this->characteristics = new ArrayCollection();
		$this->images = new ArrayCollection();
	}

	public function getCharacteristics()
	{
		return $this->characteristics;
	}

	public function getCategory(): ?Category
	{
		return $this->category;
	}

	public function setCategory(Category $category): void
	{
		$this->category = $category;
	}

	public function getName() : ?string
	{
		return $this->name;
	}

	public function setName(string $name): void
	{
		$this->name = $name;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setCharacteristics($productCharacteristics): void
	{
		$this->characteristics = $productCharacteristics;
		foreach ($productCharacteristics as $productCharacteristic) {
			/** @var ProductCharacteristic $productCharacteristic */
			$productCharacteristic->setProduct($this);
		}
	}

	public function addCharacteristic(ProductCharacteristic $productCharacteristic): void
	{
		$productCharacteristic->setProduct($this);
		$this->characteristics->add($productCharacteristic);
	}

	public function removeCharacteristic(ProductCharacteristic $productCharacteristic)
	{
		$productCharacteristic->setProduct(null);
		$this->characteristics->removeElement($productCharacteristic);
	}

    public function getImages()
    {
        return $this->images;
    }

    public function setImages($images): void
    {
        $this->images = $images;
        foreach ($images as $image) {
            $image->setProduct(null);
        }
    }

    public function addImage($image): void
    {
        $this->images->add($image);
    }

    public function removeImage(SlicedImage $image)
    {
        $this->characteristics->removeElement($image);
    }
}
