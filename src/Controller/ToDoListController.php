<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="to_do_list")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/create", name="create_task", methods={"POST"})
     */
    public function create()
    {
        exit('to do: create a new task');
    }
    
	/**
	 * @Route("/switch-status/{id_task}", name="switch_status")
	 */
	public function switch_status($id_task)
	{
		exit('to do: switch status of the task!' . $id_task);
	}
 
	/**
	 * @Route("/delete/{id_task}", name="delete")
	 */
	public function delete($id_task)
	{
		exit('to do: delete task!' . $id_task);
	}
}
