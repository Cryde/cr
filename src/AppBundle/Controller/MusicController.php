<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MusicController extends Controller
{
    /**
     * @Route("/music", name="music")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:music:index.html.twig');
    }
}
