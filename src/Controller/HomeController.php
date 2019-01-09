<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 07.01.2019
 * Time: 15:40
 */

namespace App\Controller;


use App\Entity\Counter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends AbstractController
{
    /**
     * Root template
     *
     * @Route("/", name="index")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */

    public function home()
    {
        $counter = $this->getDoctrine()->getRepository(Counter::class)->findBy([],['id' => 'DESC'],1,0);


        return $this->render('homepage.html.twig', array(
            'siteType' => true,
            'counter' => $counter[0],
        ));
    }

}