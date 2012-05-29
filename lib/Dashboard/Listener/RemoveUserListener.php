<?php

class Dashboard_Listener_RemoveUserListener
{
    /**
     * On an module remove hook call this listener
     *
     * Listens for the 'user.account.delete' event.
     *
     * @param Zikula_Event $event Event.
     */
    public static function remove(Zikula_Event $event)
    {
        $user = $event->getSubject();
    }

}
