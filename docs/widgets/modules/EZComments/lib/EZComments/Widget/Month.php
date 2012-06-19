<?php

/**
* The EZComments Module currently does not support registering widgets.  Until that time, you must run this manually to register this widget:
* INSERT INTO `dashboard_widget` VALUES(NULL, 'ezcomments_month', 'ezcomments', 'EZComments_Widget_Month');
*/

class EZComments_Widget_Month extends Dashboard_AbstractWidget
{
	
    protected $domain = 'module_ezcomments';

    public function getName()
    {
        return 'ezcomments_month';
    }

    public function getTitle()
    {
        return $this->__('Comments, Last 30 Days');
    }

    public function getContent()
    {
    	
    	ModUtil::dbInfoLoad('EZComments');
    	
    	$dbtables = DBUtil::getTables();
    	
    	$query = "SELECT ".$dbtables['EZComments_column']['date']." , DATE_FORMAT( ".$dbtables['EZComments_column']['date'].", '%Y-%m-%d' ) AS dateval, COUNT( DATE_FORMAT( ".$dbtables['EZComments_column']['date'].", '%Y-%m-%d' ) ) AS datetotal 
    	FROM ".$dbtables['EZComments']."
	WHERE ".$dbtables['EZComments_column']['date']." >= ( CURDATE( ) - INTERVAL 1 MONTH ) GROUP BY dateval ORDER BY ".$dbtables['EZComments_column']['date']." ASC";
    	
    	$dbresult = DBUtil::executeSQL($query);
    	$results = DBUtil::marshallObjects($dbresult);
    	foreach($results AS $key=>$result){
    		$comments[$result['dateval']] = $result['datetotal'];
    	}
    	
    	$date = new DateTime();
    	$date->sub(new DateInterval('P30D'));
    	for($i=0;$i<30;$i++){
		$date->add(new DateInterval('P1D'));
		if (isset($comments[$date->format('Y-m-d')])){
			$days[$date->format('Y-m-d')] = $comments[$date->format('Y-m-d')];
		} else {
			$days[$date->format('Y-m-d')] = 0;
		}

    		
    	}
    	
    	$view = Zikula_View::getInstance('EZComments');
    	
    	$view->assign('days', $days);
    	
    	return $view->fetch('ezcomments_widget_month.tpl');
 
    }

    public function getUrl()
    {
        return false;
    }

    public function getIcon()
    {
        return 'widget-monthly.png';
    }
}
