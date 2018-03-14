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
     * @param string $value
     *
     * @return $this
     */
    public function body($value)
    {
        if(is_array($value)){
            $this->setParameter('contents',$value);
        } else {
            $this->setParameter('contents',['en' => $value]);
        }
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
        if(is_array($value)){
            $this->setParameter('headings',$value);
        } else {
            $this->setParameter('headings',['en' => $value]);
        }
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
       return $this->setUrl($value);
    }


    /**
     * Set additional data.
     *
     * @param string $key
     * @param mixed $value
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
     * @param mixed $value
     *
     * @return $this
     */
    public function setParameter(string $key, $value)
    {
        Arr::set($this->payload,$key,$value);
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
