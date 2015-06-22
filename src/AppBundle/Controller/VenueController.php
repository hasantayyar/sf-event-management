<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Venue;
use AppBundle\Form\VenueType;
use AppBundle\Entity\VenueHall;
use AppBundle\Form\VenueHallType;

/**
 * Venue controller.
 *
 * @Route("/admin/venue")
 */
class VenueController extends Controller {

    /**
     * Lists all Venue entities.
     *
     * @Route("/", name="admin_venue")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Venue')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Add hall for given venue
     *
     * @Route("/{id}/hall/add", name="admin_venue_add_hall")
     * @Method("GET")
     * @Template()
     */
    public function addHallAction($id)
    {

        $entity = $this->getVenue($id);
        $hallEntity = new VenueHall();
        $form = $this->createForm(new VenueHallType(), $hallEntity, array(
            'action' => $this->generateUrl('admin_venue_hall_create'),
            'method' => 'POST',
            'venue' => $entity
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Venue entity.
     *
     * @Route("/", name="admin_venue_create")
     * @Method("POST")
     * @Template("AppBundle:Venue:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Venue();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_venue_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Venue entity.
     *
     * @param Venue $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Venue $entity)
    {
        $form = $this->createForm(new VenueType(), $entity, array(
            'action' => $this->generateUrl('admin_venue_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Venue entity.
     *
     * @Route("/new", name="admin_venue_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Venue();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * 
     * @param integer $id
     * @return Venue
     * @throws NotFoundHttpException
     */
    private function getVenue($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Venue')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }
        return $entity;
    }

    /**
     * Finds and displays a Venue entity.
     *
     * @Route("/{id}", name="admin_venue_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->getVenue($id);

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Venue entity.
     *
     * @Route("/{id}/edit", name="admin_venue_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Venue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
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
     * Creates a form to edit a Venue entity.
     *
     * @param Venue $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Venue $entity)
    {
        $form = $this->createForm(new VenueType(), $entity, array(
            'action' => $this->generateUrl('admin_venue_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Venue entity.
     *
     * @Route("/{id}", name="admin_venue_update")
     * @Method("PUT")
     * @Template("AppBundle:Venue:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Venue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_venue_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Venue entity.
     *
     * @Route("/{id}", name="admin_venue_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Venue')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Venue entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_venue'));
    }

    /**
     * Creates a form to delete a Venue entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_venue_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
