<?php

namespace BK\OfferBundle\Controller;

use BK\OfferBundle\Entity\Offer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * Lists all offer entities.
     *
     * @Route("/")
     * @Method("GET")
     */
    public function indexAction()
    {

        if ($this->getUser() == null) {

            $em = $this->getDoctrine()->getManager();

            $offers = $em->getRepository('BKOfferBundle:Offer')->findAll();

            return $this->render('BKOfferBundle:Default:index.html.twig', array(
                'offers' => $offers,
            ));
        } else {
            $userRoles = $this->getUser()->getRoles();
            if (in_array('ROLE_ADMIN', $userRoles)) {
                return $this->redirectToRoute("offer_index");

            } else if (in_array('ROLE_USER', $userRoles)) {
                return $this->redirectToRoute("user_offer_index");
            }
        }


    }

    /**
     * @Route("/indexShow/{offer}", name="indexShow")
     */
    public function showAction(Offer $offer)
    {
        return $this->render('BKOfferBundle:Default:show.html.twig', array('offer'=>$offer));

    }



}
