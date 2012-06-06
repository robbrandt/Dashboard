<?php

class Dashboard_Installer extends Zikula_AbstractInstaller
{
    /**
     * @return bool
     */
    public function install()
    {
        try {
            DoctrineHelper::createSchema($this->entityManager, array('Dashboard_Entity_Widget', 'Dashboard_Entity_UserWidget'));
        } catch (Exception $e) {
            return false;
        }

        $this->setVar('widgetsperrow', 5);
        $this->setVar('widgetsnewuser', 0);
        EventUtil::registerPersistentModuleHandler($this->name, 'installer.module.uninstalled',
                                                   array('Dashboard_Listener_UninstallListener', 'onUninstallModule'));

        EventUtil::registerPersistentModuleHandler($this->name, 'user.account.create',
                                                   array('Dashboard_Listener_CreateUserListener', 'onCreateUser'));

        EventUtil::registerPersistentModuleHandler($this->name, 'user.account.delete',
                                                   array('Dashboard_Listener_RemoveUserListener', 'onRemoveUser'));

        // this is just example code for debugging - todo - remove at module release (drak)
        Dashboard_Util::registerWidget(new Dashboard_Widget_Example());
        Dashboard_Util::registerWidget(new Dashboard_Widget_Example2());

        return true;
    }

    /**
     * @param string $oldversion
     *
     * @return bool|string
     */
    public function upgrade($oldversion)
    {
        return true;
    }

    /**
     * @return bool
     */
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