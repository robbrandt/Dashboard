<?php

class Dashboard_WidgetCollection extends Zikula_Collection_Container
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('dashboard');
    }

    public function add($value)
    {
        if (!$value instanceof Dashboard_Widget) {
            throw new \InvalidArgumentException('Must be an instance of Dashboard_Widget');
        }

        return parent::add($value);
    }

    public function set($key, $value)
    {
        if (!$value instanceof Dashboard_Widget) {
            throw new \InvalidArgumentException('Must be an instance of Dashboard_Widget');
        }

        return parent::set($key, $value);
    }
}
