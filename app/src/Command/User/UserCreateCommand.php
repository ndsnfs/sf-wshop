<?php
namespace App\Command\User;

use App\UseCases\User\DTO\MakeUserCommand;
use App\UseCases\User\MakeUserHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserCreateCommand extends Command
{
	/**
	 * @var MakeUserHandler
	 */
	private $makeUserHandler;

	public function __construct(
		MakeUserHandler $makeUserHandler,
		string $name = null)
	{
		parent::__construct($name);
		$this->makeUserHandler = $makeUserHandler;
	}

	public function configure()
	{
		$this
			->setName('user:make:user')
			->addArgument('email')
			->addArgument('password')
			->addArgument('user_role');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$email = $input->getArgument('email');
		$password = $input->getArgument('password');
		$role = $input->getArgument('user_role');
		$command = new MakeUserCommand($email,$password,[$role]);
		$this->makeUserHandler->handle($command);

		$output->writeln('User successfully created.');
	}
}
