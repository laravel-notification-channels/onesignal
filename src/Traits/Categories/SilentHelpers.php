<?php

namespace NotificationChannels\OneSignal\Traits\Categories;

use Illuminate\Support\Arr;

trait SilentHelpers
{
    /**
     * Enables silent mode.
     *
     * @return $this
     */
    public function setSilent()
    {
        Arr::forget($this->payload, 'contents'); //removes any contents that are set by constructor.

        return $this->setParameter('content_available', 1);
    }
}
