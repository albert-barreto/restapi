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

    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request)
    {
        $data = $request->request->all();
        return $this->json($data);
    }

    /**
     * @Route("/{planetId}", name="update", methods={"PUT", "PATCH"})
     */
    public function update($planetId)
    {

    }

    /**
     * @Route("/{planetId}", name="delete", methods={"DELETE"})
     */
    public function delete($planetId)
    {

    }

}
