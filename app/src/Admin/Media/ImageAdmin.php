<?php
namespace App\Admin\Media;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ImageAdmin extends AbstractAdmin
{
    public function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('path')
            ->add('width');
    }

    public function configureFormFields(FormMapper $form)
    {
        $form->add('path');
    }

    public function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('path');
    }
}