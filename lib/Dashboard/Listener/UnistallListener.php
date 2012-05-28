<?php

class UninstallListener
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
    public function uninstall(Zikula_Event $event)
    {
        $moduleName = $event['name'];
    }

}
