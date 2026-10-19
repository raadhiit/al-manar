<?php

namespace Tests\Unit;

use App\Support\ImageOptimizer;
use PHPUnit\Framework\TestCase;

class ImageOptimizerTest extends TestCase
{
    private function noisy(int $w, int $h)
    {
        $img = imagecreatetruecolor($w, $h);
        for ($i = 0; $i < 3000; $i++) {
            imagefilledrectangle($img, random_int(0, $w - 100), random_int(0, $h - 100), random_int(0, $w), random_int(0, $h), random_int(0, 0xFFFFFF));
        }

        return $img;
    }

    public function test_oversized_jpeg_is_downscaled_and_smaller(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'img') . '.jpg';
        imagejpeg($this->noisy(3000, 2000), $path, 100);
        $before = filesize($path);

        $this->assertSame($path, ImageOptimizer::optimize($path));
        $this->assertSame(1920, getimagesize($path)[0]);
        $this->assertLessThan($before, filesize($path));
        unlink($path);
    }

    public function test_opaque_png_becomes_jpg_only_when_asked(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'img') . '.png';
        // photo-like: smooth gradient + per-pixel noise (flat blocks already compress well as PNG)
        $img = imagecreatetruecolor(600, 400);
        for ($y = 0; $y < 400; $y++) {
            for ($x = 0; $x < 600; $x++) {
                $n = random_int(-12, 12);
                imagesetpixel($img, $x, $y, imagecolorallocate($img, max(0, min(255, intdiv($x, 3) + $n)), max(0, min(255, intdiv($y, 2) + $n)), 128));
            }
        }
        imagepng($img, $path);

        $out = ImageOptimizer::optimize($path, pngToJpeg: true);

        $this->assertStringEndsWith('.jpg', $out);
        $this->assertFileDoesNotExist($path);
        unlink($out);
    }

    public function test_transparent_png_stays_png(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'img') . '.png';
        $img = imagecreatetruecolor(400, 400);
        imagesavealpha($img, true);
        imagefill($img, 0, 0, imagecolorallocatealpha($img, 0, 0, 0, 127));
        imagepng($img, $path);

        $this->assertSame($path, ImageOptimizer::optimize($path, pngToJpeg: true));
        $this->assertFileExists($path);
        unlink($path);
    }

    public function test_oversized_palette_png_does_not_crash(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'img') . '.png';
        $img = imagecreate(2500, 300); // palette (indexed) image
        imagecolorallocate($img, 10, 20, 30);
        imagepng($img, $path);

        $this->assertSame($path, ImageOptimizer::optimize($path)); // used to throw TypeError on imagealphablending(false)
        unlink($path);
    }

    public function test_non_image_is_left_alone(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'txt');
        file_put_contents($path, 'not an image');

        $this->assertSame($path, ImageOptimizer::optimize($path));
        $this->assertSame('not an image', file_get_contents($path));
        unlink($path);
    }
}
