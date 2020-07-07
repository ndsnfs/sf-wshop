<?php
namespace App\Admin\EAV;

use App\Entity\Domain\EAV\ScalarTypedAttribute;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ScalarTypedAttributeAdmin extends AbstractAdmin
{
	public function configureFormFields(FormMapper $form)
	{
		$form
			->add('name', TextType::class)
			->add('type', ChoiceType::class, [
			    'choices' => array_combine(
			        ScalarTypedAttribute::getAllowedTypes(),
                    ScalarTypedAttribute::getAllowedTypes()
                ),
            ]);
	}

	public function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('name')
			->add('type');
	}

	public function configureListFields(ListMapper $list)
	{
		$list
			->addIdentifier('name')
			->add('type');
	}
}
