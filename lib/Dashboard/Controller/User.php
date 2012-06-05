<?php

class Dashboard_Controller_User extends Zikula_AbstractController
{
    public function view()
    {
        if (!SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }

        $uid = $this->request->getSession()->get('uid');

        $helper = new Dashboard_Helper_WidgetHelper($this->entityManager);
        $dashboard = $helper->getUserWidgets($uid);

        $this->view->assign('userWidgets', $dashboard);

        $widgets = $helper->getRegisteredWidgets($uid);

        $this->view->assign('widgets', $widgets);

        return $this->view->fetch('User/view.html.tpl');
    }

    public function addWidget()
    {
        $this->checkCsrfToken($this->request->query->get('csrftoken', null));

        if (!SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }

        $position = $this->request->request->get('widget_position', 0);
        $widgetId = $this->request->query->get('id', null);
        if (null === $widgetId) {
            throw new Exception($this->__(sprintf('%s not found', $widgetId)));
        }

        $widget = $this->entityManager->getRepository('Dashboard_Entity_Widget')
            ->findOneBy(array('id' => $widgetId));

        if (!$widget) {
            throw new Exception(sprintf('Widget id %s not found', $widgetId));
        }

        $class = $widget->getClass();
        /* @var Dashboard_AbstractWidget $widget */
        $widget = new $class();
        if (false === ModUtil::available($widget->getModule())) {
            throw new Exception($this->__(sprintf('%s not available (disabled or not installed', $widget->getModule())));
        }

        $uid = $this->request->getSession()->get('uid');
        Dashboard_Util::addUserWidget($uid, $widget, $position);

        return $this->redirect(ModUtil::url('Dashboard', 'user', 'view'));
    }

    public function removeWidget()
    {
        $this->checkCsrfToken($this->request->query->get('csrftoken', null));

        if (!SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }

        $id = $this->request->query->get('id', null);
        if (null === $id) {
            throw new Exception($this->__('id not specified'));
        }

        Dashboard_Util::removeUserWidget($id);

        return $this->redirect(ModUtil::url('Dashboard', 'user', 'view'));
    }
}