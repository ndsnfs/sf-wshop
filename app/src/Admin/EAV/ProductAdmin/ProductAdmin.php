<?php
namespace App\Admin\EAV\ProductAdmin;

use App\Entity\Domain\Category;
use App\Form\ImageType;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\Form\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductAdmin extends AbstractAdmin
{
	public function configureFormFields(FormMapper $form)
	{
		$form
			->with('Entity', ['class' => 'col-md-4'])
				->add('name')
				->add('category', EntityType::class, [
					'class' => Category::class,
					'choice_label' => 'name',
				])
			->end()
			->with('Характеристики', ['class' => 'col-md-8'])
				->add('characteristics', CollectionType::class, [
					'type_options' => [
						'delete' => true,
					]
				],[
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                    'limit' => 7,
                ])
                ->add('images', \Sonata\AdminBundle\Form\Type\CollectionType::class, [
                    'entry_type' => ImageType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                ])
			->end();
	}

	public function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('name');
	}

	public function configureListFields(ListMapper $list)
	{
		$list
			->addIdentifier('name');
	}
}
