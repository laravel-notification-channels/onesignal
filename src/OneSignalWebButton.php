<?php

namespace NotificationChannels\OneSignal;

class OneSignalWebButton
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $text;

    /** @var string */
    protected $icon;

    /** @var string */
    protected $url;

    /**
     * @param string $id
     *
     * @return static
     */
    public static function create($id)
    {
        return new static($id);
    }

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Set the message icon.
     *
     * @param string $value
     *
     * @return $this
     */
    public function icon($value)
    {
        $this->icon = $value;

        return $this;
    }

    /**
     * Set the message subject.
     *
     * @param string $value
     *
     * @return $this
     */
    public function text($value)
    {
        $this->text = $value;

        return $this;
    }

    /**
     * Set the message url.
     *
     * @param string $value
     *
     * @return $this
     */
    public function url($value)
    {
        $this->url = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id'   => $this->id,
            'text' => $this->text,
            'icon' => $this->icon,
            'url'  => $this->url,
        ];
    }
}
