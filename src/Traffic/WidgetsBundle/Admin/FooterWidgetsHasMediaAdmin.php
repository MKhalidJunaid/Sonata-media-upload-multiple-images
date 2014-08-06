<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Traffic\WidgetsBundle\Admin;

use Traffic\WidgetsBundle\Admin\WidgetsBaseAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class FooterWidgetsHasMediaAdmin extends WidgetsBaseAdmin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $link_parameters = array();

        if ($this->hasParentFieldDescription()) {
            $link_parameters = $this->getParentFieldDescription()->getOption('link_parameters', array());
        }

        if ($this->hasRequest()) {
            $context = $this->getRequest()->get('context', null);

            if (null !== $context) {
                $link_parameters['context'] = $context;
            }
        }

        $formMapper
            ->add('deleteFooter',null,array('label'=>'Delete Link','required' => false))
            ->add('media', 'sonata_type_model_list', array('required' => false), array(
                'link_parameters' => $link_parameters
            ))
            ->add('mediaHover', 'sonata_type_model_list', array('required' => false), array(
                'link_parameters' => $link_parameters
            ))
            ->add('enabled', null, array('required' => false))
            ->add('link', 'text', array('required' => false))
            ->add('position', 'hidden')


        ;
    }

    /**
     * @param  \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('media')
            ->add('gallery')
            ->add('position')
            ->add('enabled')
        ;
    }


}
