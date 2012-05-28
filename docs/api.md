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

Note, after adding a new capability, you need to view the Extensions module list view
once to generate the capabilities meta-data.

The module should then provide a Dashboard API which returns a `Dashboard_WidgetCollection`.

The `Dashboard_WidgetCollection` should contain `Dashboard_Widget` instances which explain
the behaviour of the widget.

Each method is explained:

  - `setContent()` sets the (HTML) content of the widget.
    This could typically return some function call.
  - `setModule()` sets the module owner of the widget.
  - `setPreview()` sets the widget mouse-over preview, if any.
  - `setUrl()` sets the URL the widget should link to, if any.
  - `setTitle()` sets the display title.
  - `setName()` sets the internal name of the widget.

Here is an example of an API used to collect widgets. Note it must be called
`<modulename>_Api_Dashboard` and have the method `getWidgets()` and return
a collection as detailed below:

    <?php

    class Example_Api_Dashboard extends Zikula_AbstractApi
    {
        /**
        * Example Api
        *
        * @param array $args
        *
        * @return array
        */
        public function getWidgets($args)
        {
            $widgets = new Dashboard_WidgetCollection();

            $widget = new Dashboard_Widget(); // no link
            $widget->setName('one');
            $widget->setModule('dashboard');
            $widget->setTitle($this->__('Dashboard'));
            $widget->setContent('Content1');
            $widget->setPreview('Preview1');

            $widgets->add($widget);

            $widget = new Dashboard_Widget(); // with link
            $widget->setName('two');
            $widget->setModule('dashboard');
            $widget->setTitle($this->__('Dashboard'));
            $widget->setUrl(ModUtil::url('Dashboard', 'user', 'view'));
            $widget->setPreview('Preview Content Goes Here');
            $widget->setContent('Main Content goes here.');

            $widgets->add($widget);

            return $widgets;
        }
}

After this, widgets will appear in the Dashboard (available from `My Account`).
