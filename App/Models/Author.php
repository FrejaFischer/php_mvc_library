<?php

namespace App\Models;

use PDO;
use PDOException;

class Author extends \Core\Model
{
    public static function getAll(): array
    {
        try {
            $sql = <<<'SQL'
                SELECT
                   nAuthorID AS author_id,
                   cName AS first_name,
                   cSurname AS last_name
                FROM tauthor
                ORDER BY cName, cSurname;
            SQL;

            return self::execute($sql);
        } catch (PDOException $e) {
            throw new \Exception("Error <strong>{$e->getMessage()}</strong> in model " . get_called_class());
        }
    }
}