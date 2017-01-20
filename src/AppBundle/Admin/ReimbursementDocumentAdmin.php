<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Reimbursement;
use AppBundle\Entity\ReimbursementDocument;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class ReimbursementDocumentAdmin
 * @package AppBundle\Admin
 */
class ReimbursementDocumentAdmin extends DocumentAdmin
{
    /**
     * @var array
     */
    protected $datagridValues = array(
        '_sort_by' => 'id',
        '_sort_order' => 'DESC',
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('employee')
            ->add('reimbursements')
            ->add('status')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('employee')
            ->add('shortFormat', null, array('label' => 'Reimbursements'))
            ->add('status', 'string', array('template' => 'AppBundle:CRUD:list_field_status.html.twig'))
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
        // restrict choices only to Reimbursement associated with the current document, or with no document.
        $choicesQuery = $this->getModelManager()->createQuery('AppBundle\Entity\Reimbursement', 'r')
            ->join('AppBundle\Entity\ReimbursementDocument', 'rd')
            ->where('r.reimbursementDocument is NULL');
        if (null !== $this->getSubject()->getId()) {
            $choicesQuery->orWhere('r.reimbursementDocument=:reimbursementDocument')
                ->setParameter('reimbursementDocument', $this->getSubject());
        }

        $formMapper
            ->add('status')
            ->add('employee')
            ->add(
                'reimbursements',
                'sonata_type_model',
                array(
                    'class' => 'AppBundle\Entity\Reimbursement',
                    'multiple' => true,
                    'query' => $choicesQuery
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
            ->add('status')
            ->add('employee')
            ->add('reimbursements')
        ;
    }

    /**
     * @param ReimbursementDocument $reimbursementDocument
     */
    public function prePersist($reimbursementDocument)
    {
        $this->updateAssociations($reimbursementDocument);
        parent::prePersist($reimbursementDocument);
    }

    /**
     * @param ReimbursementDocument $reimbursementDocument
     */
    public function preUpdate($reimbursementDocument)
    {
        $this->updateAssociations($reimbursementDocument);
        parent::preUpdate($reimbursementDocument);
    }

    /**
     * Update associations for create and edit pages.
     *
     * First, find the exising Reimbursements associated with the current ReimbursementDocument and clear the
     * association. Then set the assocation for the Reimbursements requested on the create/edit pages.
     *
     * @param ReimbursementDocument $reimbursementDocument
     */
    protected function updateAssociations(ReimbursementDocument $reimbursementDocument)
    {
        if (null !== $reimbursementDocument->getId()) {
            /** @var ModelManagerInterface $modelManager */
            $modelManager = $this->getModelManager();
            $reimbursementsQuery = $modelManager->createQuery('AppBundle\Entity\Reimbursement', 'r')
                ->join(
                    'AppBundle\Entity\ReimbursementDocument',
                    'rd',
                    'WITH',
                    'r.reimbursementDocument = :reimbursementDocument'
                )
                ->setParameter('reimbursementDocument', $reimbursementDocument);
            $reimbursements = $modelManager->executeQuery($reimbursementsQuery);
            foreach ($reimbursements as $reimbursement) {
                /** @var Reimbursement $reimbursement */
                $reimbursement->setReimbursementDocument(null);
            }
        }

        foreach ($reimbursementDocument->getReimbursements() as $reimbursement) {
            /** @var Reimbursement $reimbursement */
            $reimbursement->setReimbursementDocument($reimbursementDocument);
        }
    }
}
