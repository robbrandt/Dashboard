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
        $widgets = new Dashboard_WidgetCollection();

        $widget = new Dashboard_Widget();
        $widget->setModule('dashboard');
        $widget->setTitle($this->__('Dashboard'));
        $widget->setUrl(ModUtil::url('Dashboard', 'user', 'view'));
        $widget->setIcon('dashboard.png');

        $widgets->add($widget);

        $widget = new Dashboard_Widget();
        $widget->setModule('dashboard');
        $widget->setTitle($this->__('Dashboard'));
        $widget->setUrl(ModUtil::url('Dashboard', 'user', 'view'));
        $widget->setIcon('dashboard.png');

        $widgets->add($widget);

        return $widgets;
    }
}
