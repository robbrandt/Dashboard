Example
=======

For a module to provide widgets for the dashboard API the module must regsiter
itself as `dashboard` capable. This can be done in the module's `Version.php`:

    public function getMetaData()
    {
        $version = array();
        // ...
        $version['capabilities'] = array('dashboard' => array('version' => '1.0'));

        return $version;
    }

The module should then provide a Dashboard API which returns an array of
widgets like so:

    <?php

    class Dashboard_Api_Dashboard extends Zikula_AbstractApi
    {
        /**
         * Example Api
         *
         * @param $args
         * @return array
         */
        public function getWidgets($args)
        {
            $widgets = array();

            $widget = new Dashboard_Widget();
            $widget->setModule('dashboard');
            $widget->setTitle($this->__('Dashboard'));
            $widget->setUrl(ModUtil::url('Dashboard', 'user', 'view'));
            $widget->setIcon('dashboard.png');

            $widgets[] = $widget;

            $widget = new Dashboard_Widget();
            $widget->setModule('dashboard');
            $widget->setTitle($this->__('Dashboard'));
            $widget->setUrl(ModUtil::url('Dashboard', 'user', 'view'));
            $widget->setIcon('dashboard.png');

            $widgets[] = $widget;

            return $widgets;
        }
    }

After this, widgets will appear in the Dashboard (available from `My Account`).
