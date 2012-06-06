<?php

class Dashboard_Version extends Zikula_AbstractVersion
{
    /**
     * @return array
     */
    public function getMetaData()
    {
        $version = array();
        $version['name'] = 'Dashboard';
        $version['displayname'] = $this->__('Dashboard');
        //! this is the URL that will be displayed for the module
        $version['url'] = $this->__('dashboard');
        $version['description'] = $this->__('Dashboard for Zikula');
        $version['version'] = '0.7.0';
        $version['contact'] = 'drak@zikula.org';
        $version['securityschema'] = array('Dashboard::' => '::');

        return $version;
    }

}