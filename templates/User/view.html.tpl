{ajaxheader modname="Dashboard" filename="dashboard_user_dashboard.js" noscriptaculous=true effects=true}
{ajaxheader modname="Dashboard" filename="dragsort.js" noscriptaculous=true effects=true}
{gt text='Dashboard Widgets' assign='title'}
{pagesetvar name='title' value=$title}
{insert name='csrftoken' assign="token"}
<h2>{$title}</h2>
<div id="dashboard_available_widgets">
    <label for="dashboard_available_widgets_edit">{gt text="Add widgets"}</label>
    <input id="dashboard_available_widgets_edit" name="dashboard" type="checkbox" value="0" />
    <hr>
    <div id="dashboard_available_widgets_container">
        <h3>Available Widgets</h3>
        {foreach item='widget' from=$widgets}
            <div class="z-dashboardwidgetcontainer" style="width:{math equation='100/x' x=$modvars.Dashboard.widgetsperrow format='%.0d'}%;">
                {assign var="module" value=$widget.module}
                {assign var="icon" value=$widget.icon}
                {if $icon}
                    {img modname="$module" src="$icon"}<br />
                {/if}
                {$widget->getTitle()}<br />
                {assign var="id" value=$widget.id}
                <a href="{modurl modname="Dashboard" type="user" func="addWidget" id="$id" csrftoken="$token"}">Add</a>
            </div>
        {/foreach}
        <hr>
    </div>
</div>
<div id="z-dashboardwidgetlist">
    <div id="widgets">
        {foreach item='userWidget' from=$userWidgets}
            {assign var="position" value=$userWidget.position}
            {assign var="id" value=$userWidget.userWidgetId}
            <div id="widget_{$id}" class="z-dashboardwidgetcontainer draggable" style="width:{math equation='100/x' x=$modvars.Dashboard.widgetsperrow format='%.0d'}%;">
                {img modname='Dashboard' src='mouse.png' __alt='Drag to sort' __title='Drag to sort' id="dragicon`$id`" class='z-dragicon'}

                {if $userWidget->getUrl()}
                    <a href="{$userWidget->getUrl()}">{$userWidget->getContent()}</a><br/>
                    {$userWidget->getTitle()}
                {elseif $userWidget->getContent() neq null}
                    {$userWidget->getContent()}<br/>
                    {$userWidget->getTitle()}
                {/if}
                <br/>
                <a href="{modurl modname="Dashboard" type="user" func="removeWidget" id="$id" csrftoken="$token"}">Remove</a>
            </div>
        {/foreach}
    </div>
</div>
<br style="clear: left"/>
