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
    	$tasks = $this->getDoctrine()->getRepository(Task::class)->findBy([],['id' => 'DESC']);

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
		$entityMenager = $this->getDoctrine()->getManager();
		$task = $entityMenager->getRepository(Task::class)->find($id_task);

		$task->setStatus( !$task->getStatus() );
		$entityMenager->flush();

		return $this->redirectToRoute('to_do_list');
	}
 
	/**
	 * @Route("/delete/{id_task}", name="delete")
	 */
	public function delete(Task $id_task)
	{
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->remove($id_task);
		$entityManager->flush();

		return $this->redirectToRoute('to_do_list');
	}
}
