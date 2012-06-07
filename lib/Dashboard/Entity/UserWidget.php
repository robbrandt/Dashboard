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

use Doctrine\ORM\Mapping as ORM;

/**
 * Dashboard_Entity_UserWidget
 *
 * @ORM\Table(name="dashboard_userwidget")
 * @ORM\Entity(repositoryClass="Dashboard_Entity_Repository_UserWidget")
 */
class Dashboard_Entity_UserWidget
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $uid
     *
     * @ORM\Column(name="uid", type="integer")
     */
    private $uid;

    /**
     * @var integer $position
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position = 0;

    /**
     * @var integer $widget_id
     *
     * @ORM\Column(name="widget_id", type="integer")
     */
    private $widget_id;

    /**
     * @var string $class
     *
     * @ORM\Column(name="class", type="string", length=120)
     */
    private $class;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uid
     *
     * @param integer $uid
     *
     * @return Dashboard_Entity_UserWidget
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return integer 
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Dashboard_Entity_UserWidget
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set widget_id
     *
     * @param integer $widgetId
     *
     * @return Dashboard_Entity_UserWidget
     */
    public function setWidgetId($widgetId)
    {
        $this->widget_id = $widgetId;

        return $this;
    }

    /**
     * Get widget_id
     *
     * @return integer 
     */
    public function getWidgetId()
    {
        return $this->widget_id;
    }

    /**
     * Set class
     *
     * @param string $class
     *
     * @return Dashboard_Entity_UserWidget
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     *
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
}