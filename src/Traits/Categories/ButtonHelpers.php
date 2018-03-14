<?php

namespace NotificationChannels\OneSignal\Traits\Categories;

use NotificationChannels\OneSignal\OneSignalButton;
use NotificationChannels\OneSignal\OneSignalWebButton;

trait ButtonHelpers
{

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
     * Add a web button to the message.
     *
     * @param OneSignalWebButton $button
     *
     * @return $this
     */
    public function setWebButton(OneSignalWebButton $button)
    {
        return $this->setParameter('web_buttons', array_merge($this->getParameter('web_buttons', []), [$button->toArray()]));
    }

    /**
     * Adds more than one web button to the message.
     *
     * @param array[OnSignalWebButton] $buttons
     *
     * @return $this
     */
    public function setWebButtons(array $buttons)
    {
        return $this->setParameter('web_buttons', collect($buttons)->map(function ($button) {
            return $button->toArray();
        }));
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
     * Add a native button to the message.
     *
     * @param OneSignalButton $button
     *
     * @return $this
     */
    public function setButton(OneSignalButton $button)
    {
        return $this->setParameter('buttons', array_merge($this->getParameter('buttons', []), [$button->toArray()]));
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

    /**
     * Adds more than one native button to the message.
     *
     * @param array $buttons
     *
     * @return $this
     */
    public function setButtons(array $buttons)
    {
        return $this->setParameter('buttons', collect($buttons)->map(function ($button) {
            return $button->toArray();
        }));
    }
}
