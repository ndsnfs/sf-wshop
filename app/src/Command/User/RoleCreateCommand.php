<?php
namespace App\Command\User;

use App\Entity\Group;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RoleCreateCommand extends Command
{
	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;

	public function __construct(
		EntityManagerInterface $entityManager,
		string $name = null
	)
	{
		parent::__construct($name);
		$this->entityManager = $entityManager;
	}

	public function configure()
	{
		$this
			->setName('user:make:role')
			->addArgument('roleName');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$addedRole = $input->getArgument('roleName');
		/** @var Group[] $groups */
		$groups = $this->entityManager->getRepository(Group::class)->findAll();
		foreach ($groups as $group) {
			if ($group->getName() == $addedRole) {
				throw new \Exception('Group ' . $addedRole . ' already exists');
			}
		}

		$group = new Group();
		$group->setName($addedRole);
		$this->entityManager->persist($group);
		$this->entityManager->flush();
	}
}
