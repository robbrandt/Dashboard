<?php

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
