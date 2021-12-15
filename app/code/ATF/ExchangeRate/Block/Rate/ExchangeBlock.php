<?php

namespace ATF\ExchangeRate\Block\Rate;

use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Webapi\Rest\Request;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Serialize\Serializer\JsonFactory;

class ExchangeBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @var ClientFactory
     */
    protected ClientFactory $clientFactory;

    /**
     * @var ResponseFactory
     */
    protected ResponseFactory $responseFactory;

    /**
     * @var JsonFactory
     */
    protected JsonFactory $jsonFactory;


    /**
     * @param Template\Context $context
     * @param ClientFactory $clientFactory
     * @param ResponseFactory $responseFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ClientFactory $clientFactory,
        ResponseFactory $responseFactory,
        JsonFactory $jsonFactory,
        array $data = [])
    {
        $this->clientFactory = $clientFactory;
        $this->responseFactory = $responseFactory;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context, $data);
    }

    public function displayBlock()
    {
        $path = '/v1/latest?access_key=24745a001649fca3a304847530551936&format=1&symbols=USD,EUR';
        $request = $this->_requestExchangeRate($path);
        $status = $request->getStatusCode();
        $body = $request->getBody();
        $content = $body->getContents();
        $json = $this->jsonFactory->create();
        $toArray = $json->unserialize($content);

        if($status === 200) {
            return ['rates' => $toArray['rates'], 'base' => $toArray['base'], 'success' => $toArray['success']];
        }
        else {
            return ['success' => false];
        }

    }

    protected function _requestExchangeRate(string $uriEndpoints, array $params = [], string $requestMethod = Request::HTTP_METHOD_GET) : Response
    {
        $client = $this->clientFactory->create(['config' => [
            'base_uri' => 'http://api.exchangeratesapi.io/'
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
