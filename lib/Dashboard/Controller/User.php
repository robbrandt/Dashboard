<?php

class Dashboard_Controller_User extends Zikula_AbstractController
{
    public function view($args)
    {
        if (!SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }

        $dashboardCapable = ModUtil::getModulesCapableOf('dashboard');
        $dashboard = array();
        foreach ($dashboardCapable as $module) {
            $widgets = ModUtil::apiFunc($module['name'], 'dashboard', 'getWidgets');
            foreach ($widgets->getCollection() as $widget) {
                $dashboard[] =$widget;
            }
        }

        $this->view->assign('widgets', $dashboard);

        return $this->view->fetch('User/view.html.tpl');
    }
}