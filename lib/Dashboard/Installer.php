<?php

class Dashboard_Installer extends Zikula_AbstractInstaller
{
    public function install()
    {
        $this->setVar('widgetsperrow', 5);

        return true;
    }

    public function upgrade($oldversion)
    {
        return true;
    }

    public function uninstall()
    {
        return true;
    }

}