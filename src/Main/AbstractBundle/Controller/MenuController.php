<?php

namespace Main\AbstractBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Main\AbstractBundle\Entity\Menu;
use Main\AbstractBundle\Form\MenuType;

/**
 * Menu controller.
 *
 * @Route("/menu")
 */
class MenuController extends Controller
{

    /**
     * Lists all Menu entities.
     *
     * @Route("/", name="menu")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MainAbstractBundle:Menu')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Menu entity.
     *
     * @Route("/", name="menu_create")
     * @Method("POST")
     * @Template("MainAbstractBundle:Menu:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Menu();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('menu', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Menu entity.
     *
     * @param Menu $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Menu $entity)
    {
        $form = $this->createForm(new MenuType(), $entity, array(
            'action' => $this->generateUrl('menu_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Menu entity.
     *
     * @Route("/new", name="menu_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Menu();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Menu entity.
     *
     * @Route("/{id}/edit", name="menu_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MainAbstractBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
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
    * Creates a form to edit a Menu entity.
    *
    * @param Menu $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Menu $entity)
    {
        $form = $this->createForm(new MenuType(), $entity, array(
            'action' => $this->generateUrl('menu_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Menu entity.
     *
     * @Route("/{id}", name="menu_update")
     * @Method("PUT")
     * @Template("MainAbstractBundle:Menu:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MainAbstractBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('menu_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Menu entity.
     *
     * @Route("/{id}", name="menu_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MainAbstractBundle:Menu')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Menu entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('menu'));
    }

    /**
     * Creates a form to delete a Menu entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('menu_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    /**
     * Lists all Menu entities.
     *
     * @Route("/menu-display", name="menu_display")
     * @Method("GET")
     * @Template()
     */
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MainAbstractBundle:Menu')->findAll();

        return array(
            'entities' => $entities,
        );
    }
}
