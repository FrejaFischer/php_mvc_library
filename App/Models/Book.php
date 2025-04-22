<?php

namespace App\Models;

use PDO;
use PDOException;

class Book extends \Core\Model
{
    public static function getAll(): array
    {
        try {
            $sql = <<<'SQL'
                SELECT
                    tbook.nBookID AS book_id,
                    tbook.cTitle AS title,
                    tauthor.cName AS author_first_name,
                    tauthor.cSurname AS author_last_name,
                    tpublishingcompany.cName AS publisher,
                    tbook.nPublishingYear AS publishing_year
                FROM tbook
                    INNER JOIN tauthor
                        ON tbook.nAuthorID = tauthor.nAuthorID
                    INNER JOIN tpublishingcompany
                        ON tbook.nPublishingCompanyID = tpublishingcompany.nPublishingCompanyID
                ORDER BY tbook.cTitle;
            SQL;

            return self::execute($sql);
        } catch (PDOException $e) {
            throw new \Exception("Error <strong>{$e->getMessage()}</strong> in model " . get_called_class());
        }
    }

    private static function validate(string $title, int $authorID, int $publishingID): array
    {
        $validationErrors = [];
        if (empty($title)) {
            $validationErrors[] = 'Title is mandatory';
        }
        if ($authorID === 0) {
            $validationErrors[] = 'Missing author';
        }
        if ($publishingID === 0) {
            $validationErrors[] = 'Missing publisher';
        }
        return $validationErrors;
    }

    public static function create(array $columns): int|array
    {
        $title = trim($columns['title'] ?? '');
        $authorID = (int)($columns['author'] ?? 0);
        $publishingYear = (int)($columns['publishing_year'] ?? 0);
        $publishingID = (int)($columns['publisher'] ?? 0);

        $validationErrors = self::validate($title, $authorID, $publishingID);
        if (!empty($validationErrors)) {
            return $validationErrors;
        }

        try {
            $sql = <<<'SQL'
                INSERT INTO tbook
                    (cTitle, nAuthorID, nPublishingYear, nPublishingCompanyID)
                VALUES
                    (:title, :authorID, :publishingYear, :publisherID)
            SQL;

            return self::execute($sql, [
                'title' => $title,
                'authorID' => $authorID,
                'publishingYear' => $publishingYear,
                'publisherID' => $publishingID,
            ]);
        } catch (PDOException $e) {
            throw new \Exception("Error <strong>{$e->getMessage()}</strong> in model " . get_called_class());
        }
    }

    public static function delete(int $bookID): bool
    {
        try {
            $sql = <<<'SQL'
                DELETE FROM tbook
                WHERE nBookID = :bookID;
            SQL;

            return self::execute($sql, [
                'bookID' => $bookID
            ]);
        } catch (PDOException $e) {
            throw new \Exception("Error <strong>{$e->getMessage()}</strong> in model " . get_called_class());
        }
    }
}