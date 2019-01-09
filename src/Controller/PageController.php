<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 07.01.2019
 * Time: 16:12
 */

namespace App\Controller;

use App\Entity\Page;
use App\Entity\Recruit;
use App\Entity\Tachograph;
use App\Entity\User;
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

        return $this->render('drivers.html.twig', array(

        ));
    }




}