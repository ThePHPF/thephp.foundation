<?php

namespace App\Seo;

use GdImage;

class SharingImageGenerator
{
    public const IMAGE_WIDTH = 1200;

    public const IMAGE_HEIGHT = 630;

    public const IMAGE_MARGINS = 40;

    public const TITLE_FONT_SIZE = 40;

    public const AUTHOR_FONT_SIZE = 14;

    protected bool $inverse = false;

    protected string $title;

    protected ?string $author = null;

    public function setTitle($title): SharingImageGenerator
    {
        $this->title = $title;

        return $this;
    }

    public function setAuthor($author): SharingImageGenerator
    {
        $this->author = $author;

        return $this;
    }

    public function setInverse($inverse): SharingImageGenerator
    {
        $this->inverse = $inverse;

        return $this;
    }

    public function output(): void
    {
        $image = $this->prepare();

        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);
    }

    public function save($path): void
    {
        $image = $this->prepare();

        imagepng($image, $path);
        imagedestroy($image);
    }

    protected function prepare(): GdImage
    {
        $image = imagecreate(self::IMAGE_WIDTH, self::IMAGE_HEIGHT);

        if ($this->inverse) {
            imagecolorallocate($image, 39, 40, 44);
        } else {
            imagecolorallocate($image, 107, 87, 255);
        }

        $whiteColor = imagecolorallocate($image, 255, 255, 255);

        $title = wordwrap($this->title, 40);
        $titleBounds = imagettfbbox(
            self::TITLE_FONT_SIZE,
            0,
            __DIR__.'/../../../assets/fonts/ArialBold.ttf',
            $title
        );
        $titleHeight = $titleBounds[1] - $titleBounds[7];

        imagettftext(
            $image,
            self::TITLE_FONT_SIZE,
            0,
            self::IMAGE_MARGINS,
            self::IMAGE_MARGINS * 3,
            $whiteColor,
            __DIR__.'/../../../assets/fonts/ArialBold.ttf',
            $title
        );

        if ($this->author) {
            $author = wordwrap($this->author, 40);

            imagettftext(
                $image,
                self::AUTHOR_FONT_SIZE,
                0,
                self::IMAGE_MARGINS,
                $titleHeight + self::IMAGE_MARGINS * 3 + 10,
                $whiteColor,
                __DIR__.'/../../../assets/fonts/Arial.ttf',
                $author
            );
        }

        if ($this->inverse) {
            $logo = imagecreatefrompng(__DIR__.'/../../../assets/img/logo.png');
        } else {
            $logo = imagecreatefrompng(__DIR__.'/../../../assets/img/logo_inverse.png');
        }

        imagecopy($image, $logo, 40, 490, 0, 0, 100, 100);

        return $image;
    }
}