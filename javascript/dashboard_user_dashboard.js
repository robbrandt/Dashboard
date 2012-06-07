// Copyright Zikula Foundation 2012 license LGPLv3+
document.observe('dom:loaded', dashboard_user_dashboard_init);

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
