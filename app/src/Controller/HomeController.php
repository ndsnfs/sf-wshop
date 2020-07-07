<?php
namespace App\Controller;

use App\Background\Payload\MailTemplatingPayload;
use Symfony\BeanstalkBundle\AProducer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
	/**
	 * @Route("/", name="home")
	 * @param AProducer $producer
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function home(AProducer $producer)
	{
        if(!$this->isGranted('edit', 'asasas')) {
            die;
        }
//		$payload = new MailTemplatingPayload();
//		$payload->from = 'admin@mail.ru';
//		$payload->to = 'n_ds@mail.ru';
//		$payload->template = 'email/hello.html.twig';
//		$payload->context = [ 'name' => 'Jon'];
//		$producer->setTube('mails')->publish($payload);
		return $this->render('home/index.html.twig');
	}
}
