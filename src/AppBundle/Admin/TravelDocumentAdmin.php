<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TravelDocumentAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('employee')
            ->add('purpose')
            ->add('destination')
            ->add('dateStart')
            ->add('dateEnd')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('employee')
            ->add('purpose')
            ->add('destination')
            ->add('dateStart')
            ->add('dateEnd')
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
            ->add('purpose')
            ->add('destination')
            ->add('dateStart')
            ->add('dateEnd')
            ->add('departureLeaveTime')
            ->add('departureArrivalTime')
            ->add('destinationArrivalTime')
            ->add('destinationLeaveTime')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('employee')
            ->add('purpose')
            ->add('destination')
            ->add('dateStart')
            ->add('dateEnd')
            ->add('departureLeaveTime')
            ->add('departureArrivalTime')
            ->add('destinationArrivalTime')
            ->add('destinationLeaveTime')
        ;
    }
}
