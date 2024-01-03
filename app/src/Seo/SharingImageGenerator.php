<?php

namespace App\Seo;

use GdImage;

class SharingImageGenerator
{
    public const int IMAGE_WIDTH = 1600;

    public const int IMAGE_HEIGHT = 900;

    public const int IMAGE_MARGINS = 72;

    public const int TITLE_FONT_SIZE = 72;

    public const int AUTHOR_FONT_SIZE = 24;

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

        $title = wordwrap($this->title, 27);
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
                self::IMAGE_MARGINS * 3 + $titleHeight + self::AUTHOR_FONT_SIZE,
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

        $src_height = 100;
        imagecopy($image, $logo, self::IMAGE_MARGINS, self::IMAGE_HEIGHT-self::IMAGE_MARGINS-$src_height, 0, 0, 100, $src_height);

        return $image;
    }
}
