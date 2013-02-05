<?php
namespace Cuaround\SiteBundle\Extension;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Cuaround\UserBundle\Entity\User;
use Cuaround\SiteBundle\Entity\Destination;

class PointListener {
    public function prePersist(LifecycleEventArgs $lcea) {
        $object = $lcea->getEntity();
        if(!$object instanceof User && !$object instanceof Destination) {
            return;
        }

        $em = $lcea->getEntityManager();
        $metadata = $em->getMetadataFactory()->getMetadataFor(get_class($object));
        //update Point value
        if (!is_null($object->getLatitude()) && !is_null($object->getLongitude())
                && $object->getLatitude() != 0 && $object->getLongitude() != 0) {
            $dql = "UPDATE ".$metadata->table['name']." u
                SET u.point = PointFromWKB(Point(:lat, :lng))
                WHERE u.id = :uid";
            $em->getConnection()->executeUpdate($dql, array('uid' => $object->getId(), 'lat' => $object->getLatitude(), 'lng' => $object->getLongitude()));
        }
    }

    public function preUpdate(PreUpdateEventArgs $eventArgs) {
        $object = $eventArgs->getEntity();
        if(!$object instanceof User && !$object instanceof Destination) {
            return;
        }

        $em = $eventArgs->getEntityManager();
        $metadata = $em->getMetadataFactory()->getMetadataFor(get_class($object));
        //update Point value
        if ($eventArgs->hasChangedField('lastpointupdate') && !is_null($object->getLatitude()) && !is_null($object->getLongitude())
                && $object->getLatitude() != 0 && $object->getLongitude() != 0) {
            $dql = "UPDATE ".$metadata->table['name']." u
                SET u.point = PointFromWKB(Point(:lat, :lng))
                WHERE u.id = :uid";
            $em->getConnection()->executeUpdate($dql, array('uid' => $object->getId(), 'lat' => $object->getLatitude(), 'lng' => $object->getLongitude()));
        }
    }
}