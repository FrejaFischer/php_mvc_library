<?php

namespace App;

abstract class Config 
{
    const BASE_URL = '/php_mvc_library/public/';

    const SHOW_ERRORS = true; // true for development, else false

    const DB_HOST = 'localhost';
    const DB_NAME = 'library_api';
    const DB_USER = 'root';
    const DB_PORT = '8889';
    const DB_PASSWORD = 'root';
}