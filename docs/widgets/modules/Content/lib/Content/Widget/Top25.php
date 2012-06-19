<?php

/**
* The Content Module currently does not support registering widgets.  Until that time, you must run this manually to register this widget:
* INSERT INTO `dashboard_widget` VALUES(NULL, 'content_top25', 'content', 'Content_Widget_Top25');
*/

class Content_Widget_Top25 extends Dashboard_AbstractWidget
{
	
    protected $domain = 'module_content';

    public function getName()
    {
        return 'content_top25';
    }

    public function getTitle()
    {
        return $this->__('Top 25 Content Views');
    }

    public function getContent()
    {
    	
    	ModUtil::dbInfoLoad('Content');
    	$dbtables = DBUtil::getTables();
    	
    	
    	$query = "SELECT ".$dbtables['content_page_column']['id']." , ".$dbtables['content_page_column']['title'].", ".$dbtables['content_page_column']['views']." 
    	FROM ".$dbtables['content_page']."
	WHERE ".$dbtables['content_page_column']['views']." >= 0 AND ".$dbtables['content_page_column']['active']." >= 0 ORDER BY ".$dbtables['content_page_column']['views']." DESC LIMIT 25";
    	
    	$dbresult = DBUtil::executeSQL($query);
    	$views = DBUtil::marshallObjects($dbresult);
    	
    	$view = Zikula_View::getInstance('Content');
    	
    	$view->assign('views', $views);
    	
    	return $view->fetch('content_widget_top25.tpl');
 
    }

    public function getUrl()
    {
        return false;
    }

    public function getIcon()
    {
        return 'widget-top25.png';
    }
}
