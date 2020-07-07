<?php
namespace App\Security;

use App\Entity\Token;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class TokenAuthenticator extends AbstractGuardAuthenticator
{
	/**
	 * @var EntityManagerInterface
	 */
	private $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * @inheritdoc
	 */
	public function start(Request $request, AuthenticationException $authException = null)
	{
		return new JsonResponse(['message' => 'Credentials not found']);
	}

	public function supports(Request $request)
	{
		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function getCredentials(Request $request)
	{
		return ['api_key' => $request->headers->get('X-API-TOKEN')];
	}

	/**
	 * @return UserInterface|null
	 */
	public function getUser($credentials, UserProviderInterface $userProvider)
	{
		/** @var Token|null $token */
		$token =  $this
			->entityManager
			->getRepository(Token::class)
			->findOneBy(['value' => $credentials['api_key']]);

		return $token !== null ? $token->getUser() : null;
	}

	/**
	 * @inheritdoc
	 */
	public function checkCredentials($credentials, UserInterface $user)
	{
		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
	{
		return new JsonResponse(['message' => 'unauth'], 401);
	}

	/**
	 * @inheritdoc
	 */
	public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
	{
	}

	/**
	 * @inheritdoc
	 */
	public function supportsRememberMe()
	{
		return false;
	}
}
