## Installation

1. Clone the repository [git clone https://github.com/v6xsqRPztZPZ5nqZ/KT8P7HSqqHQgjX.git]
2. Add the FIXER_API_KEY=e995d76715bb9941b3354cce5d7d3cc0 environment variable in your .env file.
3. `cd KT8P7HSqqHQgjX` Go to the cloned project
4. `./vendor/bin/sail` Spin on the containers
5. `./vendor/bin/phpunit` Run tests

## Usage

Two endpoints were created

GET http://localhost/api/currency
Description: Returns all available currencies.
Response array of names and symbols
Example:
<br />
```
[{"name":"United Arab Emirates Dirham","symbol":"AED"},{"name":"Afghan Afghani","symbol":"AFN"},{"name":"Albanian Lek","symbol":"ALL"},{"name":"Armenian Dram","symbol":"AMD"}]
```

POST http://localhost/api/currency/exchange
Description: Returns convert a currency into another 
Body Parameters:
<br />
```
"from": "USD",
"to": "EUR",
"amount": 1.05
```
Response: 
```
"from": "USD",
"to": "EUR",
"amount": 1.05,
"amount_exchanged": 0.93
```

