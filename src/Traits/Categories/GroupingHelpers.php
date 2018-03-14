<?php

namespace NotificationChannels\OneSignal\Traits\Categories;

trait GroupingHelpers
{
    /**
     * Set the Android Grouping Parameters.
     *
     * @param string $group
     * @param array  $groupMessage
     *
     * @return $this
     */
    public function setAndroidGroup(string $group, array $groupMessage)
    {
        return $this->setParameter('android_group', $group)
            ->setParameter('android_group_message', $groupMessage);
    }

    /**
     * Set the Amazon (FireOS) Grouping Parameters.
     *
     * @param string $group
     * @param array  $groupMessage
     *
     * @return $this
     */
    public function setAmazonGroup(string $group, array $groupMessage)
    {
        return $this->setParameter('adm_group', $group)
            ->setParameter('adm_group_message', $groupMessage);
    }

    /**
     * Set the Grouping Parameters for all available Systems (currently Android and Amazon (FireOs)).
     *
     * @param string $group
     * @param array  $groupMessage
     *
     * @return $this
     */
    public function setGroup(string $group, array $groupMessage)
    {
        return $this->setAndroidGroup($group, $groupMessage)
            ->setAmazonGroup($group, $groupMessage);
    }
}
