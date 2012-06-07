<?php
/**
 * Copyright Zikula Foundation 2012
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

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
        $version['version'] = '0.9.0';
        $version['contact'] = 'drak@zikula.org';
        $version['securityschema'] = array('Dashboard::' => '::');

        return $version;
    }

}