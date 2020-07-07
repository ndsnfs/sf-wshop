<?php
namespace App\Admin;

use App\Entity\Domain\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryAdmin extends AbstractAdmin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
				->add('name', TextType::class)
				->add('parent', EntityType::class,[
					'class' => Category::class,
					'choice_label' => 'name'
				])
				->end();
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('name')
			->add('parent', null, [], EntityType::class, [
				'class' => Category::class,
				'choice_label' => 'name',
			]);
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('name')
			->addIdentifier('parent.name');
	}
}
