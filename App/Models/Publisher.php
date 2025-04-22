<?php

namespace App\Models;

use PDO;
use PDOException;

class Publisher extends \Core\Model
{
    public static function getAll(): array
    {
        try {
            $sql = <<<'SQL'
                SELECT
                   nPublishingCompanyID AS publisher_id,
                   cName AS name
                FROM tpublishingcompany
                ORDER BY cName;
            SQL;

            return self::execute($sql);
        } catch (PDOException $e) {
            throw new \Exception("Error <strong>{$e->getMessage()}</strong> in model " . get_called_class());
        }
    }
}