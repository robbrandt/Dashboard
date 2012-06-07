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

class Dashboard_Listener_CreateUserListener
{
    /**
     * On an module remove hook call this listener
     *
     * Listens for the 'user.account.create' event.
     *
     * @param Zikula_Event $event Event.
     */
    public static function onCreateUser(Zikula_Event $event)
    {
        if (!ModUtil::getVar('Dashboard', 'widgetsnewuser', false)) {
            return;
        }

        $user = $event->getSubject();

        $helper = new Dashboard_Helper_WidgetHelper(ServiceUtil::getService('doctrine.entitymanager'));
        $widgets = $helper->getRegisteredWidgets($user['uid']);

        foreach ($widgets as $widget) {
            Dashboard_Util::addUserWidget($user['uid'], $widget);
        }
    }

}
