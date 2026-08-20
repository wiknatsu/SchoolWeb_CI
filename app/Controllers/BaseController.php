<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\SchoolProfileModel;
use App\Models\VisitorModel;

abstract class BaseController extends Controller
{
    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['form', 'url', 'custom', 'text'];

    /**
     * Session instance
     */
    protected $session;

    /**
     * Active school profile data
     */
    protected $schoolProfile;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do not edit this line
        parent::initController($request, $response, $logger);

        // Preload session
        $this->session = \Config\Services::session();

        // Get school profile
        $this->schoolProfile = get_school_profile();
    }

    /**
     * Helper to log visitor for public routes
     */
    protected function logVisitor(string $pageName = '/'): void
    {
        try {
            $visitorModel = new VisitorModel();
            $visitorModel->logVisit($pageName);
        } catch (\Throwable $e) {
            log_message('error', 'Visitor log error: ' . $e->getMessage());
        }
    }
}
