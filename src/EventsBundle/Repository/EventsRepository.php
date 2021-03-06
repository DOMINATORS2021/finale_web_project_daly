<?php

namespace EventsBundle\Repository;

/**
 * EventsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventsRepository extends \Doctrine\ORM\EntityRepository
{


    function Top5(){
        $query=$this->getEntityManager()
            ->createQuery("select c from EventsBundle:Events c ORDER BY c.nbr_participant DESC ");
        return $query->getResult();
    }

    function findByid($id){
        $query=$this->getEntityManager()
            ->createQuery("select r from EventsBundle:Events r WHERE r.id LIKE :id")
            ->setParameter('id','%'.$id.'%');
        return $query->getResult();
    }




}
