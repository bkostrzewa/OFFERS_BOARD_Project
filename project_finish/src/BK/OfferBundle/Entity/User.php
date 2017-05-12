<?php

namespace BK\OfferBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser

{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    public function __construct()
    {
        parent:: __construct();

        $this->offers = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Offer", mappedBy="user")
     */
    private $offers;



    /**
     * Add offers
     *
     * @param \BK\OfferBundle\Entity\Offer $offers
     * @return User
     */
    public function addOffer(\BK\OfferBundle\Entity\Offer $offers)
    {
        $this->offers[] = $offers;

        return $this;
    }

    /**
     * Remove offers
     *
     * @param \BK\OfferBundle\Entity\Offer $offers
     */
    public function removeOffer(\BK\OfferBundle\Entity\Offer $offers)
    {
        $this->offers->removeElement($offers);
    }

    /**
     * Get offers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOffers()
    {
        return $this->offers;
    }
}
