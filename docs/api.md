Example
=======

For a module to provide widgets for the dashboard API the module must register
itself as `dashboard` capable. This can be done in the module's `Version.php`:

    public function getMetaData()
    {
        $version = array();
        // ...
        $version['capabilities'] = array('dashboard' => array('version' => '1.0'));

        return $version;
    }

The module should then provide a Dashboard API which returns a Dashboard_WidgetCollection
instance like so:

    <?php

    class Example_Api_Dashboard extends Zikula_AbstractApi
    {
        /**
         * Example Api
         *
         * @param $args
         * @return array
         */
        public function getWidgets($args)
        {
            $widgets = new Dashboard_WidgetCollection();

            $widget = new Dashboard_Widget();
            $widget->setModule('dashboard');
            $widget->setTitle($this->__('Dashboard'));
            $widget->setUrl(ModUtil::url('Dashboard', 'user', 'view'));
            $widget->setIcon('dashboard.png');

            $widgets->add($widget);

            $widget = new Dashboard_Widget();
            $widget->setModule('dashboard');
            $widget->setTitle($this->__('Dashboard'));
            $widget->setUrl(ModUtil::url('Dashboard', 'user', 'view'));
            $widget->setIcon('dashboard.png');

            $widgets->add($widget);

            return $widgets;
        }
    }

After this, widgets will appear in the Dashboard (available from `My Account`).
