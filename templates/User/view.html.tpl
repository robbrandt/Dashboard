{gt text='Dashboard Widgets' assign='title'}
{pagesetvar name='title' value=$title}
<h2>{$title}</h2>

{foreach item='widget' from=$widgets}
<div class="z-dashboardlink" style="width:{math equation='100/x' x=$modvars.Dashboard.widgetsperrow format='%.0d'}%;">
    {if $widget->getUrl()}
        <a href="{$widget.url}">{$widget.content}</a><br />
        {$widget.title}
    {elseif $widget->getContent() neq null}
        {$widget->getContent()}<br />
        {$widget.title}
    {/if}
</div>
{/foreach}
<br style="clear: left"/>
