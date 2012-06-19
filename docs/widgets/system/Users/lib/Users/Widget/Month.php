<?php

/**
* The Users Module currently does not support registering widgets.  Until that time, you must run this manually to register this widget:
* INSERT INTO `dashboard_widget` VALUES(NULL, 'users_month', 'users', 'Users_Widget_Month');
*/

class Users_Widget_Month extends Dashboard_AbstractWidget
{
	
    protected $domain = 'module_users';

    public function getName()
    {
        return 'users_month';
    }

    public function getTitle()
    {
        return $this->__('Users, Last 30 Days');
    }

    public function getContent()
    {
    	$dbtables = DBUtil::getTables();
    	
    	$query = "SELECT ".$dbtables['users_column']['user_regdate']." , DATE_FORMAT( ".$dbtables['users_column']['user_regdate'].", '%Y-%m-%d' ) AS dateval, COUNT( DATE_FORMAT( ".$dbtables['users_column']['user_regdate'].", '%Y-%m-%d' ) ) AS datetotal 
    	FROM ".$dbtables['users']."
	WHERE ".$dbtables['users_column']['user_regdate']." >= ( CURDATE( ) - INTERVAL 1 MONTH ) GROUP BY dateval";
    	
    	$dbresult = DBUtil::executeSQL($query);
    	$results = DBUtil::marshallObjects($dbresult);
    	foreach($results AS $key=>$result){
    		$registrations[$result['dateval']] = $result['datetotal'];
    	}
    	
    	$date = new DateTime();
    	$date->sub(new DateInterval('P30D'));
    	for($i=0;$i<30;$i++){
		$date->add(new DateInterval('P1D'));
		if (isset($registrations[$date->format('Y-m-d')])){
			$days[$date->format('Y-m-d')] = $registrations[$date->format('Y-m-d')];
		} else {
			$days[$date->format('Y-m-d')] = 0;
		}

    		
    	}
    	
    	$view = Zikula_View::getInstance('Users');
    	
    	$view->assign('days', $days);
    	
    	return $view->fetch('users_widget_month.tpl');
    	
    	
        return $content;
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
