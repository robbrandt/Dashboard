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
            </div>
        {/foreach}
    </div>
</div>
