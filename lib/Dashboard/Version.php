<?php

class Dashboard_Version extends Zikula_AbstractVersion
{
    public function getMetaData()
    {
        $version = array();
        $version['name'] = 'Dashboard';
        $version['displayname'] = $this->__('Dashboard');
        //! this is the URL that will be displayed for the module
        $version['url'] = $this->__('dashboard');
        $version['description'] = $this->__('Dashboard for Zikula');
        $version['version'] = '0.0.1';
        $version['contact'] = 'drak@zikula.org';
        $version['capabilities'] = array('dashboard_widget' => array('version' => '1.0'));
        $version['securityschema'] = array('Dashboard::' => '::');

        return $version;
    }

}