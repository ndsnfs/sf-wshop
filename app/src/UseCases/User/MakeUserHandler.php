<?php
namespace App\UseCases\User;

use App\Entity\Group;
use App\Entity\User;
use App\UseCases\User\DTO\MakeUserCommand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class MakeUserHandler
{
	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;
	/**
	 * @var EncoderFactoryInterface
	 */
	private $encoderFactory;

	public function __construct(
		EntityManagerInterface $entityManager,
		EncoderFactoryInterface $encoderFactory
	)
	{
		$this->entityManager = $entityManager;
		$this->encoderFactory = $encoderFactory;
	}

	public function handle(MakeUserCommand $command) : User
	{
		$user = new User();
//		todo проверка отсутствия пользователя
		$user->setEmail($command->getEmail());
		$user->setPassword($this->encoderFactory->getEncoder(User::class)->encodePassword($command->getPassword(), ''));
//		todo проверка наличия ролей
//		if (count($roles) != count($command->getRoles()))
		/** @var Group[] $roles */
		$roles = $this->entityManager->getRepository(Group::class)->findBy(['name' => $command->getRoles()]);
		foreach ($roles as $role) {
			$user->getGroups()->add($role);
		}
		$this->entityManager->persist($user);
		$this->entityManager->flush();
		return $user;
	}
}
