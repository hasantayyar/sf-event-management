<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\VenueHall;
use AppBundle\Form\VenueHallType;

/**
 * VenueHall controller.
 *
 * @Route("/admin/venue/hall")
 */
class VenueHallController extends Controller {

    /**
     * Lists all VenueHall entities.
     *
     * @Route("/", name="admin_venue_hall")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:VenueHall')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new VenueHall entity.
     *
     * @Route("/", name="admin_venue_hall_create")
     * @Method("POST")
     * @Template("AppBundle:VenueHall:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new VenueHall();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_venue_hall_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a VenueHall entity.
     *
     * @param VenueHall $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(VenueHall $entity)
    {
        $form = $this->createForm(new VenueHallType(), $entity, array(
            'action' => $this->generateUrl('admin_venue_hall_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new VenueHall entity.
     *
     * @Route("/new", name="admin_venue_hall_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new VenueHall();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a VenueHall entity.
     *
     * @Route("/{id}", name="admin_venue_hall_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VenueHall')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VenueHall entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing VenueHall entity.
     *
     * @Route("/{id}/edit", name="admin_venue_hall_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VenueHall')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VenueHall entity.');
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
     * Creates a form to edit a VenueHall entity.
     *
     * @param VenueHall $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(VenueHall $entity)
    {
        $form = $this->createForm(new VenueHallType(), $entity, array(
            'action' => $this->generateUrl('admin_venue_hall_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing VenueHall entity.
     *
     * @Route("/{id}", name="admin_venue_hall_update")
     * @Method("PUT")
     * @Template("AppBundle:VenueHall:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:VenueHall')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VenueHall entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_venue_hall_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a VenueHall entity.
     *
     * @Route("/{id}", name="admin_venue_hall_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:VenueHall')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find VenueHall entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_venue_hall'));
    }

    /**
     * Creates a form to delete a VenueHall entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_venue_hall_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
