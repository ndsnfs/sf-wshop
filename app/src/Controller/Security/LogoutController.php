<?php
namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
	/**
	 * @Route("/sign-out", name="security.sign-out", methods={"GET"})
	 */
	public function logout()
	{
		// controller can be blank: it will never be executed!
		throw new \Exception('Don\'t forget to activate logout in security.yaml');
	}
}