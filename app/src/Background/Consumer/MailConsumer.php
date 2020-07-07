<?php
namespace App\Background\Consumer;

use App\Background\Payload\MailTemplatingPayload;
use Pheanstalk\Job;
use Symfony\BeanstalkBundle\AConsumer;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailConsumer extends AConsumer
{
	/**
	 * @var MailerInterface
	 */
	private $mailer;

	public function __construct(MailerInterface $mailer)
	{
		$this->mailer = $mailer;
	}

	public function tubeName(): string
	{
		return 'mails';
	}

	public function execute(Job $job)
	{
		/** @var MailTemplatingPayload $payload */
		$payload = $this->extract($job, MailTemplatingPayload::class);

		$email = (new TemplatedEmail())
			->from($payload->from)
			->to($payload->to)
			->htmlTemplate($payload->template)
			->context($payload->context);

		$this->mailer->send($email);
	}
}
