{gt text='Dashboard Widgets' assign='title'}
{pagesetvar name='title' value=$title}
<h2>{$title}</h2>

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
    <a href="{modurl modname="Dashboard" type="user" func="addWidget" id="$id"}">Add</a>
</div>
{/foreach}
<hr>
{foreach item='userWidget' from=$userWidgets}
<div class="z-dashboardlink" style="width:{math equation='100/x' x=$modvars.Dashboard.widgetsperrow format='%.0d'}%;">
    {*{$userWidget->getPosition()}*}
    {*{$userWidget->getUserWidgetId()}*}
    {if $userWidget->getUrl()}
        <a href="{$userWidget->getUrl()}">{$userWidget->getContent()}</a><br />
        {$userWidget->getTitle()}
    {elseif $userWidget->getContent() neq null}
        {$userWidget->getContent()}<br />
        {$userWidget->getTitle()}
    {/if}
    <br />
    {assign var="id" value=$userWidget.userWidgetId}
    <a href="{modurl modname="Dashboard" type="user" func="removeWidget" id="$id"}">Remove</a>
</div>
{/foreach}
<br style="clear: left"/>
