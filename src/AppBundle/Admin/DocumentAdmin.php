<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class DocumentAdmin
 * @package AppBundle\Admin
 */
class DocumentAdmin extends AbstractAdmin
{
    /**
     * @var array
     */
    protected $datagridValues = array(
        '_sort_by' => 'status.id',
        '_sort_order' => 'ASC',
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('employee')
            ->add('status')
            ->add('type')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('employee')
            ->add('status', 'string', array('template' => 'AppBundle:CRUD:list_field_status.html.twig'))
            ->add('type')
            ->add('totalAmount', '', array('label' => 'Total'))
            ->add('_action', null, array(
                'actions' => array(
                    'print' => array(
                        'template' => 'AppBundle:CRUD:list__action_print.html.twig'
                    ),
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
            ->add('status')
            ->add('type')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('employee')
            ->add('status')
            ->add('type');

        if ($this->getSubject()->isTravelDocument()) {
            $showMapper->add('travel');
        }

        if ($this->getSubject()->isReimbursementDocument()) {
            $showMapper->add('reimbursements');
        }

        $showMapper
            ->add('createdAt')
            ->add('updatedAt');
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('print');
    }

    /**
     * @return array
     */
    public function getBatchActions()
    {
        $actions =  parent::getBatchActions();
        $actions['markStatusPending'] = array(
            'label' => 'Mark as Pending',
            'ask_confirmation' => true
        );
        $actions['markStatusCompleted'] = array(
            'label' => 'Mark as Completed',
            'ask_confirmation' => true
        );

        return $actions;
    }
}
