<?php

namespace NotificationChannels\OneSignal;

use Illuminate\Support\Arr;
use NotificationChannels\OneSignal\Traits\Categories\AppearanceHelpers;
use NotificationChannels\OneSignal\Traits\Categories\AttachmentHelpers;
use NotificationChannels\OneSignal\Traits\Categories\ButtonHelpers;
use NotificationChannels\OneSignal\Traits\Categories\DeliveryHelpers;
use NotificationChannels\OneSignal\Traits\Categories\GroupingHelpers;
use NotificationChannels\OneSignal\Traits\Categories\SilentHelpers;
use NotificationChannels\OneSignal\Traits\Deprecated;

class OneSignalMessage
{
    use AppearanceHelpers, AttachmentHelpers, ButtonHelpers, DeliveryHelpers, GroupingHelpers, SilentHelpers, Deprecated;

    /** @var array */
    protected $payload = [];

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
        $this->setBody($body);
    }

    /**
     * Set the message body.
     *
     * @param mixed $value
     *
     * @return $this
     */
    public function setBody($value)
    {
        return $this->setParameter('contents', $this->parseValueToArray($value));
    }

    /**
     * Set the message subject.
     *
     * @param mixed $value
     *
     * @return $this
     */
    public function setSubject($value)
    {
        return $this->setParameter('headings', $this->parseValueToArray($value));
    }

    /**
     * Set the message template_id.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setTemplate($value)
    {
        Arr::forget($this->payload, 'contents');

        return $this->setParameter('template_id', $value);
    }

    /**
     * @param mixed $value
     *
     * @return array
     */
    protected function parseValueToArray($value)
    {
        return (is_array($value)) ? $value : ['en' => $value];
    }

    /**
     * Set additional data.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function setData(string $key, $value)
    {
        return $this->setParameter("data.{$key}", $value);
    }

    /**
     * Set parameters.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function setParameter(string $key, $value)
    {
        Arr::set($this->payload, $key, $value);

        return $this;
    }

    /**
     * Get parameters.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getParameter(string $key, $default = null)
    {
        return Arr::get($this->payload, $key, $default);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->payload;
    }
}
