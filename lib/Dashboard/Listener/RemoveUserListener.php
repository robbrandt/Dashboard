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

class Dashboard_Listener_RemoveUserListener
{
    /**
     * On an module remove hook call this listener
     *
     * Listens for the 'user.account.delete' event.
     *
     * @param Zikula_Event $event Event.
     */
    public static function onRemoveUser(Zikula_Event $event)
    {
        $user = $event->getSubject();

        Dashboard_Util::removeUserWidgets($user['uid']);
    }

}
