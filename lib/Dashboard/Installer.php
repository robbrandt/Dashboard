<?php

class Dashboard_Installer extends Zikula_AbstractInstaller
{
    public function install()
    {
//        try {
            DoctrineHelper::createSchema($this->entityManager, array('Dashboard_Entity_Widget', 'Dashboard_Entity_UserWidget'));
//        } catch (Exception $e) {
//            return false;
//        }

        $this->setVar('widgetsperrow', 5);
        EventUtil::registerPersistentModuleHandler($this->name, 'installer.module.uninstalled', array('Dashboard_Listener_UninstallListener', 'uninstall'));
        EventUtil::registerPersistentModuleHandler($this->name, 'user.account.delete', array('Dashboard_Listener_RemoveUserListener', 'remove'));

        return true;
    }

    public function upgrade($oldversion)
    {
        return true;
    }

    public function uninstall()
    {
        try {
            DoctrineHelper::dropSchema($this->entityManager, array('Dashboard_Entity_Widget', 'Dashboard_Entity_UserWidget'));
        } catch (Exception $e) {
            return false;
        }

        EventUtil::unregisterPersistentModuleHandlers($this->name);

        return true;
    }

}