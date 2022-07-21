<?php

namespace App\Http\Responses;

use Symfony\Component\HttpFoundation\Response;

class FailPagination extends Base
{
    public int $statusCode = Response::HTTP_NOT_FOUND;

    /**
     * ExceptionResponse constructor.
     *
     * @param $data
     * @param string|null $message
     * @param int $code
     */
    public function __construct($data, protected ?string $message = null, int $code = Response::HTTP_NOT_FOUND)
    {
        parent::__construct([], $code);
    }

    /**
     * Формирование содежимого ответа.
     *
     * @return array
     */
    protected function makeResponseData(): array
    {
        return [
            'message' => $this->message,
            'errors' => $this->prepareData(),
        ];
    }
}
