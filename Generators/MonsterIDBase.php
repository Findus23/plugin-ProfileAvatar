<?php

namespace Piwik\Plugins\ProfileAvatar\Generators;

/**
 * based on code by Andreas Gohr and Anton Smirnov
 * both under MIT license
 * https://github.com/splitbrain/monsterID
 * https://github.com/arokettu/monsterid
 */
class MonsterIDBase extends AvatarBase
{
    public $size = 120;
    protected $seed;
    protected $monster;
    protected $path;
    protected $partTemplate;

    public function __construct($seed = null)
    {
        $this->seed = hexdec(substr($seed, -10));
    }

    public function __destruct()
    {
        if ($this->monster) {
            imagedestroy($this->monster);
        }
    }

    public function asDataUrl(): string
    {
        $this->build();
        $output = $this->toBuffer();

        return $this->dataURL($output);
    }

    public function build(): void
    {
        $this->createImage();

        srand($this->seed);

        $parts = $this->generateRandomParts();

        foreach ($parts as $part => $number) {
            $this->applyPartToImage($part, $number);
        }

        srand();
    }

    private function createImage(): void
    {
        // create background
        $this->monster = imagecreatetruecolor($this->size, $this->size);
        if (!$this->monster) {
            throw new \Exception('GD image create failed');
        }
        $white = imagecolorallocate($this->monster, 255, 255, 255);
        imagefill($this->monster, 0, 0, $white);
    }

    private function generateRandomParts(): array
    {
        // throw the dice for body parts
        foreach ($this->partTemplate as $name => $template) {
            list($min, $max) = $template;
            $parts[$name] = rand($min, $max);
        }
        return $parts;
    }

    protected function applyPartToImage($part, $number): void
    {
        $file = implode(DIRECTORY_SEPARATOR, array(self::getPartsPath(), "{$part}_{$number}.png"));

        $partImage = imagecreatefrompng($file);
        if (!$partImage) {
            throw new \Exception('Failed to load ' . $file);
        }
        imagesavealpha($partImage, true);
        imagecopy($this->monster, $partImage, 0, 0, 0, 0, $this->size, $this->size);
        imagedestroy($partImage);

    }

    private function getPartsPath(): string
    {
        return realpath(__DIR__ . '/../images/' . $this->path);
    }

    public function toBuffer(): string
    {
        ob_start();
        imagepng($this->monster, null, 9);
        $buffer = ob_get_clean();
        imagedestroy($this->monster);
        return $buffer;
    }

    private function dataURL(string $output): string
    {
        $base64 = base64_encode($output);
        return "data:image/png;base64," . $base64;
    }

    public function print(): void
    {
        $this->build();
        header('Content-type: image/png');
        imagepng($this->monster, null, 9);
        imagedestroy($this->monster);
    }
}
