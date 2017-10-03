<?php

namespace Unet\Video\Block\Product\View;

/**
 * Class Gallery
 * @package Unet\Video\Block\Product\View
 */
class Gallery extends \Magento\Catalog\Block\Product\View\Gallery
{
    /**
     * Retrieve product images in JSON format
     *
     * @return string
     */
    public function getGalleryImagesJson()
    {
        $imagesItems = [];
        foreach ($this->getGalleryImages() as $image) {
            if ($image->getData('media_type') != \Magento\Catalog\Model\Product\Attribute\Backend\Media\ImageEntryConverter::MEDIA_TYPE_CODE) {
                continue;
            }

            $imagesItems[] = [
                'thumb' => $image->getData('small_image_url'),
                'img' => $image->getData('medium_image_url'),
                'full' => $image->getData('large_image_url'),
                'caption' => $image->getLabel(),
                'position' => $image->getPosition(),
                'isMain' => $this->isMainImage($image),
            ];
        }
        if (empty($imagesItems)) {
            $imagesItems[] = [
                'thumb' => $this->_imageHelper->getDefaultPlaceholderUrl('thumbnail'),
                'img' => $this->_imageHelper->getDefaultPlaceholderUrl('image'),
                'full' => $this->_imageHelper->getDefaultPlaceholderUrl('image'),
                'caption' => '',
                'position' => '0',
                'isMain' => true,
            ];
        }
        return json_encode($imagesItems);
    }

    /**
     * Retrieve product images in JSON format
     *
     * @return string
     */
    public function getGalleryVideosJson()
    {
        $imagesItems = [];
        foreach ($this->getGalleryImages() as $image) {
            if ($image->getData('media_type') == \Magento\Catalog\Model\Product\Attribute\Backend\Media\ImageEntryConverter::MEDIA_TYPE_CODE) {
                continue;
            }

            $imagesItems[] = [
                'thumb' => $image->getData('small_image_url'),
                'img' => $image->getData('medium_image_url'),
                'full' => $image->getData('large_image_url'),
                'caption' => $image->getLabel(),
                'position' => $image->getPosition(),
                'isMain' => $this->isMainImage($image),
            ];
        }
        return json_encode($imagesItems);
    }
}
