<?php
/**
 * Copyright Zikula Foundation 2012
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

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
        $userWidgets = $this->em->createQuery("SELECT u FROM Dashboard_Entity_UserWidget u WHERE u.uid = $uid ORDER BY u.position")
            ->execute();

        $widgets = array();
        /* @var Dashboard_Entity_UserWidget $userWidget */
        foreach ($userWidgets as $userWidget) {
            $class = $userWidget->getClass();
            if (!class_exists($class)) {
                continue;
            }

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

            $event = new Zikula_Event(new Zikula_Event(Dashboard_Events::FILTER_WIDGET_CLASS, null, array(), $dbWidget->getClass()));
            $class = EventUtil::notify($event)->getData();
            if (!class_exists($class)) {
                continue;
            }

            /* @var Dashboard_AbstractWidget $widget */
            $widget = new $class();
            $widget->setId($dbWidget->getId());
            $widgets[] = $widget;
        }

        return $widgets;
    }
}
