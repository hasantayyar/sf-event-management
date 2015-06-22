<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Transfer;
use AppBundle\Form\TransferType;

/**
 * Transfer controller.
 *
 * @Route("/admin/transfer")
 */
class TransferController extends Controller
{

    /**
     * Lists all Transfer entities.
     *
     * @Route("/", name="admin_transfer")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Transfer')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Transfer entity.
     *
     * @Route("/", name="admin_transfer_create")
     * @Method("POST")
     * @Template("AppBundle:Transfer:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Transfer();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_transfer_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Transfer entity.
     *
     * @param Transfer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Transfer $entity)
    {
        $form = $this->createForm(new TransferType(), $entity, array(
            'action' => $this->generateUrl('admin_transfer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Transfer entity.
     *
     * @Route("/new", name="admin_transfer_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Transfer();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Transfer entity.
     *
     * @Route("/{id}", name="admin_transfer_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Transfer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transfer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Transfer entity.
     *
     * @Route("/{id}/edit", name="admin_transfer_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Transfer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transfer entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Transfer entity.
    *
    * @param Transfer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Transfer $entity)
    {
        $form = $this->createForm(new TransferType(), $entity, array(
            'action' => $this->generateUrl('admin_transfer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Transfer entity.
     *
     * @Route("/{id}", name="admin_transfer_update")
     * @Method("PUT")
     * @Template("AppBundle:Transfer:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Transfer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transfer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_transfer_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Transfer entity.
     *
     * @Route("/{id}", name="admin_transfer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Transfer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Transfer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_transfer'));
    }

    /**
     * Creates a form to delete a Transfer entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_transfer_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
