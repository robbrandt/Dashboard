<?php


class Dashboard_Widget_Example extends Dashboard_AbstractWidget
{
    protected $domain = 'module_dashboard';

    public function getName()
    {
        return 'dashboard_example';
    }

    public function getTitle()
    {
        return $this->__('Example widget');
    }

    public function getContent()
    {
        return 'Example content';
    }

    public function getUrl()
    {
        return ModUtil::url('Dashboard', 'widget', 'example');
    }

    public function getIcon()
    {
        return 'dashboard.png';
    }
}
