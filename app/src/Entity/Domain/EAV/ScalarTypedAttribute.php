<?php
namespace App\Entity\Domain\EAV;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ScalarTypedAttribute
{
	const INT_TYPE = 'int';
	const STRING_TYPE = 'string';

	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;
	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $name;
	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $type;

	public function getName()
	{
		return $this->name;
	}

	public function setName($name): void
	{
		$this->name = $name;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setType($type): void
	{
		$this->type = $type;
	}

	public static function getAllowedTypes() : array
    {
        return [
            self::INT_TYPE,
            self::STRING_TYPE,
        ];
    }
}
