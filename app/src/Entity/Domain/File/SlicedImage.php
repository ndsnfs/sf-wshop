<?php
namespace App\Entity\Domain\File;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class SlicedImage extends File
{
    const SIZE_SUFFIX_SM = '__sm';
    const SIZE_SUFFIX_MD = '__md';

    public function getSmPath()
    {
        return $this->addSuffixToPath(self::SIZE_SUFFIX_SM);
    }

    public function getMdPath()
    {
        return $this->addSuffixToPath(self::SIZE_SUFFIX_MD);
    }

    private function addSuffixToPath(string $suffix) : string
    {
        $p = strrpos($this->getPath(), '.');
        return  substr($this->getPath(), 0, $p) . $suffix . substr($this->getPath(), $p, strlen($this->getPath()));
    }
}