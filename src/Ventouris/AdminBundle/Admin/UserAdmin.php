<?php
namespace Cuaround\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Cuaround\AdminBundle\Datagrid\DnnaProxyQuery;

class UserAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
    }

    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
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
            ->add('email')
            ->add('username')
            ->add('plainPassword', 'text', array('required' => false))
            ->add('address')
            ->add('latLngFromMapForm', 'oh_google_maps', array('include_gmaps_js' => true))
            ->add('preferredMusic', null, array('required' => false))
            ->add('preferredTransport', null, array('required' => false))
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
            ->add('email')
            ->add('username')
            ->add('address')
            ->add('latitude')
            ->add('longitude')
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
            ->add('username')
        ;
    }

    public function preUpdate($user)
    {
        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
    }

    public function setUserManager($userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->userManager;
    }
}