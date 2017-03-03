<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class BillAdmin
 * @package AppBundle\Admin
 */
class BillAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('number')
            ->add('date')
            ->add('value')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('acquisition.service', null, array('label' => 'Service'))
            ->add('number')
            ->add('date', 'date', array('format' => 'd M Y'))
            ->add('value')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('number')
            ->add('value')
            ->add('date', 'sonata_type_date_picker', array('format' => 'dd-MM-yyyy'))
            ->add('dueDate', 'sonata_type_date_picker', array('format' => 'dd-MM-yyyy'))
            ->add('acquisition')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('number')
            ->add('value')
            ->add('date')
            ->add('dueDate')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
