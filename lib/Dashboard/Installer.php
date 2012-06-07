<?php
/**
 * Copyright Zikula Foundation 2012
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

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

        $this->setVar('widgets_per_row', 5);
        $this->setVar('available_per_row', 5);
        $this->setVar('new_user', 1);

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