<?php

namespace App\Http\Responses;

use Symfony\Component\HttpFoundation\Response;

class Success extends Base
{
    public int $statusCode = Response::HTTP_OK;

    /**
     * Формирование содежимого ответа.
     *
     * @return array
     */
    protected function makeResponseData(): ?array
    {
        return $this-> data ? [
            'data' => $this-> prepareData()
        ] : null;
    }
}
