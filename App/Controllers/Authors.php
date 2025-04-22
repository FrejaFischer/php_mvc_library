<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Author;

class Authors extends \Core\Controller
{
    /**
     * Show the index page
     */
    public function indexAction(): void
    {
        $authors = Author::getAll();
        
        View::render('Authors/index.php', [
            'pageTitle' => 'Authors',
            'authors' => $authors
        ]);
    }
}