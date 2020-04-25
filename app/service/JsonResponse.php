<?php


namespace app\service;


use creative\interfaces\ServiceInterface;

class JsonResponse implements ServiceInterface
{
    private array $jsonData;

    /**
     * @param array $params
     * @return $this
     */
    public function init(array $params = []): self
    {
        $this->jsonData = $params;
        return $this;
    }

    /**
     *
     */
    public function sent()
    {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => true,
            'data' => $this->jsonData,
        ]);
        exit;
    }
}
