<?php
namespace App\Background;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\BeanstalkBundle\Events\JobNotDoneEvent;
use Symfony\BeanstalkBundle\IErrorListener;

class ErrorHandler implements IErrorListener
{
	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function store(JobNotDoneEvent $event)
	{
		$job = new NotDoneJob($event->getJob()->getData(), date('Y-m-d H:i:s'));
		$this->entityManager->persist($job);
		$this->entityManager->flush();
	}
}
