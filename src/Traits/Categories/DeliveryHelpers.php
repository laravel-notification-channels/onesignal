<?php

namespace NotificationChannels\OneSignal\Traits\Categories;

trait DeliveryHelpers
{
    /**
     * Set the send after.
     *
     * @param string $date
     *
     * @return $this
     */
    public function setSendAfter(string $date)
    {
        return $this->setParameter('send_after', $date);
    }

    /**
     * Set the deplayed option.
     *
     * @param string $delayedOption
     *
     * @return $this
     */
    public function setDelayedOption(string $delayedOption)
    {
        return $this->setParameter('delayed_option', $delayedOption);
    }

    /**
     * Set the delivery at time of the day. Use with delayed option = timezone.
     *
     * @param string $timeOfDay
     *
     * @return $this
     */
    public function setDeliveryTimeOfDay(string $timeOfDay)
    {
        return $this->setParameter('delivery_time_of_day', $timeOfDay);
    }

    /**
     * Set the Time to Live in Seconds.
     *
     * @param int $ttl
     *
     * @return $this
     */
    public function setTtl(int $ttl)
    {
        return $this->setParameter('ttl', $ttl);
    }

    /**
     * Set the Priority.
     *
     * @param int $priority
     *
     * @return $this
     */
    public function setPriority(int $priority)
    {
        return $this->setParameter('priority', $priority);
    }
}
