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
        collect($buttons)->map(function ($button) {
            $this->setWebButton($button);
        });

        return $this;
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
     * @return $this
     */
    public function setButtons(array $buttons)
    {
        collect($buttons)->map(function ($button) {
            $this->setButton($button);
        });

        return $this;
    }
}
