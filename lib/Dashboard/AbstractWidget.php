<?php

abstract class Dashboard_AbstractWidget implements Zikula_TranslatableInterface, ArrayAccess
{
    /**
     * @var string
     */
    protected $domain;

    /**
     * @var integer
     */
    protected $position;

    /**
     * @var integer
     */
    protected $userWidgetId;

    /**
     * @var integer
     */
    protected $id;

    /**
     * Gets Content
     *
     * @return string
     */
    abstract public function getContent();

    /**
     * Gets Module
     *
     * @return string
     */
    public function getModule()
    {
        $class = get_class($this);

        return strtolower(substr($class, 0, strpos($class, '_')));
    }

    public static function getClass()
    {
        return get_called_class();
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Gets Name
     *
     * @return string
     */
    abstract public function getName();

    /**
     * Gets Preview
     *
     * @return string
     */
    public function getPreview()
    {
    }

    /**
     * Gets Icon name
     *
     * @return string
     */
    public function getIcon()
    {
        return 'dashboard.png';
    }

    /**
     * Gets Title
     *
     * @return string
     */
    abstract public function getTitle();

    /**
     * Gets Url
     *
     * @return string
     */
    abstract public function getUrl();

    /**
     * Sets UserWidgetId
     *
     * @param int $userWidgetId
     *
     * @return Dashboard_AbstractWidget
     */
    public function setUserWidgetId($userWidgetId)
    {
        $this->userWidgetId = $userWidgetId;

        return $this;
    }

    /**
     * Gets UserWidgetId
     *
     * @return int
     */
    public function getUserWidgetId()
    {
        return $this->userWidgetId;
    }

    /**
     * Sets Domain
     *
     * @param string $domain
     *
     * @return Dashboard_AbstractWidget
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Gets Domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Translate.
     *
     * @param string $msgid String to be translated.
     *
     * @return string
     */
    public function __($msgid)
    {
        return __($msgid, $this->domain);
    }

    /**
     * Translate with sprintf().
     *
     * @param string       $msgid  String to be translated.
     * @param string|array $params Args for sprintf().
     *
     * @return string
     */
    public function __f($msgid, $params)
    {
        return __f($msgid, $params, $this->domain);
    }

    /**
     * Translate plural string.
     *
     * @param string $singular Singular instance.
     * @param string $plural   Plural instance.
     * @param string $count    Object count.
     *
     * @return string Translated string.
     */
    public function _n($singular, $plural, $count)
    {
        return _n($singular, $plural, $count, $this->domain);
    }

    /**
     * Translate plural string with sprintf().
     *
     * @param string       $sin    Singular instance.
     * @param string       $plu    Plural instance.
     * @param string       $n      Object count.
     * @param string|array $params Sprintf() arguments.
     *
     * @return string
     */
    public function _fn($sin, $plu, $n, $params)
    {
        return _fn($sin, $plu, $n, $params, $this->domain);
    }


    public function __toString()
    {
        return $this->getContent();
    }

    /**
     * Sets Id
     *
     * @param int $id
     *
     * @return Dashboard_AbstractWidget
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function offsetGet($key)
    {
        $method = 'get'.ucwords($key);
        if (method_exists($this, $method)) {
            return $this->$method($key);
        }

        if (property_exists($this, $key)) {
            return $this->$key;
        }

        throw new InvalidArgumentException(sprintf('method %s nor property %s not found', $method, $key));
    }

    public function offsetSet($key, $value)
    {
        $method = 'set'.ucwords($key);
        if (method_exists($this, $method)) {
            return $this->$method($key, $value);
        }

        if (property_exists($this, $key)) {
            return $this->$key = $value;
        }

        throw new InvalidArgumentException(sprintf('method %s nor property %s not found', $method, $key));
    }

    public function offsetUnset($key)
    {
        return $this->offsetSet($key, null);
    }

    public function offsetExists($key)
    {
        return (bool) $this->offsetGet($key);
    }
}
