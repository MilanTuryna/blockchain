# FjordCoin

Zkouška vlastního blockchainu (vytvoření vlastní "kryptoměny") ovládaného pomocí Rest API.
Projekt je programován v PHP za pomocí frameworku Nette a databáze MySQL.

Rest API pro otestování je spuštěno dočasně na adrese https://turyna.eu/apps/fjordcoin - více podrobností k jednotlivým endpointům níže:

## REST API - endpointy

| Akce                      | Vstup               | Popis                                              | Test                                         |
|---------------------------|---------------------|----------------------------------------------------|----------------------------------------------|
| 1. Zobrazení blockchainu  | `GET /list`         | `Vrátí celý řetězec bloků ve správné posloupnosti` | https://turyna.eu/apps/fjordcoin/list        |
| 2. Přidání nové transakce | `POST /transaction` | `Vytvoří novou transakci`                          | https://turyna.eu/apps/fjordcoin/transaction |
| 3. Těžba bloků            | `GET /mine`         | `Spustí těžbu (funguje jen na localhostu)`         | https://turyna.eu/apps/fjordcoin/mine        | 
| 4. Validace dat           | `GET /validate`     | `Ověří správnost všech zaznamenaných bloků`        | https://turyna.eu/apps/fjordcoin/validate    |

1. Příklad výstupu:
```
[
   {
       "index": 0,
       "timestamp": 1773486825,
       "transactions": [],
       "previous_hash": "0",
       "nonce": 0,
       "hash": "7c3089410a5699faf919e4e9da09291bf5489e2af93cf4e828197f5d320191e3"
   }
]
```
