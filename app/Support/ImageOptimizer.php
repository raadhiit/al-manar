<?php

namespace App\Support;

class ImageOptimizer
{
    /**
     * Downscale (never upscale) and recompress a JPEG/PNG in place.
     * The file is only replaced if the result is smaller.
     * With $pngToJpeg, an opaque PNG that shrinks a lot as JPEG becomes a .jpg next to it.
     * Returns the final path (differs from $path only when converted).
     *
     * ponytail: no WebP. Add imagewebp() here if JPEG isn't small enough.
     */
    public static function optimize(string $path, int $maxWidth = 1920, int $quality = 82, bool $pngToJpeg = false): string
    {
        $info = @getimagesize($path);
        $type = $info[2] ?? null;

        if (! in_array($type, [IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
            return $path;
        }

        $before = filesize($path);
        $img = $type === IMAGETYPE_JPEG ? @imagecreatefromjpeg($path) : @imagecreatefrompng($path);

        // Palette (indexed) PNGs make imagescale() return false, so work in truecolor.
        if (! $img || ! imagepalettetotruecolor($img)) {
            return $path;
        }

        // GD drops EXIF when re-encoding, so bake the orientation into the pixels first.
        if ($type === IMAGETYPE_JPEG && function_exists('exif_read_data')) {
            $angle = [3 => 180, 6 => -90, 8 => 90][@exif_read_data($path)['Orientation'] ?? 1] ?? 0;
            if ($angle && ! ($img = imagerotate($img, $angle, 0))) {
                return $path;
            }
        }

        if (imagesx($img) > $maxWidth && ! ($img = imagescale($img, $maxWidth, -1, IMG_BICUBIC))) {
            return $path;
        }

        if ($type === IMAGETYPE_PNG && $pngToJpeg && ! self::pngHasAlpha($path)) {
            $jpg = preg_replace('/\.png$/i', '.jpg', $path);
            imagejpeg($img, $jpg, $quality);

            if (filesize($jpg) < $before * 0.7) {
                unlink($path);

                return $jpg;
            }

            unlink($jpg);
        }

        $tmp = $path . '.opt';

        if ($type === IMAGETYPE_JPEG) {
            imagejpeg($img, $tmp, $quality);
        } else {
            imagealphablending($img, false);
            imagesavealpha($img, true);
            imagepng($img, $tmp, 9);
        }

        filesize($tmp) < $before ? rename($tmp, $path) : unlink($tmp);

        return $path;
    }

    // PNG color types 4/6 carry alpha; palette PNGs (3) may carry it in a tRNS chunk.
    private static function pngHasAlpha(string $path): bool
    {
        $data = file_get_contents($path);

        return in_array(ord($data[25]), [4, 6], true) || str_contains($data, 'tRNS');
    }
}
