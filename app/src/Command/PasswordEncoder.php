<?php
namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class PasswordEncoder extends Command
{
	/**
	 * @var EncoderFactoryInterface
	 */
	private $encoderFactory;
	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;

	public function __construct(EncoderFactoryInterface $encoderFactory, EntityManagerInterface $entityManager)
	{
		$this->encoderFactory = $encoderFactory;
		parent::__construct();
		$this->entityManager = $entityManager;
	}

	public function configure()
	{
		$this->setName('mencode');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln($this->encoderFactory->getEncoder(User::class)->encodePassword('123', ''));
	}
}
