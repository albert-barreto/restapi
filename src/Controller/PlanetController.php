<?php

namespace App\Controller;

use App\Entity\Planet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/planets", name="planet_")
 */
class PlanetController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index()
    {
        $planets = $this->getDoctrine()->getRepository(Planet::class)->findAll();

        return $this->json([
            'data' => $planets
        ]);
    }

    /**
     * @Route("/{planetId}", name="show", methods={"GET"})
     */
    public function show($planetId)
    {
        $planet = $this->getDoctrine()->getRepository(Planet::class)->find($planetId);

        return $this->json([
            'data' => $planet
        ]);
    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request)
    {
        $data = $request->request->all();

        $planet = new Planet();
        $planet->setName($data['name']);
        $planet->setDescription($data['description']);
        $planet->setSlug($data['slug']);
        $planet->setCreatedAt(new \DateTime('now', new \DateTimeZone('America/Sao_Paulo')));
        $planet->setUpdatedAt(new \DateTime('now', new \DateTimeZone('America/Sao_Paulo')));

        $doctrine = $this->getDoctrine()->getManager();

        $doctrine->persist($planet);
        $doctrine->flush();

        return $this->json([
            'data' => 'Planets successfully created'
        ]);
    }

    /**
     * @Route("/{planetId}", name="update", methods={"PUT", "PATCH"})
     */
    public function update($planetId, Request $request)
    {
        $data = $request->request->all();

        $doctrine = $this->getDoctrine();

        $planet = $doctrine->getRepository(Planet::class)->find($planetId);

        if($request->request->has('name'))
            $planet->setName($data['name']);

        if($request->request->has('description'))
            $planet->setDescription($data['description']);

        if($request->request->has('slug'))
            $planet->setSlug($data['slug']);

        $planet->setUpdatedAt(new \DateTime('now', new \DateTimeZone('America/Sao_Paulo')));

        $manager = $doctrine->getManager();
        $manager->flush();

        return $this->json([
            'data' => 'Planets successfully updated'
        ]);
    }

    /**
     * @Route("/{planetId}", name="delete", methods={"DELETE"})
     */
    public function delete($planetId)
    {
        $doctrine = $this->getDoctrine();

        $planet = $doctrine->getRepository(Planet::class)->find($planetId);

        $manager = $doctrine->getManager();
        $manager->remove($planet);
        $manager->flush();

        return $this->json([
            'data' => 'Planets successfully removed'
        ]);
    }

}
