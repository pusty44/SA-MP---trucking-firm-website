<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 07.01.2019
 * Time: 16:12
 */

namespace App\Controller;

use App\Entity\Load;
use App\Entity\Page;
use App\Entity\Plate;
use App\Entity\Recruit;
use App\Entity\Tachograph;
use App\Entity\User;
use App\Repository\LoadsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PageController extends AbstractController
{
    /**
     * Root template
     *
     * @Route("/page/{seoUrl}", name="page")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */

    public function getPage($seoUrl)
    {
        /** @var Page $page */
        $page = $this->getDoctrine()->getRepository(Page::class)->findOneBy(['seoUrl' => $seoUrl]);

        return $this->render('page.html.twig', array(
            'page'  => $page,
            'title' => $page->getTitle(),
        ));
    }

    /**
     * Root template
     *
     * @Route("/drivers", name="drivers")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */

    public function getdrivers()
    {
        $return = array();
        $users = $this->getDoctrine()->getRepository(User::class)->findBy([],['sortOrder' => 'ASC']);
        /** @var User $user */
        foreach($users as $user){
            /** @var Recruit $recruit */
            $recruit = $this->getDoctrine()->getRepository(Recruit::class)->findOneBy(['serverNick' => $user->getUsername()]);
            $loads = $this->getDoctrine()->getRepository(Load::class)->countLoads($user);
            $km = $this->getDoctrine()->getRepository(Tachograph::class)->countKm($user);
            $plate = $this->getDoctrine()->getRepository(Plate::class)->findOneBy(['user' => $user]);
            if($loads) $loadout = $loads; else $loadout = null;
            if($km) $kilo = $km; else $kilo = null;
            if($plate) $tab = $plate; else $tab = null;
            if($user->getTruck() != null) $truck = $user->getTruck(); else $truck = false;
            if($user->getRanking() != null) $rank = $user->getRanking(); else $rank = false;
            $return[] = [
                'user' => $user->getUsername(),
                'avatar' => $recruit->getAvatar(),
                'cover' => $recruit->getCoverPhoto(),
                'loads' => $loadout,
                'km' => $kilo,
                'plate' => $tab,
                'truck' => $truck,
                'rank' => $rank,
                'profile' => $recruit->getProfileLink(),

            ];

        }

        return $this->render('drivers.html.twig', array(
            'title' => 'Nasi kierowcy',
            'returns' => $return
        ));
    }




}