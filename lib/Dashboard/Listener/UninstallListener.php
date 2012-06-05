<?php

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
