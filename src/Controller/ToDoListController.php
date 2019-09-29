<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/", name="to_do_list")
     */
    public function index()
    {
    	$tasks = $this->getDoctrine()->getRepository(Task::class)->findAll();
    	dump($tasks);

        return $this->render('index.html.twig', compact('tasks'));
    }

    /**
     * @Route("/create", name="create_task", methods={"POST"})
     */
    public function create(Request $request)
    {
    	$title = trim($request->get('title'));

    	if (empty($title)) {
    		return $this->redirectToRoute('to_do_list');
	    }

	    $entityManager = $this->getDoctrine()->getManager();

	    $task = new Task();
	    $task->setTitle($title);
	    $entityManager->persist($task);
	    $entityManager->flush();

	    return $this->redirectToRoute('to_do_list');
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
