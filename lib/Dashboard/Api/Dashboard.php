<?php

class Dashboard_Api_Dashboard extends Zikula_AbstractApi
{
    /**
     * Example Api
     *
     * @param array $args
     *
     * @return array
     */
    public function getWidgets($args)
    {
        $widgets = new Dashboard_WidgetCollection();

        $widget = new Dashboard_Widget(); // no link
        $widget->setName('one');
        $widget->setModule('dashboard');
        $widget->setTitle($this->__('Dashboard'));
        $widget->setContent('Content1');
        $widget->setPreview('Preview1');

        $widgets->add($widget);

        $widget = new Dashboard_Widget(); // with link
        $widget->setName('two');
        $widget->setModule('dashboard');
        $widget->setTitle($this->__('Dashboard'));
        $widget->setUrl(ModUtil::url('Dashboard', 'user', 'view'));
        $widget->setPreview('Preview Content Goes Here');
        $widget->setContent('Main Content goes here.');

        $widgets->add($widget);

        return $widgets;
    }
}
