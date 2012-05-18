<?php

class Dashboard_Api_Account extends Zikula_AbstractApi
{
    public function getAll($args)
    {
        $items = array();

        $items['1'] = array(
            'url'   => ModUtil::url($this->name, 'user', 'view'),
            'module'=> $this->name,
            'title' => $this->__('Dashboard'),
            'icon'  => 'dashboard.png'
        );

        return $items;
    }
}
