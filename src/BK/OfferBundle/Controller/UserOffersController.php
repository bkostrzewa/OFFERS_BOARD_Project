<?php

namespace BK\OfferBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserOffersController extends Controller
{
    /**
     * @Route("/index", name="user_offer_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();


        $offers = $em->getRepository('BKOfferBundle:Offer')->findByUser($user->getId());


        return $this->render('BKOfferBundle:UserOffers:index.html.twig', array(
            'offers' => $offers, 'role'=>'USER'
        ));
    }

//    /**
//     * @Route("/index", name="user_offer_show")
//     */
//    public function showAction()
//    {
//
//
//    }





}
