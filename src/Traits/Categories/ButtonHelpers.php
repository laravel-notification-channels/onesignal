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
     * @return $this
     */
    public function webButton(OneSignalWebButton $button)
    {
        return $this->setParameter('web_buttons', [$button->toArray()]);
    }

    /**
     * Adds more than one web button to the message.
     *
     * @param array[OnSignalWebButton] $buttons
     *
     * @return $this
     */
    public function webButtons(array $buttons)
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
     * @return $this
     */
    public function button(OneSignalButton $button)
    {
        return $this->setParameter('buttons', [$button->toArray()]);
    }

    /**
     * Adds more than one native button to the message.
     *
     * @param array $buttons
     *
     * @return $this
     */
    public function buttons(array $buttons)
    {
        return $this->setParameter('buttons', collect($buttons)->map(function ($button) {
            return $button->toArray();
        }));
    }
}
