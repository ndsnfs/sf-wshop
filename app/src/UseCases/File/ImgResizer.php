<?php
namespace App\UseCases\File;

class ImgResizer
{
    /**
     * @var string
     */
    private $sourcePath;
    /**
     * @var string
     */
    private $distPath;

    public function setSourcePath(string $sourcePath)
    {
        $this->sourcePath = $sourcePath;
        return $this;
    }

    public function setDistPath(string $distPath)
    {
        $this->distPath = $distPath;
        return $this;
    }

    public function resize(int $distWidth, int $distHeight = null)
    {
        list($srcWidth, $srcHeight, $type) = getimagesize($this->sourcePath);

        switch ($type) {
            case 3:
                $srcImg = imagecreatefrompng($this->sourcePath);
                break;
        }

        if (!$distHeight) $distHeight = ceil($distWidth / ($srcWidth/$srcHeight));

        $distImg = imagecreatetruecolor($distWidth, $distHeight);
        imagecopyresized($distImg, $srcImg, 0, 0, 0, 0, $distWidth, $distHeight, $srcWidth, $srcHeight);

        switch ($type) {
            case 3:
                imagepng($distImg, $this->distPath);
                break;
        }

        $this->destroy();
    }

    public function destroy()
    {
        $this->distPath = null;
        $this->sourcePath = null;
    }
}