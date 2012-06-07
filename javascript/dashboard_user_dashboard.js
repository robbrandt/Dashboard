// Copyright Zikula Foundation 2012 license LGPLv3+
document.observe('dom:loaded', dashboard_user_dashboard_init);

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


function dashboard_user_dashboard_init()
{
    $('dashboard_available_widgets_edit').observe('click', dashboard_user_dashboard_onclick);

    if (!$('dashboard_available_widgets_edit').checked) {
        $('dashboard_available_widgets_container').hide();
    }
}

function dashboard_user_dashboard_onclick()
{
    Zikula.checkboxswitchdisplaystate('dashboard_available_widgets_edit', 'dashboard_available_widgets_container', true);
}
