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

class Dashboard_Api_Admin extends Zikula_AbstractApi
{
    /**
     * @param $args
     *
     * @return false|void
     */
    public function registerWidget($args)
    {
        if (!SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_ADMIN)) {
           return LogUtil::registerPermissionError();
        }

        return Dashboard_Util::registerWidget($args['widget']);
    }

    /**
     * @param $args
     *
     * @return false|void
     */
    public function unregisterWidget($args)
    {
        if (!SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_ADMIN)) {
           return LogUtil::registerPermissionError();
        }

        return Dashboard_Util::unregisterWidget($args['name'], $args['module']);
    }

    /**
     * @param $args
     *
     * @return false|void
     */
    public function unregisterWidgets($args)
    {
        if (!SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_ADMIN)) {
           return LogUtil::registerPermissionError();
        }

        return Dashboard_Util::unregisterWidgets($args['module']);
    }
}
