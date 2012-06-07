<?php


class Dashboard_Widget_Example2 extends Dashboard_AbstractWidget
{
    protected $domain = 'module_dashboard';

    public function getName()
    {
        return 'dashboard_example2';
    }

    public function getTitle()
    {
        return $this->__('Example2 widget');
    }

    public function getContent()
    {
        return 'Example2 content';
    }

    public function getUrl()
    {
        return ModUtil::url('Dashboard', 'widget', 'example');
    }
}
