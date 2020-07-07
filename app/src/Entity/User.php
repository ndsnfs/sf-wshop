<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{
	/**
	 * @var int
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;
	/**
	 * @var string
	 * @ORM\Column(type="string", length=50)
	 */
	private $email;
	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $password;

	/**
	 * @var Group[]
	 * @ORM\ManyToMany(targetEntity="Group")
	 * @ORM\JoinTable(name="user_groups")
	 */
	private $groups;

	/**
	 * @var Token
	 * @ORM\OneToMany(targetEntity="Token", mappedBy="user")
	 */
	private $tokens;

	public function __construct()
	{
		$this->groups = new ArrayCollection();
	}

	public function getGroups() : ArrayCollection
	{
		return $this->groups;
	}

	/**
	 * @inheritdoc
	 */
	public function getRoles()
	{
		return array_map(function ($v) { return $v->getName(); }, $this->groups->toArray());
	}

	/**
	 * @inheritdoc
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @inheritdoc
	 */
	public function getSalt()
	{
		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function getUsername()
	{
		return $this->email;
	}

	/**
	 * @inheritdoc
	 */
	public function eraseCredentials()
	{
	}

	public function getEmail() : string
	{
		return $this->email;
	}

	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function setPassword(string $password): void
	{
		$this->password = $password;
	}
}
