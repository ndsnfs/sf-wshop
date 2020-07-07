<?php
namespace App\Entity\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Category
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;
	/**
	 * @var Category
	 * @ORM\ManyToOne(targetEntity="Category")
	 */
	private $parent;
	/**
	 * @ORM\Column(type="string")
	 */
	private $name;

	public function setName(string $name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getParent() : ?Category
	{
		return $this->parent;
	}

	public function setParent(Category $parent)
	{
		$this->parent = $parent;
	}
}
