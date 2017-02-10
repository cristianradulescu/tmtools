<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class TravelAdmin
 * @package AppBundle\Admin
 */
class TravelAdmin extends AbstractAdmin
{
    /**
     * @var array
     */
    protected $datagridValues = array(
        '_sort_by' => 'dateStart',
        '_sort_order' => 'DESC',
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
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
        $dateTimePickerSettings = array(
            'dp_side_by_side' => true,
            'format' => 'dd-MM-yyyy HH:mm'
        );

        $formMapper
            ->add('employee')
            ->add('purpose')
            ->add('destination')
            ->add('dateStart')
            ->add('dateStart', 'sonata_type_date_picker', array('format' => 'dd-MM-yyyy'))
            ->add('dateEnd', 'sonata_type_date_picker', array('format' => 'dd-MM-yyyy'))
            ->add('departureLeaveTime', 'sonata_type_datetime_picker', $dateTimePickerSettings)
            ->add('destinationArrivalTime', 'sonata_type_datetime_picker', $dateTimePickerSettings)
            ->add('destinationLeaveTime', 'sonata_type_datetime_picker', $dateTimePickerSettings)
            ->add('departureArrivalTime', 'sonata_type_datetime_picker', $dateTimePickerSettings)
            ->add('document')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('dateStart')
            ->add('dateEnd')
            ->add('departureLeaveTime')
            ->add('destinationArrivalTime')
            ->add('destinationLeaveTime')
            ->add('departureArrivalTime')
        ;
    }
}
