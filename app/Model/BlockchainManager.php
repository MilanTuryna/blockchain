<?php
namespace App\Model;

use Nette;

class BlockchainManager
{
    private string $chainFile;
    private string $mempoolFile;
    private int $difficulty = 2; // Počet nul na začátku hashe

    public function __construct(string $dataDir)
    {
        $this->chainFile = $dataDir . '/blockchain.json';
        $this->mempoolFile = $dataDir . '/mempool.json';

        // Inicializace souborů, pokud neexistují
        if (!file_exists($this->chainFile)) {
            $this->saveChain([$this->createGenesisBlock()]);
        }
        if (!file_exists($this->mempoolFile)) {
            $this->saveMempool([]);
        }
    }

    public function getChain(): array {
        return json_decode(file_get_contents($this->chainFile), true);
    }

    public function addTransaction(array $data): void {
        $mempool = json_decode(file_get_contents($this->mempoolFile), true);
        $mempool[] = [
            'sender' => $data['sender'],
            'recipient' => $data['recipient'],
            'amount' => $data['amount'],
            'time' => time()
        ];
        $this->saveMempool($mempool);
    }

    public function mine(): array {
        $chain = $this->getChain();
        $mempool = json_decode(file_get_contents($this->mempoolFile), true);
        $lastBlock = end($chain);

        $newBlock = [
            'index' => $lastBlock['index'] + 1,
            'timestamp' => time(),
            'transactions' => $mempool,
            'previous_hash' => $lastBlock['hash'],
            'nonce' => 0
        ];

        // Proof of Work
        while (true) {
            $hash = $this->calculateHash($newBlock);
            if (str_starts_with($hash, str_repeat('0', $this->difficulty))) {
                $newBlock['hash'] = $hash;
                break;
            }
            $newBlock['nonce']++;
        }

        $chain[] = $newBlock;
        $this->saveChain($chain);
        $this->saveMempool([]); // Vyčistit čekající transakce

        return $newBlock;
    }

    public function isValid(): bool {
        $chain = $this->getChain();
        for ($i = 1; $i < count($chain); $i++) {
            $current = $chain[$i];
            $previous = $chain[$i - 1];

            if ($current['previous_hash'] !== $previous['hash']) return false;
            if ($this->calculateHash($current) !== $current['hash']) return false;
        }
        return true;
    }

    private function calculateHash(array $block): string {
        // Hashujeme vše kromě samotného klíče 'hash'
        $data = $block;
        unset($data['hash']);
        return hash('sha256', json_encode($data));
    }

    private function createGenesisBlock(): array {
        $block = [
            'index' => 0,
            'timestamp' => time(),
            'transactions' => [],
            'previous_hash' => "0",
            'nonce' => 0
        ];
        $block['hash'] = $this->calculateHash($block);
        return $block;
    }

    private function saveChain(array $data): void {
        file_put_contents($this->chainFile, json_encode($data, JSON_PRETTY_PRINT));
    }
    private function saveMempool(array $data): void {
        file_put_contents($this->mempoolFile, json_encode($data, JSON_PRETTY_PRINT));
    }
}