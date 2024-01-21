<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    public function responseCreated(mixed $data, string $message = 'Resource created')
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ], Response::HTTP_CREATED);
    }

    public function responseUpdated(mixed $data, string $message = 'Resource updated')
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ], Response::HTTP_OK);
    }

    public function responseDeleted($status = true)
    {
        return response()->json([
            'status'  => $status,
            'message' => $status ? 'Resource deleted' : 'Resource not deleted',
            'data'    => [],
        ], $status ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function responseRestored($status = true)
    {
        return response()->json([
            'status'  => $status,
            'message' => $status ? 'Resource restored' : 'Resource not restored',
            'data'    => [],
        ], $status ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function responseSuccess(array $data = [], string $message = 'Operation valid')
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ], Response::HTTP_OK);
    }

    public function responseSuccessAuthorization(string $token, string $message = 'Login successfully', string $code = Response::HTTP_OK)
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => ['type' => 'Bearer Token', 'token' => $token],
        ], $code);
    }

    public function responseSuccessLogout( string $message = 'Logout successfully', string $code = Response::HTTP_OK)
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => [],
        ], $code);
    }

    public function responseErrorAuthorization(array $data = ['token' => 'token unauthorized'], string $message = 'Authorization error')
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'data'    => $data,
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function isEmpty(array $data)
    {
        if (empty($data)) {
            throw new HttpResponseException(response()->json([
                'status'  => 'error',
                'message' => 'Data invalid',
                'data'    => [],
            ], Response::HTTP_BAD_REQUEST));
        }
    }

    public function responseException($message)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'exception',
            'message' => 'Data exception',
            'errors'  => ['general' => [$message]],
        ], Response::HTTP_INTERNAL_SERVER_ERROR));
    }
}
