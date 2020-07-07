<?php
namespace App\Admin\EAV;

use App\Entity\Domain\EAV\ScalarTypedAttribute;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductCharacteristicAdmin extends AbstractAdmin
{
	public function configureFormFields(FormMapper $form)
	{
		$form
			->add('attribute', EntityType::class, [
				'class' => ScalarTypedAttribute::class,
				'choice_label' => 'name',
			])
			->add('value', TextType::class);
	}

	public function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
	}

	public function configureListFields(ListMapper $list)
	{
	}
}
