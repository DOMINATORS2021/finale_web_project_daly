<?php


namespace ReclamationBundle\Controller;


use ReclamationBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReclamationController extends Controller
{

    public function ReclamationAction(\Symfony\Component\HttpFoundation\Request $request,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $reclamation = new Reclamation();
        $form = $this->createForm('ReclamationBundle\Form\ReclamationType', $reclamation);
        $form->handleRequest($request);
        $user = $em->getRepository('UserBundle:User')->find(array("id" => $this->getUser()->getId()));
        $event = $em->getRepository('EventsBundle:Events')->find($id);
        $reclamation->setIdclient($user);
        $reclamation->setIdevent($event);
        $date = (date('Y-m-d'));
        $reclamation->setDatereclamation($date);
        $reclamation->setStatut("En cours");

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($reclamation);
            $em->flush();


            return $this->redirectToRoute('reclamation_Affiche');
        }
            return $this->render('ReclamationBundle:Reclamation:AjouterReclamation.html.twig', array(
                'form' => $form->createView(),

            ));
        }

    public function AfficheReclamtionClientAction()
    {


        $m = $this->getDoctrine()->getManager();
        $rec = $m->getRepository("ReclamationBundle:Reclamation")->findBy(array("id_Client" => $this->getUser()->getId()));


        return $this->render('ReclamationBundle:Reclamation:AfficherReclamationClient.html.twig', array(
            'rec' => $rec
        ));
    }


    public function AfficheReclamtionAdminAction()
    {


        $m = $this->getDoctrine()->getManager();
        $rec = $m->getRepository("ReclamationBundle:Reclamation")->findALL();


        return $this->render('ReclamationBundle:Reclamation:AfficherReclamationAdmin.html.twig', array(
            'rec' => $rec
        ));
    }
    public function TraiterAction(Request $request ,$id)
    {


        $m = $this->getDoctrine()->getManager();
        $rec = $m->getRepository('ReclamationBundle:Reclamation')->find($id);
        $rec->setStatut('Traitée');

        $m->persist($rec);
        $m->flush();
        return $this->redirectToRoute('reclamation_Affiche_admin');




    }


    public function deleteReclamationAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $rec = $em->getRepository('ReclamationBundle:Reclamation')->find($id);
        $em->remove($rec);
        $em->flush();


        return $this->redirectToRoute('reclamation_Affiche');
    }
    public function deleteReclamationAdminAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $rec = $em->getRepository('ReclamationBundle:Reclamation')->find($id);
        $em->remove($rec);
        $em->flush();


        return $this->redirectToRoute('reclamation_Affiche_admin');
    }



    public function ModifierReclamationAction(\Symfony\Component\HttpFoundation\Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('ReclamationBundle:Reclamation')->find($id);
        $editForm = $this->createForm('ReclamationBundle\Form\ReclamationType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('reclamation_Affiche');
        }

        return $this->render('ReclamationBundle:Reclamation:ModifierReclamation.html.twig', array(
            'Event' => $event,
            'form' => $editForm->createView(),
        ));
    }


}