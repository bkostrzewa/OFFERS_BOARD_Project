<?php

namespace BK\OfferBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserOffersController extends Controller
{
    /**
     * @Route("/allOffer/")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('BKOfferBundle:Offer')->findAll();

        return $this->render('BKOfferBundle:Default:index.html.twig', array(
            'offers' => $offers,
        ));
    }

    /**
     * @Route("/myOffer", name="user_offer_myOffer")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function myOfferAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();


        $offers = $em->getRepository('BKOfferBundle:Offer')->findByUser($user->getId());


        return $this->render('BKOfferBundle:UserOffers:index.html.twig', array(
            'offers' => $offers
        ));
    }


}