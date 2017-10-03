<?php

namespace Unet\Video\Block\ProductVideo\View;

/**
 * Class Gallery
 * @package Unet\Video\Block\ProductVideo\View
 */
class Gallery extends \Magento\ProductVideo\Block\Product\View\Gallery
{
    /**
     * Retrieve media gallery data in JSON format
     *
     * @return string
     */
    public function getMediaGalleryDataJson()
    {
        $mediaGalleryData = [];
        foreach ($this->getProduct()->getMediaGalleryImages() as $mediaGalleryImage) {
            if ($mediaGalleryImage->getMediaType() == \Magento\Catalog\Model\Product\Attribute\Backend\Media\ImageEntryConverter::MEDIA_TYPE_CODE) {
                continue;
            }

            $mediaGalleryData[] = [
                'mediaType' => $mediaGalleryImage->getMediaType(),
                'videoUrl' => $mediaGalleryImage->getVideoUrl(),
                'isBase' => $this->isMainImage($mediaGalleryImage),
            ];
        }
        return $this->jsonEncoder->encode($mediaGalleryData);
    }
}
