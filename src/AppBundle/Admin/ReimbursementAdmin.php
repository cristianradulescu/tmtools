<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class ReimbursementAdmin
 * @package AppBundle\Admin
 */
class ReimbursementAdmin extends AbstractAdmin
{
    /**
     * @var array
     */
    protected $datagridValues = array(
        '_sort_by' => 'date',
        '_sort_order' => 'DESC',
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('type')
            ->add('employee')
            ->add('value')
            ->add('date')
            ->add('number')

        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('employee')
            ->add('type')
            ->add('value')
            ->add('date')
            ->add('number')
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
            ->add('employee')
            ->add('type')
            ->add('value')
            ->add('date', 'sonata_type_date_picker', array('format' => 'dd-MM-yyyy'))
            ->add('number')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('employee')
            ->add('type')
            ->add('value')
            ->add('date')
            ->add('number')
        ;
    }
}
