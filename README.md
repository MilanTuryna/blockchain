# FjordCoin

Zkouška vlastního blockchainu (vytvoření vlastní "kryptoměny") ovládaného pomocí Rest API.
Projekt je programován v PHP za pomocí frameworku Nette a databáze MySQL.

## Instalace na lokálním serveru

1. **Klonování repozitáře:** Stáhněte si kód pomocí `git clone [URL_REPOZITARE]` nebo stažením ZIP archivu.
2. **Instalace závislostí:** V kořenovém adresáři projektu spusťte příkaz `composer install` pro doinstalování frameworku Nette.
3. **Příprava dat:** Ujistěte se, že složka `temp/` má práva pro zápis (zde se budou vytvářet soubory `blockchain.json` a `mempool.json`).
4. **Spuštění serveru:** Nejrychlejší cestou je použít vestavěný PHP server příkazem `php -S localhost:8000 -t www` případně (doporučuji) použít XAMPP/WAMP/Laragon.
5. **Ověření:** Otevřete v prohlížeči adresu `http://localhost:8000/blockchain/chain` – měli byste vidět vygenerovaný Genesis blok.

## REST API - endpointy

| Akce                      | Vstup               | Popis                                              | Test ( TO-DO :( )                            |
|---------------------------|---------------------|----------------------------------------------------|----------------------------------------------|
| 1. Zobrazení blockchainu  | `GET /list`         | `Vrátí celý řetězec bloků ve správné posloupnosti` | https://turyna.eu/apps/fjordcoin/list        |
| 2. Přidání nové transakce | `POST /transaction` | `Vytvoří novou transakci a zařadí ji do fronty`    | https://turyna.eu/apps/fjordcoin/transaction |
| 3. Těžba bloků            | `GET /mine`         | `Spustí těžbu (funguje jen na localhostu)`         | https://turyna.eu/apps/fjordcoin/mine        | 
| 4. Validace dat           | `GET /validate`     | `Ověří správnost všech zaznamenaných bloků`        | https://turyna.eu/apps/fjordcoin/validate    |

## 1. Zobrazení řetězce
- **URL:** `/list`
- **Metoda:** `GET`
- **Odpověď (200 OK):**
```json
[
  {
    "index": 0,
    "timestamp": 1715434001,
    "transactions": [],
    "previous_hash": "0",
    "nonce": 0,
    "hash": "00a12b3c4d5e6f..."
  }
]

```
![Zobrazení řetězce - screenshot z lokálního serveru](/screenshot.png)

---

## 2. Přidání transakce

* **URL:** `/transaction`
* **Metoda:** `POST`
* **Vstupní JSON:**

```json
{
  "sender": "Petr",
  "recipient": "Pavel",
  "amount": 50
}

```

* **Odpověď (200 OK):**

```json
{
  "status": "Transaction added to mempool"
}

```

---

## 3. Těžení nového bloku

* **URL:** `/mine`
* **Metoda:** `GET`
* **Odpověď (200 OK):**

```json
{
  "message": "New block mined!",
  "block": {
    "index": 1,
    "timestamp": 1615432500,
    "transactions": [...],
    "previous_hash": "hash_predchoziho_bloku",
    "nonce": 482,
    "hash": "0034ef..."
  }
}

```

---

## 4. Validace integrity

* **URL:** `/validate`
* **Metoda:** `GET`
* **Odpověď (200 OK):**

```json
{
  "is_valid": true
}
```
