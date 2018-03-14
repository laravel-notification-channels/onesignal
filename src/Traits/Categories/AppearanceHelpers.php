<?php

namespace NotificationChannels\OneSignal\Traits\Categories;


trait AppearanceHelpers
{

    /**
     * Set the iOS badge increment count.
     *
     * @param int $count
     *
     * @return $this
     */
    public function incrementIosBadgeCount(int $count = 1)
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
    public function decrementIosBadgeCount(int $count = 1)
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
    public function setIosBadgeCount(int $count)
    {
        return $this->setParameter('ios_badgeType', 'SetTo')
            ->setParameter('ios_badgeCount', $count);
    }

    /**
     * Set the iOS Sound.
     *
     * @param string $soundUrl
     *
     * @return $this
     */
    public function setIosSound(string $soundUrl)
    {
        return $this->setParameter('ios_sound', $soundUrl);
    }

    /**
     * Set the Android Sound.
     *
     * @param string $soundUrl
     *
     * @return $this
     */
    public function setAndroidSound(string $soundUrl)
    {
        return $this->setParameter('android_sound', $soundUrl);
    }

    /**
     * Set the Windows Sound.
     *
     * @param string $soundUrl
     *
     * @return $this
     */
    public function setWindowsSound(string $soundUrl)
    {
        return $this->setParameter('wp_sound', $soundUrl)->setParameter('wp_wns_sound', $soundUrl);
    }

    /**
     * Set the Sound for all Systems
     *
     * @param string $soundUrl
     *
     * @return $this
     */
    public function setSound(string $soundUrl)
    {
        return $this->setAndroidSound($soundUrl)
            ->setIosSound($soundUrl)
            ->setWindowsSound($soundUrl);
    }
}