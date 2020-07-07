<?php
namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
	/**
	 * @var UserPasswordEncoderInterface
	 */
	private $passwordEncoder;
	/**
	 * @var UrlGeneratorInterface
	 */
	private $urlGenerator;

	public function __construct(UserPasswordEncoderInterface $passwordEncoder, UrlGeneratorInterface $urlGenerator)
	{
		$this->passwordEncoder = $passwordEncoder;
		$this->urlGenerator = $urlGenerator;
	}

	/**
	 * @inheritdoc
	 */
	protected function getLoginUrl()
	{
		return $this->urlGenerator->generate('security.sign-in');
	}

	/**
	 * @inheritdoc
	 */
	public function supports(Request $request)
	{
		return $request->isMethod('POST') && $request->attributes->get('_route') === 'security.sign-in';
	}

	/**
	 * @inheritdoc
	 */
	public function getCredentials(Request $request)
	{
		$request->getSession()->set(
			Security::LAST_USERNAME,
			$request->request->get('username')
		);

		return [
			'username' => $request->request->get('username'),
			'password' => $request->request->get('password'),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function getUser($credentials, UserProviderInterface $userProvider)
	{
		try {
			return $userProvider->loadUserByUsername($credentials['username']);
		} catch (AuthenticationException $exception) {
			throw new CustomUserMessageAuthenticationException('Неверный логин/пароль');
		}
	}

	/**
	 * @inheritdoc
	 */
	public function checkCredentials($credentials, UserInterface $user)
	{
		if ($user && $this->passwordEncoder->isPasswordValid($user, $credentials['password'])) {
			return true;
		}
		throw new CustomUserMessageAuthenticationException('Неверный логин/пароль');
	}

	/**
	 * @inheritdoc
	 */
	public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
	{
		return new RedirectResponse($this->urlGenerator->generate('home'));
	}
}