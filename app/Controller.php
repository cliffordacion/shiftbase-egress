<?php

namespace App;

class Controller
{
    private $requestFactory;
    private $externalRequestFactory;
    private $responseFactory;
    private $activityFactory;
    private $middlewareService;

    public function __construct(
        RequestFactory $requestFactory,
        ExternalRequestFactory $externalRequestFactory,
        ResponseFactory $responseFactory,
        ActivityFactory $activityFactory,
        MiddlewareService $middlewareService
    ) {
        $this->requestFactory = $requestFactory;
        $this->externalRequestFactory = $externalRequestFactory;
        $this->responseFactory = $responseFactory;
        $this->activityFactory = $activityFactory;
        $this->middlewareService = $middlewareService;
    }
    
    public function handle()
    {
        $request = $this->requestFactory->make();

        $requestWithMiddleware = $this->middlewareService->attachRequestMiddlewares($request);
        $activity = $this->activityFactory->make($requestWithMiddleware);

        $externalRequest = $this->externalRequestFactory->makeFrom($activity);
        $externalResponse = Client::sendRequest($externalRequest);
        
        if ($externalResponse->getStatusCode() >= ResponseFactory::STATUS_BAD_REQUEST) {
            throw new ClientException($externalResponse->getStatusCode(), $externalResponse->getReasonPhrase());
        }

        $result = $this->responseFactory->makeFrom($externalResponse, $activity);
        $response = $result->response();
        $responseWithMiddleware = $this->middlewareService->attachResponseMiddlewares($response);

        return $this->response($responseWithMiddleware);
    }

    private function response(Response $response, $data = null)
    {
        $headers = $response->getHeaders();
        foreach ($headers as $key => $value) {
            header("$key: $value");
        }
        $body = $response->getBody();
        if ($data) {
            echo json_encode($body[$data]);
        } else {
            echo json_encode($body);
        }
    }
}
