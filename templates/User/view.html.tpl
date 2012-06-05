{ajaxheader modname="Dashboard" filename="dashboard_user_dashboard.js" noscriptaculous=true effects=true}
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
            <div class="z-dashboardlink" style="width:{math equation='100/x' x=$modvars.Dashboard.widgetsperrow format='%.0d'}%;">
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
{foreach item='userWidget' from=$userWidgets}
<div class="z-dashboardlink" style="width:{math equation='100/x' x=$modvars.Dashboard.widgetsperrow format='%.0d'}%;">
    {*{$userWidget->getPosition()}*}
    {*{$userWidget->getUserWidgetId()}*}
    {if $userWidget->getUrl()}
        <a href="{$userWidget->getUrl()}">{$userWidget->getContent()}</a><br/>
        {$userWidget->getTitle()}
        {elseif $userWidget->getContent() neq null}
            {$userWidget->getContent()}<br/>
        {$userWidget->getTitle()}
    {/if}
    <br/>
    {assign var="id" value=$userWidget.userWidgetId}
    <a href="{modurl modname="Dashboard" type="user" func="removeWidget" id="$id" csrftoken="$token"}">Remove</a>
</div>
{/foreach}
<br style="clear: left"/>
