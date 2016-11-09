<?php

namespace AppBundle\Controller;

use AppBundle\Entity\JobTitle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Jobtitle controller.
 *
 */
class JobTitleController extends Controller
{
    /**
     * Lists all jobTitle entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jobTitles = $em->getRepository('AppBundle:JobTitle')->findAll();

        return $this->render('AppBundle:jobtitle:index.html.twig', array(
            'jobTitles' => $jobTitles,
        ));
    }

    /**
     * Creates a new jobTitle entity.
     *
     */
    public function newAction(Request $request)
    {
        $jobTitle = new Jobtitle();
        $form = $this->createForm('AppBundle\Form\JobTitleType', $jobTitle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jobTitle);
            $em->flush($jobTitle);

            return $this->redirectToRoute('jobtitle_index');
        }

        return $this->render('AppBundle:jobtitle:new.html.twig', array(
            'jobTitle' => $jobTitle,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jobTitle entity.
     *
     */
    public function editAction(Request $request, JobTitle $jobTitle)
    {
        $deleteForm = $this->createDeleteForm($jobTitle);
        $editForm = $this->createForm('AppBundle\Form\JobTitleType', $jobTitle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jobtitle_edit', array('id' => $jobTitle->getId()));
        }

        return $this->render('AppBundle:jobtitle:edit.html.twig', array(
            'jobTitle' => $jobTitle,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jobTitle entity.
     *
     */
    public function deleteAction(Request $request, JobTitle $jobTitle)
    {
        $form = $this->createDeleteForm($jobTitle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jobTitle);
            $em->flush($jobTitle);
        }

        return $this->redirectToRoute('jobtitle_index');
    }

    /**
     * Creates a form to delete a jobTitle entity.
     *
     * @param JobTitle $jobTitle The jobTitle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(JobTitle $jobTitle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jobtitle_delete', array('id' => $jobTitle->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
