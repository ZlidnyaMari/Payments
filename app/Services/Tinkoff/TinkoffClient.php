<?php

namespace App\Services\Tinkoff;

use App\Services\Tinkoff\Exceptions\TinkoffExeption;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class TinkoffClient
{
    public function __construct(
        private TinkoffService $tinkoff,
    ) {}

    public static function make(TinkoffService $tinkoff): static
    {
        return new static($tinkoff);
    }

    public function post(string $url, array $data): array
    {
        $data['Token'] = $this->createToken($data);

        $response = $this->client()->post($url,$data);

        if ($response['Success'] === false) {
            throw new TinkoffExeption($response['Details']);
        }

        return $response->json();
    }

    public function client(): PendingRequest
    {
        return Http::baseUrl('https://securepay.tinkoff.ru');
    }

    public function createToken(array $data): string
    {
        unset($data['Token']);

        if (isset($data['Success'])) {
            $data['Success'] = $data['Success'] ? 'true' : 'false';
        }

        $token = $data;
        $token['Password'] = $this->tinkoff->config->password;
        $token = collect($token)->sortKeys()->implode('');
        return hash('sha256', $token);
    }
}
