<?php
namespace App\Background;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="not_done_job")
 */
class NotDoneJob
{
	public function __construct(string $payload, string $eventDateTime)
	{
		$this->payload = $payload;
		$this->eventDateTime = $eventDateTime;
	}

	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;
	/**
	 * @ORM\Column(name="payload", type="string")
	 */
	private $payload;
	/**
	 * @ORM\Column(name="event_date_time", type="datetime")
	 */
	private $eventDateTime;
	/**
	 * @return mixed
	 */
	public function getPayload()
	{
		return $this->payload;
	}
	/**
	 * @return string
	 */
	public function getEventDateTime()
	{
		return new $this->eventDateTime;
	}
}
