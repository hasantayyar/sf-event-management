<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\EventTimeline;
use AppBundle\Form\EventTimelineType;

/**
 * EventTimeline controller.
 *
 * @Route("/admin/timeline")
 */
class EventTimelineController extends Controller {

    /**
     * Lists all EventTimeline entities for a spesific event
     *
     * @Route("/event/{eventId}", name="admin_event_timeline")
     * @Method("GET")
     * @Template()
     */
    public function eventIndexAction($eventId)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:EventTimeline')->findByEventId($eventId);
        $event = $em->getRepository('AppBundle:Event')->find($eventId);
        return array(
            'entities' => $entities,
            'event' => $event
        );
    }

    /**
     * Lists all EventTimeline entities.
     *
     * @Route("/", name="timeline")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:EventTimeline')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new EventTimeline entity.
     *
     * @Route("/", name="timeline_create")
     * @Method("POST")
     * @Template("AppBundle:EventTimeline:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new EventTimeline();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('timeline_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a EventTimeline entity.
     *
     * @param EventTimeline $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EventTimeline $entity)
    {
        $form = $this->createForm(new EventTimelineType(), $entity, array(
            'action' => $this->generateUrl('timeline_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new EventTimeline entity.
     *
     * @Route("/new", name="timeline_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EventTimeline();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a EventTimeline entity.
     *
     * @Route("/{id}", name="timeline_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:EventTimeline')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventTimeline entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EventTimeline entity.
     *
     * @Route("/{id}/edit", name="timeline_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:EventTimeline')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventTimeline entity.');
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
     * Creates a form to edit a EventTimeline entity.
     *
     * @param EventTimeline $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(EventTimeline $entity)
    {
        $form = $this->createForm(new EventTimelineType(), $entity, array(
            'action' => $this->generateUrl('timeline_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing EventTimeline entity.
     *
     * @Route("/{id}", name="timeline_update")
     * @Method("PUT")
     * @Template("AppBundle:EventTimeline:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:EventTimeline')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventTimeline entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('timeline_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a EventTimeline entity.
     *
     * @Route("/{id}", name="timeline_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:EventTimeline')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EventTimeline entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('timeline'));
    }

    /**
     * Creates a form to delete a EventTimeline entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('timeline_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
