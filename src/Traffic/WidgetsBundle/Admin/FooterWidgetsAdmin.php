<?php

namespace Traffic\WidgetsBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Traffic\WidgetsBundle\Admin\WidgetsBaseAdmin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

class FooterWidgetsAdmin extends WidgetsBaseAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('abstract')
            ->add('backgroundImage', 'sonata_type_model_list', array(), array('link_parameters' => array(
                'context' => 'widgets',
                'provider' => 'sonata.media.provider.image'
            )))

            ->add('links', 'sonata_type_collection', array(
                    'cascade_validation' => false,
                    'type_options' => array('delete' => false),
                ), array(

                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                    'link_parameters' => array('context' => 'widgets'),
                    'admin_code' => 'sonata.admin.footer_widgets_has_media'
                )
            )
            ->add('enable', null, array('required' => false));
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        parent::configureDatagridFilters($datagridMapper);
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
      parent::configureListFields($listMapper);
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        //$collection->remove('create');
        $collection->remove('delete');
        $collection->remove('export');
        $collection->remove('show');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $filter)
    {
        parent::configureShowFields($filter);
    }

    public function validate(ErrorElement $errorElement, $object)
    {

        if (count($object->getLinks()) == 0) {
            $errorElement->with('links')->addViolation('Please select atleast one link')->end();
        } else {
            $enabled = 0;
            foreach ($object->getLinks() as $key => $val) {
                if (is_null($val->getMedia()) && $val->getDeleteFooter() == false) {
                    $errorElement->with('links')->addViolation('Please select image from media or click "Delete Link" checkbox to remove specific entry')->end();
                }
                if (is_null($val->getMediaHover()) && $val->getDeleteFooter() == false) {
                    $errorElement->with('links')->addViolation('Please select image from hver media or click "Delete Link" checkbox to remove specific entry')->end();
                }
                if ($val->getEnabled() && $val->getDeleteFooter() == false) {
                    $enabled++;

                }

            }
            if ($enabled > 2) {
                $errorElement->with('links')->addViolation('Maximum 2 links can be enabled at a time')->end();
            }
        }


    }

    public function prePersist($object)
    {

        // fix weird bug with setter object not being call
        $object->setLinks($object->getLinks());
        parent::prePersist($object);
    }

    function postPersist($object)
    {
        $this->removeMediaCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($object)
    {
        $object->setLinks($object->getLinks());
        parent::preUpdate($object);
        // fix weird bug with setter object not being call

    }

    function removeMediaCollection()
    {
        $DM = $this->getDoctrineManager();
        $q = $DM->createQuery('delete from Traffic\WidgetsBundle\Entity\FooterWidgetsHasMedia tb where tb.deleteFooter = 1');
        $q->execute();
    }

    public function postUpdate($object)
    {
        $this->removeMediaCollection();
    }

    public function getTemplate($name){
        if($name == 'list'){
            return 'TrafficWidgetsBundle::Admin/List/FooterWidgetsAdmin.html.twig';
        }else{
            return parent::getTemplate($name);
        }
    }
}