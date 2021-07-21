<?php
namespace App\Service;

use MeiliSearch\Client;
use MeiliSearch\Endpoints\Indexes;
use MeiliSearch\Exceptions\ApiException;
use RuntimeException;

class MeiliSearchService
{
    private ?Client $client;

    public function __construct($meiliUrl, $meiliMasterKey)
    {
        $this->client = new Client($meiliUrl, $meiliMasterKey);
    }

    public function getIndex(string $index): Indexes
    {
        try {
            return $this->client->getOrCreateIndex($index);
        } catch (ApiException $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    public function addDocuments(string $index, array $documents, ?string $primaryKey = null): void
    {
        $indexResolved = $this->getIndex($index);

        if ($indexResolved instanceof Indexes) {
            $indexResolved->addDocuments($documents, $primaryKey);
        }
    }

    public function updateDocuments(string $index, array $documents, ?string $primaryKey = null): void
    {
        $indexResolved = $this->getIndex($index);

        if ($indexResolved instanceof Indexes) {
            $indexResolved->updateDocuments($documents, $primaryKey);
        }
    }

    public function deleteDocument(string $index, int|string $documentId): void
    {
        $indexResolved = $this->getIndex($index);

        if ($indexResolved instanceof Indexes) {
            $indexResolved->deleteDocument($documentId);
        }
    }

    public function deleteAllIndexes(): void
    {
        $this->client->deleteAllIndexes();
    }
}
