<?php
namespace Ventouris\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class BookingAdmin extends Admin
{
    protected $datagridValues = array(
        '_sort_order' => 'DESC', // Descendant ordering (default = 'ASC')
        '_sort_by' => 'date' // name of the ordered field (default = the model id
    );

    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('date')
            ->add('venueName')
            ->add('bookerName')
            ->add('prName')
            ->add('maitreName')
            ->add('price')
            ->add('paid')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('date')
            ->add('venueName')
            ->add('bookerName')
            ->add('prName')
            ->add('maitreName')
            ->add('price')
            ->add('paid', null, array('required' => false))
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
            ->add('date')
            ->add('venueName')
            ->add('bookerName')
            ->add('prName')
            ->add('maitreName')
            ->add('price')
            ->add('paid')
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
            ->add('date')
            ->add('venueName')
            ->add('bookerName')
            ->add('prName')
            ->add('maitreName')
            ->add('price')
            ->add('paid')
        ;
    }
}