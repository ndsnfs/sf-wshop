<?php
namespace App\AppServices\CompilerPath;

use App\UseCases\File\SlicedImageUploader;
use App\UseCases\File\Uploader;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class UploadCompilerPath implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $uploaderDefinition = $container->findDefinition(Uploader::class);
//        можно теггировать, но т.к. классов не много то делаем тупо так
        $uploaderDefinition->addMethodCall('addUploader', [ new Reference(SlicedImageUploader::class) ]);
    }
}