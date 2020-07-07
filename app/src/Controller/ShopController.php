<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
	/**
	 * @Route("/shop", name="shop-index", methods={"GET"})
	 */
	public function index()
	{
		return $this->render('shop/shop-index.html.twig');
	}
}