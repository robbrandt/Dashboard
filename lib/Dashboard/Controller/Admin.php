<?php

class Dashboard_Controller_Admin extends Zikula_AbstractController
{
    public function main()
    {
        $this->redirect(ModUtil::url($this->name, 'admin', 'config'));
    }

    public function config()
    {
        if (!SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }

        return $this->view->fetch('Admin/config.html.tpl');
    }

    public function updateconfig()
    {
        $this->checkCsrfToken();

        if (!SecurityUtil::checkPermission('Dashboard::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }

        $settings = $this->request->request->get('settings');

        if ($settings === null) {
            $this->redirect(ModUtil::url('Dashboard', 'admin', 'config'));
        }

        foreach ($settings as $key => $value) {
            if ($value != $this->getVar($key)) {
                $this->setVar($key, $value);
            }
        }

        LogUtil::registerStatus($this->__('Done! Saved configuration.'));

        $this->redirect(ModUtil::url('Dashboard', 'admin', 'config'));
    }
}
