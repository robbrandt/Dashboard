About the Dashboard module

The Dashboard module provides a way of telling administrators and users what
is happening on the site by displaying "widgets" that show summarized pieces of
information.  This may be text or javascript graphs or anything else that makes
sense.  Zikula module developers can start to provide widgets for the Dashboard
along with their modules much like they provide blocks, searches, mailz and
other features.  The widgets are placed at 
/modules/{modname}/lib/{modname}/Widgets/{widgetname}.php or 
/system/{modname}/lib/{modname}/Widgets/{widgetname}.php
Module developers should also provide Widget registration functions into their
modules so that the Dashboard can recognize that they are there.

Usage
A new icon shows in the My Account page for managing widgets.  Users can add
widgets that they are permissioned to use, and arrange their widgets by dragging
them around the page.  By default, this happens on the main Widget page from
My Account.  This is not a particularly convenient place for them however, so
you might want to create a block using the Dashboard Block and put it on your
site in a better place.  You might for example place it directly on the My
Account page itself, so that your users will have their widgets and their My
Account icons side by side.  Use "{block bid=(bid)}" to place the block.


Sample Widgets

Widgets are installed into the modules whose content they report on. Some 
sample widgets are provided in the docs/widgets folder that you can use.  You
can drag the files in the docs/widgets folder into your Zikula root and they 
should be placed where they need to be.

Hopefully module developers will begin to support the Dashboard and provide 
useful widgets along with their modules.

Until they do, however, each widget will have to be registered manually in
your Zikula installation.  I have placed some SQL in the header of each widget
at /modules/{modname}/lib/{modname}/Widgets/{widgetname}.php that will register
the module in Zikula.

The samples are:
Users: Users registered over the last 30 days
EZComments: Comments made over the last 30 days
Content: Top 25 Content Pages viewed

