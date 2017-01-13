<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class DocumentAdmin
 * @package AppBundle\Admin
 */
abstract class DocumentAdmin extends AbstractAdmin
{
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
