<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

$client = new Client();
$apiKey = 'c7e6a6f1-0729-47d8-8e7d-8747d067b23f';

try {
    $response = $client->get("https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest", [
        'headers' => [
            'X-CMC_PRO_API_KEY' => $apiKey,
            'Accept' => 'application/json'
        ],
        'query' => [
            'limit' => 10,
            'convert' => 'USD'
        ],
        'verify' => false
    ]);
    $data = json_decode($response->getBody(), true);
    echo "Top 10 Criptomoedas:\n";
    foreach ($data['data'] as $crypto) {
        echo 'Nome: ' . $crypto['name'] . ' | Preço: ' . number_format($crypto['quote']['USD']['price'], 2, ',', '.') . ' USD' . PHP_EOL;
    }
} catch (\GuzzleHttp\Exception\RequestException $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>
