<?php
namespace App\UseCases\User\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class MakeUserCommand
{
	/**
	 * @var string
	 * @Assert\NotBlank()
	 * @Assert\Email()
	 */
	private $email;
	/**
	 * @var string
	 * @Assert\NotBlank()
	 * @Assert\Length(min="6",max="10")
	 */
	private $password;
	/**
	 * @var string[]
	 * @Assert\Unique()
	 */
	private $roles;

	public function __construct(string $email, string $password, array $roles)
	{
		$this->email = $email;
		$this->password = $password;
		$this->roles = $roles;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function getRoles(): array
	{
		return $this->roles;
	}
}
