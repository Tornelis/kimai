<?php

/*
    Steuert die Konfiguration und Übersicht im System-Untermenü von Kimai.
*/

namespace KimaiPlugin\KimaiSyncBundle\Controller;

use App\Controller\AbstractController;
//use KimaiPlugin\KimaiSyncBundle\Configuration\*;
//use KimaiPlugin\KimaiSyncBundle\Service\*;
//use PhpOffice\PhpWord\Shared\ZipArchive;
//use Symfony\Component\Filesystem\Filesystem;
//use Symfony\Component\HttpFoundation\ResponseHeaderBag;
//use Symfony\Component\Security\Core\Exception\RuntimeException;
//use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


/**
 * Controller für das KimaiSync System-Untermenü.
 */
//#[IsGranted('KimaiSync')]
#[Route('/admin/kimai-sync')]
final class KimaiSyncController extends AbstractController { 

    public function __construct() {  }

    /**
     * Zeigt die Konfigurationsseite für KimaiSync.
     * @return Response
     */
    #[Route('/', name: 'kimai_sync', methods: ['GET'])]
    public function indexAction(): Response {

        return $this->render('@KimaiSync/index.html.twig', [ ]);
    }


}