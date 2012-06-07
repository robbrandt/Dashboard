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

class Dashboard_Listener_UninstallListener
{
    /**
     * On an module remove hook call this listener
     *
     * Listens for the 'installer.module.uninstalled' event.
     *
     * @param Zikula_Event $event Event.
     *
     * @return void
     */
    public static function onUninstallModule(Zikula_Event $event)
    {
        $moduleName = $event['name'];

        Dashboard_Util::unregisterWidgets($moduleName);
    }

}
