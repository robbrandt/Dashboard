<?php

class Dashboard_Api_Dashboard extends Zikula_AbstractApi
{
    /**
     * Example Api
     *
     * @param $args
     * @return array
     */
    public function getWidgets($args)
    {
        $widgets = array();

        $widget = new Dashboard_Widget();
        $widget->setModule('dashboard');
        $widget->setTitle($this->__('Dashboard'));
        $widget->setUrl(ModUtil::url('Dashboard', 'user', 'view'));
        $widget->setIcon('dashboard.png');

        $widgets[] = $widget;

        $widget = new Dashboard_Widget();
        $widget->setModule('dashboard');
        $widget->setTitle($this->__('Dashboard'));
        $widget->setUrl(ModUtil::url('Dashboard', 'user', 'view'));
        $widget->setIcon('dashboard.png');

        $widgets[] = $widget;

        return $widgets;
    }
}
