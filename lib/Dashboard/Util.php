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

class Dashboard_Util
{
    public static function registerWidget(Dashboard_AbstractWidget $widget)
    {
        /* @var EntityManager $em */
        $em = ServiceUtil::getService('doctrine.entitymanager');

        $widgetEntity = new Dashboard_Entity_Widget();
        $widgetEntity->setClass($widget->getClass());
        $widgetEntity->setModule($widget->getModule());
        $widgetEntity->setName($widget->getName());

        $em->persist($widgetEntity);
        $em->flush();
    }

    public static function unregisterWidget($name, $module)
    {
        /* @var EntityManager $em */
        $em = ServiceUtil::getService('doctrine.entitymanager');

        /* @var Dashboard_Entity_Widget $widget */
        $widget = $em->getRepository('Dashboard_Entity_Widget')->findOneBy(array(
                                                                               'name' => $name,
                                                                               'module' => $module,
                                                                           ));

        // remove any user widgets
        $id = $widget->getId();
        $query = $em->createQuery("DELETE u FROM Dashboard_Entity_UserWidget u WHERE widget_id = $id");
        $query->execute();

        // remove widget
        $em->remove($widget);
        $em->flush();
    }

    /**
     * @param $module
     */
    public static function unregisterWidgets($module)
    {
        /* @var EntityManager $em */
        $em = ServiceUtil::getService('doctrine.entitymanager');

        $widgets = $em->getRepository('Dashboard_Entity_Widget')->findBy(array(
                                                                             'module' => $module,
                                                                         ));

        /* @var Dashboard_Entity_Widget $widget */
        foreach ($widgets as $widget) {
            // remove any user widgets
            $id = $widget->getId();
            $query = $em->createQuery("DELETE u FROM Dashboard_Entity_UserWidget u WHERE widget_id = $id");
            $query->execute();

            // remove widget
            $em->remove($widget);
        }

        $em->flush();
    }

    /**
     * @param integer                  $uid
     * @param Dashboard_AbstractWidget $widget
     * @param integer                  $position
     *
     * @return mixed
     */
    public static function addUserWidget($uid, $widget, $position = 0)
    {
        /* @var EntityManager $em */
        $em = ServiceUtil::getService('doctrine.entitymanager');

        /* @var Dashboard_Entity_Widget $widget */
        $widget = $em->getRepository('Dashboard_Entity_Widget')->findOneBy(array(
                                                                               'name' => $widget->getName(),
                                                                               'module' => $widget->getModule(),
                                                                           ));

        if (!SecurityUtil::checkPermission('Dashboard::', "{$widget->getId()}:{$widget->getModule()}:$uid", ACCESS_EDIT)) {
            return; // error
        }
        $userWidget = new Dashboard_Entity_UserWidget();
        $userWidget->setUid($uid);
        $userWidget->setWidgetId($widget->getId());
        $userWidget->setPosition($position);
        $userWidget->setClass($widget->getClass());

        $em->persist($userWidget);
        $em->flush();
    }

    /**
     * @param integer $id
     */
    public static function removeUserWidget($id)
    {
        /* @var EntityManager $em */
        $em = ServiceUtil::getService('doctrine.entitymanager');

        /* @var Dashboard_Entity_Widget $widget */
        $userWidget = $em->getRepository('Dashboard_Entity_UserWidget')->findOneBy(array(
                                                                               'id' => $id,
                                                                           ));

        $em->remove($userWidget);
        $em->flush();
    }

    /**
     * @param integer $uid
     */
    public static function removeUserWidgets($uid)
    {
        /* @var EntityManager $em */
        $em = ServiceUtil::getService('doctrine.entitymanager');

        /* @var Dashboard_Entity_Widget $widget */
        $widgets = $em->getRepository('Dashboard_Entity_UserWidget')->findBy(array(
                                                                               'uid' => $uid,
                                                                           ));

        foreach ($widgets as $widget) {
            $em->remove($widget);
        }

        $em->flush();
    }
}