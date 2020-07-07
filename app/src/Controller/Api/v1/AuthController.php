<?php
namespace App\Controller\Api\v1;

use App\Entity\Token;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class AuthController
{
	/**
	 * @Route(path="/create-token", methods={"POST"})
	 */
	public function createToken(Request $request, EntityManagerInterface $entityManager, EncoderFactoryInterface $encoderFactory)
	{
		$email = $request->get('email');
		$password = $request->get('password');

		/** @var User $user */
		$user = $entityManager
			->getRepository(User::class)
			->findOneBy(['email' => $email]);

		if (!$user || ($user && !$encoderFactory->getEncoder($user)->isPasswordValid($user->getPassword(), $password, ''))) {
			return new JsonResponse(['message' => 'Invalid email/password']);
		}

		$token = new Token();
		$token->setValue(base64_encode(random_bytes(10)));
		$token->setUser($user);
		$entityManager->persist($token);
		$entityManager->flush();
		return new JsonResponse(['token' => $token->getValue()]);
	}
}
