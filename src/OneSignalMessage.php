<?php

namespace NotificationChannels\OneSignal;

use Illuminate\Support\Arr;

class OneSignalMessage
{
    /** @var string */
    protected $body;

    /** @var string */
    protected $subject;

    /** @var string */
    protected $url;

    /** @var string */
    protected $icon;

    /** @var array */
    protected $data = [];

    /** @var array */
    protected $buttons = [];

    /** @var array */
    protected $webButtons = [];

    /**
     * @param string $body
     *
     * @return static
     */
    public static function create($body = '')
    {
        return new static($body);
    }

    /**
     * @param string $body
     */
    public function __construct($body = '')
    {
        $this->body = $body;
    }

    /**
     * Set the message body.
     *
     * @param string $value
     *
     * @return $this
     */
    public function body($value)
    {
        $this->body = $value;

        return $this;
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
    public function subject($value)
    {
        $this->subject = $value;

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
     * Set additional data.
     *
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function setData($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * Add a web button to the message.
     *
     * @param OneSignalWebButton $button
     *
     * @return $this
     */
    public function webButton(OneSignalWebButton $button)
    {
        $this->webButtons[] = $button->toArray();

        return $this;
    }

    /**
     * Add a native button to the message.
     *
     * @param OneSignalButton $button
     *
     * @return $this
     */
    public function button(OneSignalButton $button)
    {
        $this->buttons[] = $button->toArray();

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
            'web_buttons' => $this->webButtons,
            'chrome_web_icon' => $this->icon,
            'chrome_icon' => $this->icon,
            'adm_small_icon' => $this->icon,
            'small_icon' => $this->icon,
        ];

        foreach ($this->data as $data => $value) {
            Arr::set($message, 'data.'.$data, $value);
        }

        return $message;
    }
}
