<?php
namespace App\Admin\File;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SlicedImageAdmin extends AbstractAdmin
{
    public function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('path');
    }

    public function configureFormFields(FormMapper $form)
    {
        $form->add('paececeth', TextType::class);
    }

    public function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('path');
    }
}