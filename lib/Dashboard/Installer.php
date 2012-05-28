<?php

class Dashboard_Installer extends Zikula_AbstractInstaller
{
    public function install()
    {
        $this->setVar('widgetsperrow', 5);
        EventUtil::registerPersistentModuleHandler($this->name, 'installer.module.uninstalled', array('Dashboard_UninstallListener', 'uninstall'));

        return true;
    }

    public function upgrade($oldversion)
    {
        return true;
    }

    public function uninstall()
    {
        EventUtil::unregisterPersistentModuleHandlers($this->name);

        return true;
    }

}