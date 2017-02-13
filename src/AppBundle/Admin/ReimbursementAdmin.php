<?php

namespace AppBundle\Admin;

use AppBundle\Entity\DocumentStatus;
use AppBundle\Entity\DocumentType;
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
            ->add('document')
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
            ->add('date', 'date', array(
                'format' => 'd M Y'
            ))
            ->add('status',
                'string',
                array(
                    'template' => 'AppBundle:CRUD:list_field_status.html.twig'
                )
            )
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
        $choicesQuery = $this->getModelManager()->createQuery('AppBundle\Entity\Document', 'doc')
            ->where('doc.status = :status')
            ->andWhere('doc.type = :type')
            ->setParameter('status', DocumentStatus::STATUS_NEW)
            ->setParameter('type', DocumentType::TYPE_REIMBURSEMENT);

        $formMapper
            ->add('employee')
            ->add('type')
            ->add('value')
            ->add('date', 'sonata_type_date_picker', array('format' => 'dd-MM-yyyy'))
            ->add('number')
            ->add('document',
                'sonata_type_model',
                array('class' => 'AppBundle\Entity\Document',
                    'multiple' => false,
                    'query' => $choicesQuery,
                    'btn_add' => false,
                    'placeholder' => '',
                    'required' => false
                )
            )
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
            ->add('document')
        ;
    }
}
