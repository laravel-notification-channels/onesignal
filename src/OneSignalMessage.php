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

    /** @var array */
    protected $extraParameters = [];

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
     * Set the iOS badge increment count.
     *
     * @param int $count
     *
     * @return $this
     */
    public function incrementIosBadgeCount($count = 1)
    {
        return $this->setParameter('ios_badgeType', 'Increase')
                    ->setParameter('ios_badgeCount', $count);
    }

    /**
     * Set the iOS badge decrement count.
     *
     * @param int $count
     *
     * @return $this
     */
    public function decrementIosBadgeCount($count = 1)
    {
        return $this->setParameter('ios_badgeType', 'Increase')
                    ->setParameter('ios_badgeCount', -1 * $count);
    }

    /**
     * Set the iOS badge count.
     *
     * @param int $count
     *
     * @return $this
     */
    public function setIosBadgeCount($count)
    {
        return $this->setParameter('ios_badgeType', 'SetTo')
                    ->setParameter('ios_badgeCount', $count);
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
     * Set additional parameters.
     *
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function setParameter($key, $value)
    {
        $this->extraParameters[$key] = $value;

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
     * Set an image to all possible attachment variables.
     * @param string $imageUrl
     *
     * @return $this
     */
    public function setImageAttachments($imageUrl)
    {
        $this->extraParameters['ios_attachments']['id1'] = $imageUrl;
        $this->extraParameters['big_picture'] = $imageUrl;
        $this->extraParameters['adm_big_picture'] = $imageUrl;
        $this->extraParameters['chrome_big_picture'] = $imageUrl;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $message = [
            'url' => $this->url,
            'buttons' => $this->buttons,
            'web_buttons' => $this->webButtons,
            'chrome_web_icon' => $this->icon,
            'chrome_icon' => $this->icon,
            'adm_small_icon' => $this->icon,
            'small_icon' => $this->icon,
        ];

        foreach ($this->extraParameters as $key => $value) {
            Arr::set($message, $key, $value);
        }

        foreach ($this->data as $data => $value) {
            Arr::set($message, 'data.'.$data, $value);
        }

        if (isset($message['template_id'])) {
            $inc_contents = false;
        } else {
            $inc_contents = true;
        }

        if ($inc_contents) {
            $message['contents'] = ['en' => $this->body];
            $message['headings'] = $this->subjectToArray();
        }

        return $message;
    }

    protected function subjectToArray()
    {
        if ($this->subject === null) {
            return [];
        }

        return ['en' => $this->subject];
    }
}
