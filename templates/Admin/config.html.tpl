{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="config" size="small"}
    <h3>{gt text="Dashboard settings"}</h3>
</div>

<form class="z-form" action="{modurl modname="Dashboard" type="admin" func="updateconfig"}" method="post" enctype="application/x-www-form-urlencoded">
    <div>
        <input type="hidden" name="csrftoken" value="{insert name='csrftoken'}" />
        <fieldset>
            <legend>{gt text="Main info"}</legend>
            <div class="z-formrow">
                <label for="dashboard_widgetsperrow">{gt text="Widgets per row"}</label>
                <input id="dashboard_widgetsperrow" type="text" name="settings[widgetsperrow]" value="{$modvars.Dashboard.widgetsperrow|safetext}" size="3" maxlength="3" />
            </div>
        </fieldset>

        <div class="z-buttons z-formbuttons">
            {button src="button_ok.png" set="icons/extrasmall" __alt="Save" __title="Save" __text="Save"}
            <a href="{modurl modname="Dashboard" type="admin" func="config"}" title="{gt text="Cancel"}">{img modname=core src="button_cancel.png" set="icons/extrasmall" __alt="Cancel" __title="Cancel"} {gt text="Cancel"}</a>
        </div>
    </div>
</form>
{adminfooter}