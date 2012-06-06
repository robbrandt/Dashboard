<?php

use Doctrine\ORM\EntityManager;

/**
 * Widget helper class
 */
class Dashboard_Helper_WidgetHelper
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Gets the widgets for a given user ID.
     *
     * @param integer $uid
     *
     * @return array Collection of Dashboard_AbstractWidget
     */
    public function getUserWidgets($uid)
    {
        $userWidgets = $this->em->getRepository('Dashboard_Entity_UserWidget')
            ->findBy(array('uid' => $uid));

        $widgets = array();
        /* @var Dashboard_Entity_UserWidget $userWidget */
        foreach ($userWidgets as $userWidget) {
            $class = $userWidget->getClass();

            /* @var Dashboard_AbstractWidget $widget */
            $widget = new $class();
            if (!SecurityUtil::checkPermission('Dashboard::', "{$userWidget->getWidgetId()}:{$widget->getModule()}:$uid", ACCESS_READ)) {
                continue; // error
            }
            $widget->setPosition($userWidget->getPosition());
            $widget->setUserWidgetId($userWidget->getId());
            $widgets[] = $widget;
        }

        return $widgets;
    }

    /**
     * Gets all registered widgets
     *
     * @return array Collection of Dashboard_AbstractWidget
     */
    public function getRegisteredWidgets($uid)
    {
        $dbWidgets = $this->em->getRepository('Dashboard_Entity_Widget')
            ->findAll();

        $widgets = array();
        /* @var Dashboard_Entity_Widget $dbWidget */
        foreach ($dbWidgets as $dbWidget) {
            if (!SecurityUtil::checkPermission('Dashboard::', "{$dbWidget->getId()}:{$dbWidget->getModule()}:$uid", ACCESS_READ)) {
                continue; // error
            }
            $class = $dbWidget->getClass();

            /* @var Dashboard_AbstractWidget $widget */
            $widget = new $class();
            $widget->setId($dbWidget->getId());
            $widgets[] = $widget;
        }

        return $widgets;
    }
}
