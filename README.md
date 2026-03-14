# FjordCoin

Zkouška vlastního blockchainu (vytvoření vlastní "kryptoměny") ovládaného pomocí Rest API. 
Projekt je programován v PHP za pomocí frameworku Nette. 

Rest API pro otestování je spuštěno dočasně na adrese https://turyna.eu/apps/fjordcoin - více podrobností k jednotlivým endpointům níže:

## REST API - endpointy

| Akce                   | Vstup               | Popis                                              | Výstup (př.) | Test                                         |
|------------------------|---------------------|----------------------------------------------------|--------------|----------------------------------------------|
| Zobrazení blockchainu  | `GET /list`         | `Vrátí celý řetězec bloků ve správné posloupnosti` | `...`        | https://turyna.eu/apps/fjordcoin/list        |
| Přidání nové transakce | `POST /transaction` | `Vytvoří novou transakci`                          |              | https://turyna.eu/apps/fjordcoin/transaction |
| Těžba bloků            | `GET /mine`         | `Spustí těžbu (funguje jen na localhostu)`         |              | https://turyna.eu/apps/fjordcoin/mine        | 
| Validace dat           | `GET /validate`     | `Ověří správnost všech zaznamenaných bloků`        |              | https://turyna.eu/apps/fjordcoin/validate    |