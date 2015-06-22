<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\TransferPoint;
use AppBundle\Form\TransferPointType;

/**
 * TransferPoint controller.
 *
 * @Route("/admin/transfer/points")
 */
class TransferPointController extends Controller {

    /**
     * Lists all TransferPoint entities.
     *
     * @Route("/", name="admin_transfer_points")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:TransferPoint')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new TransferPoint entity.
     *
     * @Route("/", name="admin_transfer_points_create")
     * @Method("POST")
     * @Template("AppBundle:TransferPoint:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TransferPoint();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_transfer_points_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TransferPoint entity.
     *
     * @param TransferPoint $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TransferPoint $entity)
    {
        $form = $this->createForm(new TransferPointType(), $entity, array(
            'action' => $this->generateUrl('admin_transfer_points_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TransferPoint entity.
     *
     * @Route("/new", name="admin_transfer_points_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TransferPoint();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a TransferPoint entity.
     *
     * @Route("/{id}", name="admin_transfer_points_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TransferPoint')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TransferPoint entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TransferPoint entity.
     *
     * @Route("/{id}/edit", name="admin_transfer_points_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TransferPoint')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TransferPoint entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a TransferPoint entity.
     *
     * @param TransferPoint $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(TransferPoint $entity)
    {
        $form = $this->createForm(new TransferPointType(), $entity, array(
            'action' => $this->generateUrl('admin_transfer_points_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing TransferPoint entity.
     *
     * @Route("/{id}", name="admin_transfer_points_update")
     * @Method("PUT")
     * @Template("AppBundle:TransferPoint:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TransferPoint')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TransferPoint entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_transfer_points_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TransferPoint entity.
     *
     * @Route("/{id}", name="admin_transfer_points_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:TransferPoint')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TransferPoint entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_transfer_points'));
    }

    /**
     * Creates a form to delete a TransferPoint entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_transfer_points_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
