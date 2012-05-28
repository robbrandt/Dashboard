<?php

class Dashboard_Controller_User extends Zikula_AbstractController
{
    public function view($args)
    {
        if (!SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }

        $dashboardCapable = ModUtil::getModulesCapableOf('dashboard');
        $dashboard = new Dashboard_WidgetCollection();
        foreach ($dashboardCapable as $module) {
            $widgets = ModUtil::apiFunc($module['name'], 'dashboard', 'getWidgets');
            foreach ($widgets as $widget) {
                $dashboard->add($widget);
            }
        }

        $this->view->assign('widgets', $dashboard->getCollection());

        return $this->view->fetch('User/view.html.tpl');
    }
}