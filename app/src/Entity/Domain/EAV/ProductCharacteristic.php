<?php
namespace App\Entity\Domain\EAV;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ProductCharacteristic
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;
	/**
	 * @var ScalarTypedAttribute
	 * @ORM\ManyToOne(targetEntity="ScalarTypedAttribute")
	 */
	private $attribute;
	/**
	 * @var Product
	 * @ORM\ManyToOne(targetEntity="Product")
	 */
	private $product;
	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	private $intValue;
	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	private $varcharValue;

	public function __construct(ScalarTypedAttribute $attribute)
	{
		$this->attribute = $attribute;
	}

	public function getValue()
	{
		if (!$this->attribute) return;

		if ($this->attribute->getType() == ScalarTypedAttribute::INT_TYPE) {
			return $this->intValue;
		}
		if ($this->attribute->getType() == ScalarTypedAttribute::STRING_TYPE) {
			return $this->varcharValue;
		}
	}

	public function setValue($value)
	{
		if (!$this->attribute) return;

		if ($this->attribute->getType() == ScalarTypedAttribute::INT_TYPE) {
			$this->intValue = $value;
		}
		if ($this->attribute->getType() == ScalarTypedAttribute::STRING_TYPE) {
			$this->varcharValue = $value;
		}
	}

	public function getName() : ?string
	{
		return $this->attribute->getName();
	}

	public function getAttribute(): ?ScalarTypedAttribute
	{
		return $this->attribute;
	}

	public function setAttribute(ScalarTypedAttribute $attribute): void
	{
		$this->attribute = $attribute;
	}

	public function getProduct(): Product
	{
		return $this->product;
	}

	public function setProduct(Product $product): void
	{
		$this->product = $product;
	}
}
