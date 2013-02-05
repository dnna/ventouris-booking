<?php
namespace Cuaround\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class DestinationAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('tel')
            ->add('address')
            ->add('municipality')
            ->add('fromprice')
            ->add('toprice')
            ->add('openfrom')
            ->add('openuntil')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $times = array();
        for($i = 1; $i <= 24; $i++) {
            $times[sprintf("%02d", $i).':00'] = sprintf("%02d", $i).':00';
        }

        $formMapper
            ->add('name')
            ->add('tel')
            ->add('address')
            ->add('municipality')
            ->add('latLngFromMapForm', 'oh_google_maps', array('include_gmaps_js' => true))
            ->add('fromprice')
            ->add('toprice')
            ->add('openfrom', 'choice', array('choices' => $times))
            ->add('openuntil', 'choice', array('choices' => $times))
            ->add('musictypes')
            //->add('zones', null, array('required' => false))
            ->add('purposes')
            ->add('famous', null, array('required' => false))
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper, $params = array())
    {
        $actions = array(
            'view' => array(),
            'edit' => array(),
        );
        $listMapper
            ->add('_action', 'actions', array(
                'actions' => $actions
            ));
        $listMapper->addIdentifier('id')
            ->add('name')
            ->add('tel')
            ->add('address')
            ->add('municipality')
            ->add('fromprice')
            ->add('toprice')
            ->add('openfrom')
            ->add('openuntil')
            ->add('famous')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('municipality')
        ;
    }
}