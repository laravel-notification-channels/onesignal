<?php

namespace NotificationChannels\OneSignal\Traits\Categories;

trait AttachmentHelpers
{
    /**
     * Set an Image/more than one Image only for iOS.
     *
     * @param string|array $imageUrl
     *
     * @return $this
     */
    public function setIosAttachment($imageUrl)
    {
        $imageUrl = is_array($imageUrl) ? $imageUrl : ['id1' => $imageUrl];

        return $this->setParameter('ios_attachments', $imageUrl);
    }

    /**
     * Set the Big Picture Image only for Android.
     *
     * @param string $imageUrl
     *
     * @return $this
     */
    public function setAndroidBigPicture(string $imageUrl)
    {
        return $this->setParameter('big_picture', $imageUrl);
    }

    /**
     * Set the Big Picture Image only for FireOS (Amazon).
     *
     * @param string $imageUrl
     *
     * @return $this
     */
    public function setAmazonBigPicture(string $imageUrl)
    {
        return $this->setParameter('adm_big_picture', $imageUrl);
    }

    /**
     * Set the Big Picture Image only for Chrome.
     *
     * @param string $imageUrl
     *
     * @return $this
     */
    public function setChromeBigPicture(string $imageUrl)
    {
        return $this->setParameter('chrome_big_picture', $imageUrl);
    }

    /**
     * Set the Web Image only for Chrome.
     *
     * @param string $imageUrl
     *
     * @return $this
     */
    public function setChromeWebImage(string $imageUrl)
    {
        return $this->setParameter('chrome_web_image', $imageUrl);
    }

    /**
     * Set the additional URL for all Platforms.
     *
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url)
    {
        return $this->setParameter('url', $url);
    }

    /**
     * Set an image to all possible attachment variables.
     *
     * @param string $imageUrl
     *
     * @return $this
     */
    public function setImageAttachments(string $imageUrl)
    {
        return $this->setIosAttachment($imageUrl)
            ->setAndroidBigPicture($imageUrl)
            ->setAmazonBigPicture($imageUrl)
            ->setChromeBigPicture($imageUrl)
            ->setChromeWebImage($imageUrl);
    }
}
