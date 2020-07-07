<?php
namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SignInController extends AbstractController
{
	/**
	 * @Route("/sign-in", name="security.sign-in", methods={"GET","POST"})
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function view(AuthenticationUtils $authenticationUtils)
	{
		$error = $authenticationUtils->getLastAuthenticationError();

		return $this->render('security/sign-in.html.twig', [
			'errorMessage' => $error ? $error->getMessage() : '',
		]);
	}
}