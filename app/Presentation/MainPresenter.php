<?php

namespace App\Presentation;

use App\Model\BlockchainManager;
use JetBrains\PhpStorm\NoReturn;
use Nette\Application\UI\Presenter;

class MainPresenter extends Presenter
{
    private BlockchainManager $manager;

    public function __construct(BlockchainManager $manager)
    {
        parent::__construct();

        $this->manager = $manager;
    }

    // GET
    #[NoReturn] public function actionList(): void
    {
        $this->sendJson($this->manager->getChain());
    }

    // POST
    // Očekává JSON: {"sender": "Alice", "recipient": "Bob", "amount": 10}
    #[NoReturn] public function actionTransaction(): void
    {
        if (!$this->getHttpRequest()->isMethod('POST')) {
            $this->error('Pouze POST metoda', 405);
        }

        $data = json_decode($this->getHttpRequest()->getRawBody(), true);
        $this->manager->addTransaction($data);
        $this->sendJson(['status' => 'Transaction added to mempool']);
    }

    // GET
    #[NoReturn] public function actionMine(): void
    {
        $newBlock = $this->manager->mine();
        $this->sendJson(['message' => 'New block mined!', 'block' => $newBlock]);
    }

    // GET
    #[NoReturn] public function actionValidate(): void
    {
        $valid = $this->manager->isValid();
        $this->sendJson(['is_valid' => $valid]);
    }
}