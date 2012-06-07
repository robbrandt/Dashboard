// Copyright Zikula Foundation 2012 license LGPLv3+
document.observe('dom:loaded', dashboard_user_dashboard_init);

function dashboard_user_dashboard_init()
{
    if (!$('dashboard_available_widgets_edit').checked) {
        $('dashboard_available_widgets_container').hide();
    }
}

function dashboard_add_widgets_onclick(state)
{
    var pars = { 'state': state };
    Zikula.checkboxswitchdisplaystate('dashboard_available_widgets_edit', 'dashboard_available_widgets_container', true);
    new Zikula.Ajax.Request("ajax.php?module=Dashboard&type=ajax&func=setAddState", {
        parameters: pars,
        onComplete: function (req) {
            if (!req.isSuccess()) {
                Zikula.showajaxerror(req.getMessage());
                return;
            }
            return;
        }
    });
}

