<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;


class SmsController extends Controller
{
    protected $client;
    protected $tokenUrl = 'https://api.orange.com/oauth/v3/token';
    protected $messagingUrl = 'https://api.orange.com/smsmessaging/v1/outbound/tel%3A%2B225/requests'; // Remplacez 225 par votre code pays
    protected $senderName = 'ALLIANCE T'; // Remplacez par votre sender name personnalisé

    public function __construct()
    {
        $this->client = new Client();
    }

// ... (Code pour récupérer le token d'accès)
protected function getAccessToken()
{
    try {
        $response = $this->client->post($this->tokenUrl, [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode(env('ORANGE_SMS_CLIENT_ID') . ':' . env('ORANGE_SMS_CLIENT_SECRET')),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if (isset($data['access_token'])) {
            return $data['access_token'];
        } else {
            Log::error('Erreur lors de la récupération du token Orange SMS: token non trouvé dans la réponse');
            return null;
        }
    } catch (\GuzzleHttp\Exception\RequestException $e) {
        Log::error('Erreur HTTP lors de la récupération du token Orange SMS: ' . $e->getMessage());
        return null;
    } catch (\Exception $e) {
        Log::error('Erreur lors de la récupération du token Orange SMS: ' . $e->getMessage());
        return null;
    }
}

    public function sendSms($recipientPhoneNumber, $message)
    {
        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            return false;
        }

        try {
            $response = $this->client->post($this->messagingUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'outboundSMSMessageRequest' => [
                        'address' => 'tel:+' . $recipientPhoneNumber,
                        'senderAddress' => 'tel:+225', // Remplacez 225 par votre code pays
                        'senderName' => $this->senderName, // Ajouter cette ligne
                        'outboundSMSTextMessage' => [
                            'message' => $message,
                        ],
                    ],
                ],
            ]);

            Log::info('SMS envoyé avec succès à ' . $recipientPhoneNumber . ': ' . $message);
            return true;
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi du SMS à ' . $recipientPhoneNumber . ': ' . $e->getMessage());
            return false;
        }
    }
}