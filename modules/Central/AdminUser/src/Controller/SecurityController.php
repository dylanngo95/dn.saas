<?php

namespace Central\AdminUser\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/security', name: 'app_security')]
    public function index(): Response
    {
        return $this->render('@AdminUser/security/index.html.twig', [
            'controller_name' => 'AdminUser SecurityController',
        ]);
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('app_list');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

		$response = $this->render('@AdminUser/security/login.html.twig',
			['last_username' => $lastUsername, 'error' => $error]
		);

		// cache publicly for 3600 seconds
		$response->setPublic();
		$response->setMaxAge(3600);

		// (optional) set a custom Cache-Control directive
		$response->headers->addCacheControlDirective('must-revalidate', true);

		return $response;
	}

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/auth', name: 'app_auth')]
    public function auth(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        if ($this->getUser()) {
            $callBack = $request->get('callback') ?? null;
            if (!$callBack) {
                throw new BadRequestHttpException('not exists callback url');
            }
            return $this->redirect($callBack);
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

		return $this->render('@AdminUser/security/login.html.twig',
			['last_username' => $lastUsername, 'error' => $error]
		);
    }
}
