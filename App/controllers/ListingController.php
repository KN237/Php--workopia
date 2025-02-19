<?php

namespace App\Controllers;

use Framework\Database;

class ListingController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }
    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listings LIMIT 6')->fetchAll();
        loadView('listings/index', ['listings' => $listings]);
    }

    public function create()
    {
        loadView('listings/create');
    }

    public function show($params)
    {
        $id = $params['id'] ?? null;
        $listing = $this->db->query('SELECT * FROM listings where id=:id', ['id' => $id])->fetch();
        if (!$listing) {
            ErrorController::notFound('Listing not found !');
            return;
        }
        loadView('listings/show', ['listing' => $listing]);
    }
}
