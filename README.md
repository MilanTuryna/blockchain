# FjordCoin

Zkouška vlastního blockchainu (vytvoření vlastní "kryptoměny") ovládaného pomocí Rest API. 
Projekt je programován v PHP za pomocí frameworku Nette. 

Rest API pro otestování je spuštěno dočasně na adrese https://turyna.eu/apps/fjordcoin - více podrobností k jednotlivým endpointům níže:

## REST API - endpointy

| Akce                   | Vstup               | Popis                                              | Výstup |
|------------------------|---------------------|----------------------------------------------------|--------|
| Zobrazení blockchainu  | `GET /list`         | `Vrátí celý řetězec bloků ve správné posloupnosti` | `...`  |
| Přidání nové transakce | `POST /transaction` | ``                                                 |        |
| Těžba bloků            | `GET /mine`         | ``                                                 |        |
| Validace dat           | `GET /validate`     | ``                                                 |        |