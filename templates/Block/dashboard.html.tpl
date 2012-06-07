{foreach item='userWidget' from=$userWidgets}
<div class="z-dashboardwidgetcontainer" style="width:{math equation='100/x' x=$modvars.Dashboard.widgetsperrow format='%.0d'}%;">
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
</div>
{/foreach}