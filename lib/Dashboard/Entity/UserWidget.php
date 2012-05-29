<?php

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
    private $position;

    /**
     * @var integer $widget_id
     *
     * @ORM\Column(name="widget_id", type="integer")
     */
    private $widget_id;

    /**
     * @var string $module
     *
     * @ORM\Column(name="module", type="string", length=50)
     */
    private $module;


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
     * Set module
     *
     * @param string $module
     *
     * @return Dashboard_Entity_UserWidget
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string 
     */
    public function getModule()
    {
        return $this->module;
    }
}