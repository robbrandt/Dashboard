<?php

class Dashboard_Controller_User extends Zikula_AbstractController
{
    public function view()
    {
        if (!SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }

        $uid = $this->request->getSession()->get('uid');

        $userWidgets = $this->entityManager->getRepository('Dashboard_Entity_UserWidget')
            ->findBy(array('uid' => $uid));

        $dashboard = array();
        /* @var Dashboard_Entity_UserWidget $userWidget */
        foreach ($userWidgets as $userWidget) {
            $class = $userWidget->getClass();

            /* @var Dashboard_AbstractWidget $widget */
            $widget = new $class();
            $widget->setPosition($userWidget->getPosition());
            $widget->setUserWidgetId($userWidget->getId());
            $dashboard[] = $widget;
        }

        $this->view->assign('userWidgets', $dashboard);

        $dbWidgets = $this->entityManager->getRepository('Dashboard_Entity_Widget')
            ->findAll();

        $widgets = array();
        /* @var Dashboard_Entity_Widget $dbWidget */
        foreach ($dbWidgets as $dbWidget) {
            $class = $dbWidget->getClass();

            /* @var Dashboard_AbstractWidget $widget */
            $widget = new $class();
            $widget->setId($dbWidget->getId());
            $widgets[] = $widget;

        }

        $this->view->assign('widgets', $widgets);

        return $this->view->fetch('User/view.html.tpl');
    }

    public function addWidget()
    {
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