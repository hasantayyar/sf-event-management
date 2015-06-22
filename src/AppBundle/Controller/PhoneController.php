<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Phone;
use AppBundle\Form\PhoneType;

/**
 * Phone controller.
 *
 * @Route("/admin/phone")
 */
class PhoneController extends Controller {

    /**
     * Lists all Phone entities.
     *
     * @Route("/", name="admin_phone")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Phone')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Phone entity.
     *
     * @Route("/", name="admin_phone_create")
     * @Method("POST")
     * @Template("AppBundle:Phone:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Phone();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_phone_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Phone entity.
     *
     * @param Phone $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Phone $entity)
    {
        $form = $this->createForm(new PhoneType(), $entity, array(
            'action' => $this->generateUrl('admin_phone_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Phone entity.
     *
     * @Route("/new", name="admin_phone_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Phone();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Phone entity.
     *
     * @Route("/{id}", name="admin_phone_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Phone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Phone entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Phone entity.
     *
     * @Route("/{id}/edit", name="admin_phone_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Phone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Phone entity.');
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
     * Creates a form to edit a Phone entity.
     *
     * @param Phone $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Phone $entity)
    {
        $form = $this->createForm(new PhoneType(), $entity, array(
            'action' => $this->generateUrl('admin_phone_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Phone entity.
     *
     * @Route("/{id}", name="admin_phone_update")
     * @Method("PUT")
     * @Template("AppBundle:Phone:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Phone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Phone entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_phone_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Phone entity.
     *
     * @Route("/{id}", name="admin_phone_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Phone')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Phone entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_phone'));
    }

    /**
     * Creates a form to delete a Phone entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_phone_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
