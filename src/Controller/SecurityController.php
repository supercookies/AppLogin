<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\SecurityContext;

use App\Entity\User;

/**
 * Cette classe  gère la securité 
 *
 * @author merlin diongo <MDiongo.ext@orange.com, merlindiongo@gmail.com>
 */
class SecurityController extends Controller
{
    /**
     * Exécuter la connexion de user
     *
     * @Route("/", name="app_login")
     *
     * @param  Request          $request
     * @param  SessionInterface $session
     *
     * @return redirectToRoute || render
     */
    public function login(Request $request)
    {
        if ( $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED') )
        {
          return $this->redirectToRoute('app_operation_stom');
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('base.html.twig', array(
          'last_username' => $authenticationUtils->getLastUsername(),
          'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }
}
