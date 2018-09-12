<?php

/*
 * This file is part of the Imagine package.
 *
 * (c) Bulat Shakirzyanov <mallluhuct@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagine\Effects;

use Imagine\Exception\RuntimeException;
use Imagine\Image\Palette\Color\ColorInterface;
use Imagine\Utils\Matrix;

/**
 * Interface for the effects.
 */
interface EffectsInterface
{
    /**
     * Apply gamma correction.
     *
     * @param float $correction
     *
     * @throws RuntimeException
     *
     * @return EffectsInterface
     */
    public function gamma($correction);

    /**
     * Invert the colors of the image.
     *
     * @throws RuntimeException
     *
     * @return EffectsInterface
     */
    public function negative();

    /**
     * Grayscale the image.
     *
     * @throws RuntimeException
     *
     * @return EffectsInterface
     */
    public function grayscale();

    /**
     * Colorize the image.
     *
     * @param ColorInterface $color
     *
     * @throws RuntimeException
     *
     * @return EffectsInterface
     */
    public function colorize(ColorInterface $color);

    /**
     * Sharpens the image.
     *
     * @throws RuntimeException
     *
     * @return EffectsInterface
     */
    public function sharpen();

    /**
     * Blur the image.
     *
     * @param float|int $sigma
     *
     * @throws RuntimeException
     *
     * @return EffectsInterface
     */
    public function blur($sigma);

    /**
     * Changes the brightness of the image.
     *
     * @param int $brightness The level of brightness (-100 (black) to 100 (white))
     *
     * @throws RuntimeException
     *
     * @return EffectsInterface
     */
    public function brightness($brightness);

    /**
     * Convolves the image.
     *
     * @param \Imagine\Utils\Matrix $matrix The matrix from which derive the convolution kernel
     *
     * @throws RuntimeException
     *
     * @return EffectsInterface
     */
    public function convolve(Matrix $matrix);
}
