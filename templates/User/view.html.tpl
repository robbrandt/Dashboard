{gt text='Dashboard Widgets' assign='title'}
{pagesetvar name='title' value=$title}
<h2>{$title}</h2>

{foreach item='widget' from=$widgets}
<div class="z-dashboardlink" style="width:{math equation='100/x' x=$modvars.Dashboard.widgetsperrow format='%.0d'}%;">
    <a href="{$widget.url|safetext}">{img src=$widget.icon modname=$widget.module}</a><br />
    <a href="{$widget.url|safetext}">{$widget.title|safetext}</a>
</div>
{/foreach}
<br style="clear: left" />
