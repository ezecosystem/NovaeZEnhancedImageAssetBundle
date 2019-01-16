<?php
/**
 * File part of the CNP-cnp-ezp2 website project.
 *
 * @copyright 2019 CNP-cnp-ezp2
 * @license   proprietary
 */

namespace Novactive\EzEnhancedImageAssetBundle\Service;

use eZ\Publish\SPI\Variation\Values\ImageVariation;
use Novactive\EzEnhancedImageAsset\FieldType\EnhancedImage\FocusPoint;

class FocusPointService
{
    /**
     * @param $originalSize
     * @param $pos
     * @param bool $negative
     *
     * @return float|int
     */
    public function getPixelFocusPointVal($originalSize, $pos, $negative = false)
    {
        $percent         = $negative ? ((-$pos + 1) / 2) * 100 : (($pos + 1) / 2) * 100;
        $focusPointVal   = ($originalSize * $percent) / 100;

        return $focusPointVal;
    }

    /**
     * @param ImageVariation $original
     * @param FocusPoint     $focusPoint
     *
     * @return array
     */
    public function getPixelFocusPoint(ImageVariation $original, FocusPoint $focusPoint)
    {
        $focusPointXVal = $this->getPixelFocusPointVal($original->width, $focusPoint->getPosX());
        $focusPointYVal = $this->getPixelFocusPointVal($original->height, $focusPoint->getPosY(), true);

        return [$focusPointXVal, $focusPointYVal];
    }

    /**
     * @param $focusPointVal
     * @param $croppedSize
     *
     * @return float|int
     */
    public function getPosCropVal($focusPointVal, $croppedSize)
    {
        $cropPointVal    = $focusPointVal - ($croppedSize / 2);

        return $cropPointVal;
    }

    /**
     * @param $pixelFocusPoint
     * @param ImageVariation $variation
     *
     * @return array
     */
    public function getPosCrop($pixelFocusPoint, ImageVariation $variation)
    {
        $cropPointXVal  = $this->getPosCropVal($pixelFocusPoint[0], $variation->width);
        $cropPointYVal  = $this->getPosCropVal($pixelFocusPoint[1], $variation->height);

        return [$cropPointXVal, $cropPointYVal];
    }

    /**
     * @param $cropPointVal
     * @param $focusPointVal
     * @param $croppedSize
     * @param $originalSize
     *
     * @return float|int
     */
    public function getCroppedFocusPointVal($cropPointVal, $focusPointVal, $croppedSize, $originalSize)
    {
        if ($cropPointVal <= 0) {
            $offsetPos = $cropPointVal;
        } else {
            $offsetPos = ($focusPointVal + ($croppedSize / 2)) - $originalSize;
        }

        return ($croppedSize / 2) + $offsetPos;
    }

    /**
     * @param $cropPoint
     * @param $focusPoint
     * @param ImageVariation $cropped
     * @param ImageVariation $original
     *
     * @return array
     */
    public function getCroppedFocusPoint($cropPoint, $focusPoint, ImageVariation $cropped, ImageVariation $original)
    {
        $croppedXFocusPoint = $this->getCroppedFocusPointVal($cropPoint[0], $focusPoint[0], $cropped->width, $original->width);
        $croppedYFocusPoint = $this->getCroppedFocusPointVal($cropPoint[1], $focusPoint[1], $cropped->height, $original->height);

        return [$croppedXFocusPoint, $croppedYFocusPoint];
    }

    /**
     * @param $cropPointVal
     * @param $croppedSize
     * @param bool $negative
     *
     * @return float|int
     */
    public function getFocusPosVal($cropPointVal, $croppedSize, $negative = false)
    {
        $focusPos = ($cropPointVal / $croppedSize - .5) * ($negative ? -2 : 2);

        return $focusPos;
    }

    /**
     * @param $croppedFocusPoint
     * @param ImageVariation $cropped
     *
     * @return array
     */
    public function getFocusPos($croppedFocusPoint, ImageVariation $cropped)
    {
        $xFocusPos = $this->getFocusPosVal($croppedFocusPoint[0], $cropped->width);
        $yFocusPos = $this->getFocusPosVal($croppedFocusPoint[1], $cropped->height, true);

        return [$xFocusPos, $yFocusPos];
    }
}
