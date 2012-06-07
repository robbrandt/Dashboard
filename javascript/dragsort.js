// Copyright Zikula Foundation 2012 license LGPLv3+

Event.observe(window, 'load', function() {
    make_widgets_sortable = function() {
        Sortable.create('widgets',{
            tag: 'div',
            constraint: "",
            only: Array("z-dashboardwidgetcontainer"),
            handle: 'z-dragicon',
            onUpdate: function(element){
                var pars = Sortable.serialize("widgets");
                //send the new order to the ajax controller
                new Zikula.Ajax.Request("ajax.php?module=Dashboard&type=ajax&func=sortWidgets", {
                    parameters: pars,
                    onComplete: function (req) {
                        if (!req.isSuccess()) {
                            Zikula.showajaxerror(req.getMessage());
                            return;
                        }
                        return;
                    }
                });
            return;
            }
        });
    }
    if ( $$("#widgets div").size() > 0) {
        make_widgets_sortable();
    }
});
