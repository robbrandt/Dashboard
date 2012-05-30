{gt text='Dashboard Widgets' assign='title'}
{pagesetvar name='title' value=$title}
<h2>{$title}</h2>

{foreach item='widget' from=$widgets}
<div class="z-dashboardlink" style="width:{math equation='100/x' x=$modvars.Dashboard.widgetsperrow format='%.0d'}%;">
    {*{$widget->getPosition()}*}
    {*{$widget->getUserWidgetId()}*}
    {if $widget->getUrl()}
        <a href="{$widget->getUrl()}">{$widget->getContent()}</a><br />
        {$widget->getTitle()}
    {elseif $widget->getContent() neq null}
        {$widget->getContent()}<br />
        {$widget->getTitle()}
    {/if}
</div>
{/foreach}
<br style="clear: left"/>
