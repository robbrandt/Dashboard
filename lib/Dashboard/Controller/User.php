<?php

class Dashboard_Controller_User extends Zikula_AbstractController
{
    public function view($args)
    {
        // security check
        if (!SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }

        return $this->view->fetch('User/view.html.tpl');
    }
}