<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Information;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:homepage.html.twig');
    }

    /**
     * @Route("/offre", name="offre")
     */
    public function offreAction()
    {
        return $this->render('AppBundle:Default:offre.html.twig');
    }

    /**
     * @Route("/coordonnee", name="coordonnee")
     */
    public function coordonneeAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $data = $request->request->get('request');
            $em = $this->getDoctrine()->getManager();

            $Information = new Information();

            $User = $this->getUser();
            if ($User->getId() != null) {
                $User = $em->getRepository('UserBundle:User')->find($User->getId());
                $Information->setUser($User);
            }

            $Information->setAddress($data['adresse']);
            $Information->setCountry($data['country']);
            $Information->setFirstname($data['firstname']);
            $Information->setLastname($data['lastname']);
            $Information->setPhonefix($data['phonefix']);
            $Information->setPhonemobile($data['phonemobile']);
            $Information->setZip($data['zip']);
        }
        return $this->render('AppBundle:Default:coordonnee.html.twig');
    }

    /**
     * @Route("/paiement", name="paiement")
     */
    public function paiementAction()
    {
        return $this->render('AppBundle:Default:paiement.html.twig');
    }
}
