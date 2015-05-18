<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Command;
use AppBundle\Entity\Information;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

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
    public function offreAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {

        }

        return $this->render('AppBundle:Default:offre.html.twig');
    }

    /**
     * @Route("/coordonnee", name="coordonnee")
     */
    public function coordonneeAction(Request $request)
    {
        $Session = new Session();

        /*if ($Session->get('etape') != 2) {
            return new RedirectResponse($this->generateUrl('offre'));
        }*/

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

            $em->persist($Information);
            $em->flush();

            $Session->set('etape', 3);

            return new RedirectResponse($this->generateUrl('paiement'));
        }
        return $this->render('AppBundle:Default:coordonnee.html.twig');
    }

    /**
     * @Route("/paiement", name="paiement")
     */
    public function paiementAction(Request $request)
    {
        $Session = new Session();

        /*if ($Session->get('etape') != 3) {
            return new RedirectResponse($this->generateUrl('offre'));
        }*/

        if ($request->getMethod() == 'POST') {
            $data = $request->request->get('request');
            $em = $this->getDoctrine()->getManager();

            $Offer = $em->getRepository('AppBundle:Offer')->find($Session->get('offer'));
            $Payment = $em->getRepository('AppBundle:Payment')->find($data['payment']);

            $Command = new Command();
            $Command->setZip($data['zip']);
            $Command->setLastname($data['lastname']);
            $Command->setFirstname($data['fistname']);
            $Command->setAddress($data['adress']);
            $Command->setCountry($data['country']);
            $Command->setPhone($data['phone']);
            $Command->setOffer($Offer);
            $Command->setPayment($Payment);

            $em->persist($Command);
            $em->flush();
        }
        return $this->render('AppBundle:Default:paiement.html.twig');
    }
}
