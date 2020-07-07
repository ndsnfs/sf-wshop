<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
	/**
	 * @Route("/", name="todo.all")
	 */
	public function all()
	{
		return $this->render('todo/all.html.twig', []);
	}
}