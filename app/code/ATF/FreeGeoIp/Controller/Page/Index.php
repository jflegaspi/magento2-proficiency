<?php

namespace ATF\FreeGeoIp\Controller\Page;

use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\Webapi\Rest\Request;
use Magento\Backend\App\Action\Context;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Serialize\Serializer\Json;

class Index extends \Magento\Framework\App\Action\Action
{


    protected ClientFactory $clientFactory;

    protected ResponseFactory $responseFactory;

    protected RemoteAddress $remoteAddress;

    protected Json $json;

    public function __construct(Context $context, ClientFactory $clientFactory, ResponseFactory $responseFactory, RemoteAddress $remoteAddress, Json $json)
    {
        $this->clientFactory = $clientFactory;
        $this->responseFactory = $responseFactory;
        $this->remoteAddress = $remoteAddress;
        $this->json = $json;
        parent::__construct($context);
    }

    public function execute()
    {
        $ip = $this->remoteAddress->getRemoteAddress();
        $response = $this->requestInfo($ip . '?access_key=ae09b485f0360e25f692ad2a01334010&format=1');
        $status = $response->getStatusCode();
        $responseBody = $response->getBody();
        $responseContent = $responseBody->getContents();

        if($status === 200) {
            $result = $this->json->unserialize($responseContent);
            echo 'Your Country is: ' . $result['country_name'];
        }
        else {
            echo 'Unable to find your country based on your location';
        }


    }

    private function requestInfo(string $uriEndpoints, array $params = [], string $requestMethod = Request::HTTP_METHOD_GET) : Response
    {
        $client = $this->clientFactory->create(['config' => [
            'base_uri' => 'http://api.ipstack.com/'
        ]]);

        try {
            $response = $client->request(
                $requestMethod,
                $uriEndpoints,
                $params
            );
        } catch (GuzzleException $exception) {
            $response = $this->responseFactory->create([
                'status' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);
        }

        return $response;
    }
}
