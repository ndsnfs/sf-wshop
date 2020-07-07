<?php
namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RestorePasswordController extends AbstractController
{
	/**
	 * @Route("/restore-password", name="security.restore-password.view", methods={"GET"})
	 */
	public function view()
	{
		return $this->render('security/restore-password-view.html.twig');
	}

	/**
	 * @Route("/restore-passwords", name="security.restore-password.handle", methods={"POST"})
	 */
	public function handle()
	{
		var_dump(1111111);die;
	}
}