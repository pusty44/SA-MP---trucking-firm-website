<?php
/**
 * Created by PhpStorm.
 * User: pusty
 * Date: 05.08.2018
 * Time: 15:45
 */

namespace App\Controller;

use App\Entity\Recruit;
use App\Entity\User;

use App\Form\UserType;
use App\Service\SecurityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Controller used to authenticate users, register new users and recovery password.
 *
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends AbstractController
{
    /**
     * Function to login users via login/email and password.
     *
     * @Route("/login", name="login")
     * @return \Symfony\Component\HttpFoundation\Response
     * @var AuthenticationUtils $authenticationUtils
     * @var TranslatorInterface $translator
     * @throws \Exception
     */
    public function login(AuthenticationUtils $authenticationUtils,SecurityService $securityService)
    {
        $login = $securityService->login($authenticationUtils);

        return $this->render('security/login.html.twig', array(
            'title' => 'Logowanie',
            'last_username' => $login['lastUsername'],
            'error' => $login['error'],
        ));
    }

    /**
     * Function to register new users with login/email and password
     *
     * @Route("/register/{hash}", name="register")
     * @return \Symfony\Component\HttpFoundation\Response
     * @var Request $request
     * @var UserPasswordEncoderInterface $passwordEncoder
     * @throws \Exception
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder,string $hash)
    {
        /** @var User $user */
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['activationHash' => $hash]);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $hash = md5(uniqid());
            $user->setActivationHash($hash);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            /** @var Recruit $recruit */
            $recruit = $this->getDoctrine()->getRepository(Recruit::class)->findOneBy(['activationHash' => $hash]);
            $recruit->setStatus(4);
            $recruit->setActivationHash($hash);
            $entityManager->persist($recruit);
            $entityManager->flush();
            return $this->redirectToRoute('login');
        }

        return $this->render(
            'security/register.html.twig',
            array(
                'form' => $form->createView(),
                'title' => 'Rejestracja kierowcy',
                'activation' => $hash
                )
        );
    }

    /**
     * Function to recovery lost password.
     *
     * @Route("/password-recovery", name="password_recovery")
     * @return \Symfony\Component\HttpFoundation\Response
     * @var Request $request
     * @var UserPasswordEncoderInterface $passwordEncoder
     * @throws \Exception
     */
    public function recoveryPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setIsActive(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('login');
        }

        return $this->render(
            'security/password-recovery.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }
}