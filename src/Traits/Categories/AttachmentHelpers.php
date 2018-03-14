<?php

namespace NotificationChannels\OneSignal\Traits\Categories;


trait AttachmentHelpers
{

    /**
     * Set an Image only for iOS
     *
     * @param string $imageUrl
     *
     * @return $this
     */
    public function setIosAttachment(string $imageUrl)
    {
        return $this->setParameter('ios_attachments', ['id1' => $imageUrl]);
    }

    /**
     * Set multiple Images only for iOS
     *
     * @param array $images
     *
     * @return $this
     */
    public function setIosAttachments(array $images)
    {
        return $this->setParameter('ios_attachments', $images);
    }

    /**
     * Set the Big Picture Image only for Android
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
     * Set the Big Picture Image only for FireOS (Amazon)
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
     * Set the Big Picture Image only for Chrome
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
     * Set the additional Data for all Platforms
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data){
        return $this->setParameter('data', $data);
    }

    /**
     * Set the additional URL for all Platforms
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url){
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
            ->setChromeBigPicture($imageUrl);
    }
}