<?php


namespace StockBundle\Controller;


use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use ProduitBundle\Entity\Produit;
use StockBundle\Entity\Stock;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatController extends  Controller
{
    public function StatAction()
    {
        $pieChart = new PieChart();
        $em = $this->getDoctrine()->getManager();
        $classes = $em->getRepository(Produit::class)->findAll();
        $totalQuantite=0;
        foreach($classes as $class) {
            $totalQuantite=$totalQuantite+$class->getQuantite();
        }
        $data= array();
        $stat=['Produit', 'quantite'];
        $nb=0;
        array_push($data,$stat);
        foreach($classes as $classe) {
            $stat=array();
            array_push($stat,$classe->getNom(),(($classe->getQuantite()) *100)/$totalQuantite);
            $nb=($classe->getQuantite() *100)/$totalQuantite;
            $stat=[$classe->getNom(),$nb];
            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentage des Produits par Quantité');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('StockBundle:Stock:Stat.html.twig', array('piechart' =>
            $pieChart));
    }

}