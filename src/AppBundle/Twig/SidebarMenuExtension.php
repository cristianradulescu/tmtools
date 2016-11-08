<?php

namespace AppBundle\Twig;


class SidebarMenuExtension extends \Twig_Extension
{
    protected $menuItems = array();

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('sidebar_menu_items', array($this, 'getMenuItems'))
        );
    }

    public function getMenuItems()
    {
        return $this->menuItems;
    }

    public function setSidebarMenuDetails($parameters)
    {
        $this->menuItems = $parameters;
    }
}