<?php
namespace App\Background\Payload;

use Symfony\BeanstalkBundle\APayload;

class MailTemplatingPayload extends APayload
{
	public $from;
	public $to;
	public $context;
	public $template;
}
