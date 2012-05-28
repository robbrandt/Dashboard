<?php

class Dashboard_Widget implements \ArrayAccess
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $module;

    /**
     * @var string
     */
    private $icon;

    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets Url
     *
     * @param string $url
     *
     * @return Dashboard_Widget
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Gets Url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets Module
     *
     * @param string $module
     *
     * @return Dashboard_Widget
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Gets Module
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    // ArrayAccess interface implementation

    /**
     * Returns the value at the specified offset (see {@link ArrayAccess::offsetGet()}).
     *
     * @param mixed $key The offset to retrieve.
     *
     * @return mixed The value at the specified offset.
     *
     * @throws InvalidArgumentException Thrown if the key does not exist in the collection.
     */
    public function offsetGet($key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }

        throw new InvalidArgumentException(sprintf('Key %s does not exist in collection', $key));
    }

    /**
     * Set the value at the specified offset (see {@link ArrayAccess::offsetSet()}).
     *
     * @param mixed $key   The offset to retrieve.
     * @param mixed $value The value to set at the specified offset.
     *
     * @return mixed
     */
    public function offsetSet($key, $value)
    {
        $this->$key = $value;
    }

    /**
     * Indicate whether the specified offset is set (see {@link ArrayAccess::offsetExists()}).
     *
     * @param mixed $key The offset to check.
     *
     * @return boolean True if the offset is set, otherwise false.
     */
    public function offsetExists($key)
    {
        return isset($this->$key);
    }

    /**
     * Unset the specified offset (see {@link ArrayAccess::offsetUnset()}).
     *
     * @param mixed $key The offset to unset.
     */
    public function offsetUnset($key)
    {
        $this->$key = null;
    }
}
