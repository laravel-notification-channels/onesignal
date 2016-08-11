<?php

namespace NotificationChannels\OneSignalNotifications;

use Illuminate\Support\Arr;

/**
 * Class Message
 * @package NotificationChannels\OneSignalNotifications
 */
class Message
{
    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $buttons = [];

    /**
     * @var array
     */
    protected $web_buttons = [];

    /**
     * @param string $body
     */
    public function __construct($body = '')
    {
        $this->body = $body;
    }

    /**
     * Set the message body
     *
     * @param string $value
     * @return $this
     */
    public function body($value)
    {
        $this->body = $value;

        return $this;
    }

    /**
     * Set the message icon
     *
     * @param string $value
     * @return $this
     */
    public function icon($value)
    {
        $this->icon = $value;

        return $this;
    }

    /**
     * Set the message subject
     *
     * @param string $value
     * @return $this
     */
    public function subject($value)
    {
        $this->subject = $value;

        return $this;
    }

    /**
     * Set the message url
     *
     * @param string $value
     * @return $this
     */
    public function url($value)
    {
        $this->url = $value;

        return $this;
    }

    /**
     * Set additional data
     *
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function setData($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * Add a web button to the message
     *
     * @param string $id
     * @param string $text
     * @param string $icon
     * @param string $url
     *
     * @return $this
     */
    public function webButton($id, $text, $icon, $url)
    {
        $this->web_buttons[] = [
            'id' => $id,
            'text' => $text,
            'icon' => $icon,
            'url' => $url
        ];

        return $this;
    }

    /**
     * Add a native button to the message
     *
     * @param string $id
     * @param string $text
     * @param string $icon
     *
     * @return $this
     */
    public function button($id, $text, $icon)
    {
        $this->buttons[] = [
            'id' => $id,
            'text' => $text,
            'icon' => $icon
        ];

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $message = [
            'contents' => ['en' => $this->body],
            'headings' => ['en' => $this->subject],
            'url' => $this->url,
            'buttons' => $this->buttons,
            'web_buttons' => $this->web_buttons,
        ];

        foreach ($this->data AS $data => $value) {
            Arr::set($message, 'data.'.$data, $value);
        }

        return $message;
    }
}
