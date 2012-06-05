<?php

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
