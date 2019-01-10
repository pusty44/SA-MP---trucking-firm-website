<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 09.01.2019
 * Time: 00:24
 */

namespace App\Controller;


use App\Entity\Load;
use App\Entity\Recruit;
use App\Entity\Tachograph;
use App\Form\LoadsType;
use App\Form\NewLoadType;
use App\Form\TachoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoadController extends AbstractController
{
    /**
     * Root template
     *
     * @Route("/driver", name="driver")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */

    public function getdriver()
    {
        $user = $this->getUser();
        $recruit = $this->getDoctrine()->getRepository(Recruit::class)->findOneBy(['serverNick' => $user->getUsername()]);
        $tachograph = $this->getDoctrine()->getRepository(Tachograph::class)->findBy(['user' => $user],['addDate' => 'DESC']);
        return $this->render('user_panel.html.twig', array(
            'title' => 'Panel kierowcy',
            'user' => $user,
            'recruit' => $recruit,
            'tachograph' => $tachograph

        ));
    }

    /**
     * Root template
     *
     * @Route("/driver/add/tacho", name="newTacho")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */

    public function newTacho(Request $request)
    {
        $user = $this->getUser();
        $tacho = new Tachograph();
        $form = $this->createForm(TachoType::class, $tacho , array(
            'user' => $this->getUser(),
            ));
        $form->handleRequest($request);
        $error = false;
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            /** @var Load $load */
            $load = $data->getLoad();
            $tacho->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($tacho);
            $em->flush();
            $load->setAvailable(false);
            $load->setended(true);
            $em->persist($load);
            $em->flush();
            $error = true;
        }
        return $this->render('newTacho.html.twig', array(
            'title' => 'Panel kierowcy',
            'form' => $form->createView(),
            'error' => $error

        ));
    }

    /**
     * Root template
     *
     * @Route("/driver/add/load", name="newLoad")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */

    public function newLoad(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(LoadsType::class);
        $load1 = $this->createForm(NewLoadType::class);
        $load1->handleRequest($request);
        $form->handleRequest($request);
        $error = false;
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            /** @var Load $load */
            $load = $data['load'];
            if($load != NULL) {
                $load->setUser([$user]);
                $load->setAvailable($load->getAvailable() - 1);
                if ($load->getAvailable() == 0) {
                    $load->setEnded(1);
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($load);
                $em->flush();
                $error = true;
            }
        }
        if($load1->isSubmitted() && $load1->isValid()){
            $data = $load1->getData();
            $load = new Load();
            $load->setUser([$user]);
            $load->setAvailable(0);
            $load->setEnded(1);
            $load->setLocationStart($data['locationStart']);
            $load->setLocationEnd($data['locationEnd']);
            $load->setTitle($data['title'].' z: '.$data['locationStart']->getTitle().' do: '.$data['locationEnd']->getTitle());
            $em = $this->getDoctrine()->getManager();
            $em->persist($load);
            $em->flush();
            $error = true;
        }
        return $this->render('newLoad.html.twig', array(
            'title' => 'Nowy ładunek',
            'form' => $form->createView(),
            'load1' => $load1->createView(),
            'error' => $error

        ));
    }

}