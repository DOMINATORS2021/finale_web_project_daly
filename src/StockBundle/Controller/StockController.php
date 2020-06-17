<?php

namespace StockBundle\Controller;


use ProduitBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StockController extends Controller
{

    public function AjouterStockAction( \Symfony\Component\HttpFoundation\Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $stock = new Produit();
        $form = $this->createForm('ProduitBundle\Form\ProduitType', $stock);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $stock->setNomfile("3.jpg");
            $stock->getUploadFile();
            $em->persist($stock);
            $em->flush();
            return $this->redirectToRoute('stock_Afficher');
        }
        return $this->render('StockBundle:Stock:AjouterStock.html.twig', array(
            'form' => $form->createView(),

        ));
    }


    public function AfficheStockAction()
    {


        $m = $this->getDoctrine()->getManager();
        $Stock = $m->getRepository("ProduitBundle:Produit")->findAll();


        return $this->render('StockBundle:Stock:AfficherStock.html.twig', array(
            'stock' => $Stock
        ));
    }


    public function deleteStockAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $Pro = $em->getRepository('ProduitBundle:Produit')->find($id);
        $em->remove($Pro);
        $em->flush();


        return $this->redirectToRoute('stock_Afficher');
    }



    public function ModifierStockAction(\Symfony\Component\HttpFoundation\Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $stock = $em->getRepository('ProduitBundle:Produit')->find($id);
        $editForm = $this->createForm('ProduitBundle\Form\ProduitType', $stock);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em->persist($stock);
            $em->flush();

            return $this->redirectToRoute('stock_Afficher');
        }
        $em = $this->getDoctrine()->getManager();

        return $this->render('StockBundle:Stock:ModifierStock.html.twig', array(
            'Stock' => $stock,
            'form' => $editForm->createView(),
        ));
    }

    public function ModifierProdMgAction(\Symfony\Component\HttpFoundation\Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $stock = $em->getRepository('ProduitBundle:Produit')->find($id);
        $editForm = $this->createForm('ProduitBundle\Form\ProduitMgType', $stock);
        $stock->setNvprix(0);
        $qs=$stock->getQuantite();
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $stock->setQuantite($qs-$stock->getNvquantite());
            $em->persist($stock);
            $em->flush();

            return $this->redirectToRoute('stock_Afficher');
        }
        $em = $this->getDoctrine()->getManager();

        return $this->render('StockBundle:Stock:ModifierProduitMg.html.twig', array(
            'Stock' => $stock,
            'form' => $editForm->createView(),
        ));
    }

}