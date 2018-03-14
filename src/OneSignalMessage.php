<?php

namespace NotificationChannels\OneSignal;

use Illuminate\Support\Arr;
use NotificationChannels\OneSignal\Traits\OneSignalHelpers;

class OneSignalMessage
{

    use OneSignalHelpers;

    /** @var array */
    protected $data = [];

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
        $this->body($body);
    }

    /**
     * Set the message body.
     *
     * @param mixed $value
     *
     * @return $this
     */
    public function body($value)
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
    public function subject($value)
    {
        return $this->setParameter('headings',$this->parseValueToArray($value));
    }

    /**
     * @param mixed $value
     *
     * @return array
     */
    protected function parseValueToArray($value){
        return (is_array($value)) ? $value : ['en' => $value];
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
        return $this->setUrl($value);
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
     * Set additional parameters.
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
     * @return array
     */
    public function toArray()
    {
        return $this->payload;
    }
}
