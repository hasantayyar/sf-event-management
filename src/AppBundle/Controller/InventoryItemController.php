<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\InventoryItem;
use AppBundle\Form\InventoryItemType;

/**
 * InventoryItem controller.
 *
 * @Route("/admin/inventory/item")
 */
class InventoryItemController extends Controller {

    /**
     * Lists all InventoryItem entities.
     *
     * @Route("/", name="admin_inventory_item")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:InventoryItem')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new InventoryItem entity.
     *
     * @Route("/", name="admin_inventory_item_create")
     * @Method("POST")
     * @Template("AppBundle:InventoryItem:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new InventoryItem();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_inventory_item_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a InventoryItem entity.
     *
     * @param InventoryItem $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(InventoryItem $entity)
    {
        $form = $this->createForm(new InventoryItemType(), $entity, array(
            'action' => $this->generateUrl('admin_inventory_item_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new InventoryItem entity.
     *
     * @Route("/new", name="admin_inventory_item_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new InventoryItem();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a InventoryItem entity.
     *
     * @Route("/{id}", name="admin_inventory_item_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:InventoryItem')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InventoryItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Displays a form to edit an existing InventoryItem entity.
     *
     * @Route("/{id}/edit", name="admin_inventory_item_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:InventoryItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InventoryItem entity.');
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
     * Creates a form to edit a InventoryItem entity.
     *
     * @param InventoryItem $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(InventoryItem $entity)
    {
        $form = $this->createForm(new InventoryItemType(), $entity, array(
            'action' => $this->generateUrl('admin_inventory_item_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing InventoryItem entity.
     *
     * @Route("/{id}", name="admin_inventory_item_update")
     * @Method("PUT")
     * @Template("AppBundle:InventoryItem:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:InventoryItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InventoryItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_inventory_item_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a InventoryItem entity.
     *
     * @Route("/{id}", name="admin_inventory_item_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:InventoryItem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InventoryItem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_inventory_item'));
    }

    /**
     * Creates a form to delete a InventoryItem entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_inventory_item_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
