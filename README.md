Dashboard
=========

Dashboard module for Zikula Core 1.3+

Copyright Zikula Foundation 2012 license LGPLv3+

User-side, this module provides a Dashboard in the `My Account` panel and a block
for easy placement.  The module implements a simple UI to add and remove widgets,
and to order widgets with drag and drop.

Module developer side, this module provides a way for any module to register widgets
for display in the Dashboard.

Developer Example
-----------------

Widgets simply provide content to be displayed in the widget dashboard. They can return
any kind of HTML content. Widgets must be classes which implement the `Dashboard_AbstractWidget`
and follows the usual autoloading standards in Zikula `<Modname>_Widget_<Widgetname>` and
stored in the corresponding `Widget` folder.

Widgets are stored in 3rd party modules, not in the Dashboard module.

Each method is explained:

  - `getName()` sets the internal name of the widget (in lower case, e.g. `modname_widgetname`).
  - `getModule()` sets the module owner of the widget.
  - `getTitle()` sets the display title.
  - `setContent()` sets the (HTML) content of the widget.
    This could typically return some function call, `ModUtil::apiFunc()` call.
  - `getUrl()` sets the URL the widget should link to, if any.
  - `getIcon()` sets the name of any display icon (for widget add view).

An example is shown below:

    class Example_Widget_Foo extends Dashboard_AbstractWidget
    {
        protected $domain = 'module_example'; // translation domain

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
            return ModUtil::apiFunc('Dashboard', 'widget', 'foo');
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

Registering Widgets
-------------------

All widgets provided by a module must be registered with the Dashboard.
This is typically done in the module's `Installer.php`.

For example:

    $widget = new Example_Widget_DisplayUsers();
    ModUtil::apiFunc('Dashboard', 'admin', 'registerWidget', array('widget' => $widget));

The use of ModUtil::apiFunc() here avoids the need to check if the Dashboard module is
installed and active.

Similarly they can be removed by

    ModUtil::apiFunc('Dashboard', 'admin', 'registerWidget',
        array('name' => $name,
              'module' => $module,
        )
    );

Because widget providing modules may be installed before the Dashboard is installed,
it is important to register an event listener for `installer.module.installed` so
that widgets can be retroactively registered if/when the Dashboard module is installed.

Example:

    class Example_Listener_DashboardInstallListener
    {
        /**
         * On an module remove hook call this listener
         *
         * Listens for the 'installer.module.installed' event.
         *
         * @param Zikula_Event $event Event.
         */
        public static function onInstallModule(Zikula_Event $event)
        {
            if ($event['name'] == 'dashboard') {
                ModUtil::apiFunc('Dashboard', 'admin', 'registerWidget', array(
                    'widget' => new Example_Widget_Foo()
                ));

                ModUtil::apiFunc('Dashboard', 'admin', 'registerWidget', array(
                    'widget' => new Example_Widget_Foo2()
                ));
            }
        }
    }

This would be registered in the normal way using something like:

    EventUtil::registerPersistentModuleHandler($this->name, 'installer.module.uninstalled',
                                                   array('Example_Listener_InstallListener', 'onInstallModule'));

