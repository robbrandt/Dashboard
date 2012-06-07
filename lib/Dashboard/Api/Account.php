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

class Dashboard_Api_Account extends Zikula_AbstractApi
{
    /**
     * @param $args
     *
     * @return array
     */
    public function getAll($args)
    {
        $items = array();

        $items['1'] = array(
            'url'   => ModUtil::url($this->name, 'user', 'view'),
            'module'=> $this->name,
            'title' => $this->__('Dashboard'),
            'icon'  => 'dashboard.png'
        );

        return $items;
    }
}
