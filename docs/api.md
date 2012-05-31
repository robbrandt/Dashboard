Example
=======

For a module to provide widgets for the dashboard API the module must register
widgets using the Admin API calls

    $widget = new Example_Widget_DisplayUsers();
    ModUtil::apiFunc('Dashboard', 'admin', 'registerWidget', array('widget' => $widget));

Similarly they can be removed by

    ModUtil::apiFunc('Dashboard', 'admin', 'registerWidget',
        array('name' => $name,
              'module' => $module,
        )
    );

Because the dashboard module may not be installed when widget capable modules
are installed, it is important to implement an event listener for

`installer.module.installed` which receives `$modinfo` as args
after a module is successfully installed. This will allow you to
retroactively register widgets when the Dashboard module is installed.

Widgets must implement the `Dashboard_AbstractWidget` class

Each method is explained:

  - `setContent()` sets the (HTML) content of the widget.
    This could typically return some function call.
  - `setModule()` sets the module owner of the widget.
  - `setPreview()` sets the widget mouse-over preview, if any.
  - `setUrl()` sets the URL the widget should link to, if any.
  - `setTitle()` sets the display title.
  - `setName()` sets the internal name of the widget.
  - `setIcon()` sets the name of any display icon (for add view).

Widgets will appear in the Dashboard (available from `My Account`).

    class Example_Widget_Foo extends Dashboard_AbstractWidget
    {
        protected $domain = 'module_example';

        public function getName()
        {
            return 'example_foo';
        }

        public function getTitle()
        {
            return $this->__('Example widget foo');
        }

        public function getContent()
        {
            return 'Example content foo';
        }

        public function getUrl()
        {
            return ModUtil::url('Dashboard', 'widget', 'example');
        }

        public function getIcon()
        {
            return 'foo.png'; // stored in module's image/ folder
        }
    }

