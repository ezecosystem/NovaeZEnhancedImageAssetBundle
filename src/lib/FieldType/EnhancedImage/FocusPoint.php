<?php
/**
 * NovaeZEnhancedImageAssetBundle.
 *
 * @package   NovaeZEnhancedImageAssetBundle
 *
 * @author    Novactive <f.alexandre@novactive.com>
 * @copyright 2018 Novactive
 * @license   https://github.com/Novactive/NovaeZEnhancedImageAssetBundle/blob/master/LICENSE
 */

declare(strict_types=1);

namespace Novactive\EzEnhancedImageAsset\FieldType\EnhancedImage;

/**
 * Class FocusPoint.
 *
 * @property float $posX
 * @property float $posY
 *
 * @package Novactive\EzEnhancedImageAsset\FieldType\EnhancedImage
 */
class FocusPoint
{
    /**
     * @var float
     */
    protected $posX = 0;

    /**
     * @var float
     */
    protected $posY = 0;

    /**
     * FocusPoint constructor.
     *
     * @param float $posX
     * @param float $posY
     */
    public function __construct(float $posX = 0, float $posY = 0)
    {
        $this->posX = $posX;
        $this->posY = $posY;
    }

    /**
     * @return float
     */
    public function getPosX(): float
    {
        return $this->posX;
    }

    /**
     * @param float $posX
     */
    public function setPosX(float $posX): void
    {
        $this->posX = $posX;
    }

    /**
     * @return float
     */
    public function getPosY(): float
    {
        return $this->posY;
    }

    /**
     * @param float $posY
     */
    public function setPosY(float $posY): void
    {
        $this->posY = $posY;
    }
}
