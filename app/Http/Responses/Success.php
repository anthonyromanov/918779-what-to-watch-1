<?php

namespace App\Http\Responses;

use Symfony\Component\HttpFoundation\Response;

class FailValidation extends Base
{
    public int $statusCode = Response::HTTP_OK;

    /**
     * Формирование содежимого ответа.
     *
     * @return array
     */
    protected function makeResponseData(): array
    {
        return $this->prepareData();
    }
}
