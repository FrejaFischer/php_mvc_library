<?php

namespace App\Controllers;
use \Core\View;

class Books extends \Core\Controller
{
    public function bookAction(): void
    {
        View::render('Books/index.php', [
            'pageTitle' => 'Books'
        ]);
    }
}