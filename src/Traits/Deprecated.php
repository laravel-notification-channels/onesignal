<?php

namespace NotificationChannels\OneSignal\Traits;

use NotificationChannels\OneSignal\OneSignalButton;
use NotificationChannels\OneSignal\OneSignalWebButton;

trait Deprecated
{
    /**
     * Set the message body.
     *
     * @param mixed $value
     *
     * @deprecated use setBody instead
     *
     * @return $this
     */
    public function body($value)
    {
        return $this->setBody($value);
    }

    /**
     * Set the message subject.
     *
     * @param mixed $value
     *
     * @deprecated Use setSubject instead
     *
     * @return $this
     */
    public function subject($value)
    {
        return $this->setParameter('headings', $this->parseValueToArray($value));
    }

    /**
     * Set the message url.
     *
     * @param string $value
     *
     * @deprecated use setUrl Instead
     *
     * @return $this
     */
    public function url($value)
    {
        return $this->setUrl($value);
    }

    /**
     * Add a web button to the message.
     *
     * @param OneSignalWebButton $button
     *
     * @deprecated use setWebButton instead
     *
     * @return $this
     */
    public function webButton(OneSignalWebButton $button)
    {
        return $this->setWebButton($button);
    }

    /**
     * Adds more than one web button to the message.
     *
     * @param array[OnSignalWebButton] $buttons
     *
     * @deprecated use setWebButtons instead
     *
     * @return $this
     */
    public function webButtons(array $buttons)
    {
        return $this->setWebButtons($buttons);
    }

    /**
     * Add a native button to the message.
     *
     * @param OneSignalButton $button
     *
     * @deprecated use setButton instead
     * @return $this
     */
    public function button(OneSignalButton $button)
    {
        return $this->setButton($button);
    }

    /**
     * Adds more than one native button to the message.
     *
     * @param array $buttons
     *
     * @deprecated use setButtons instead
     *
     * @return $this
     */
    public function buttons(array $buttons)
    {
        return $this->setButtons($buttons);
    }
}
