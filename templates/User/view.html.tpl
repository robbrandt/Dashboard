{ajaxheader modname="Dashboard" filename="dashboard_user_dashboard.js" noscriptaculous=true effects=true}
{ajaxheader modname="Dashboard" filename="dragsort.js" noscriptaculous=true effects=true}
{gt text='Dashboard Widgets' assign='title'}
{pagesetvar name='title' value=$title}
{insert name='csrftoken' assign="token"}
<h2>{$title}</h2>
<div class="z-clearfix" style="height:1000px;">
<div id="dashboard_available_widgets" class="z-clearfix">
    <form class="z-form" id="availablewidgetform" action="{modurl modname="Dashboard" type="user" func="addWidget"}" method="post" enctype="application/x-www-form-urlencoded">
        <input type="hidden" name="csrftoken" value="{$token}" />
        <label for="dashboard_available_widgets_edit">{gt text="Add widgets"}</label>
        {if $available_checkbox}
            <input id="dashboard_available_widgets_edit" name="available_checkbox" type="checkbox" value="0" onclick="dashboard_add_widgets_onclick(0)" checked/>
        {else}
            <input id="dashboard_available_widgets_edit" name="available_checkbox" type="checkbox" value="1" onclick="dashboard_add_widgets_onclick(1)" />
        {/if}
        <hr>
        <div id="dashboard_available_widgets_container" class="zx-clearfix">
            <h3>Available Widgets</h3>
            {foreach item='widget' from=$widgets}
                <div class="z-dashboardwidgetcontainer" style="width:{math equation='100/x' x=$modvars.Dashboard.available_per_row format='%.0d'}%;">
                    {assign var="module" value=$widget.module}
                    {assign var="icon" value=$widget.icon}
                    {if $icon}
                        {img modname="$module" src="$icon"}<br />
                    {/if}
                    {$widget->getTitle()}<br />
                    {assign var="id" value=$widget.id}
                    <span class="z-nowrap z-buttons">
                        <button id="dashboard_add_widget{$widget.id}" class="z-button z-bt-small" name="id" value="{$id}" type="submit">{gt text="Add"}</button>
                    </span>
                </div>
            {/foreach}
        </div>
    </form>
</div>
<hr>
<div id="z-dashboardwidgetlist" class="z-clearfix">
    <form class="z-form" id="widgetsform" action="{modurl modname="Dashboard" type="user" func="removeWidget"}" method="post" enctype="application/x-www-form-urlencoded">
        <input type="hidden" name="csrftoken" value="{$token}" />
        <div id="widgets" class="z-clearfix">
            {foreach item='userWidget' from=$userWidgets}
                {assign var="position" value=$userWidget.position}
                {assign var="id" value=$userWidget.userWidgetId}
                <div id="widget_{$id}" class="z-dashboardwidgetcontainer draggable" style="width:{math equation='100/x' x=$modvars.Dashboard.widgets_per_row format='%.0d'}%;">
                    {img modname='Dashboard' src='mouse.png' __alt='Drag to sort' __title='Drag to sort' id="dragicon`$id`" class='z-dragicon'}
                    {if $userWidget->getUrl()}
                        <a href="{$userWidget->getUrl()}">{$userWidget->getContent()}</a><br/>
                        {$userWidget->getTitle()}
                    {elseif $userWidget->getContent() neq null}
                        {$userWidget->getContent()}<br/>
                        {$userWidget->getTitle()}
                    {/if}
                    <br/>
                    <span class="z-nowrap z-buttons">
                        <button id="dashboard_remove_widget{$widget.id}" class="z-button z-bt-small" name="id" value="{$id}" type="submit">{gt text="Remove"}</button>
                    </span>
                </div>
            {/foreach}
        </div>
    </form>
</div>
</div>
