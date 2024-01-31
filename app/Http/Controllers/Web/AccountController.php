<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\AccountFormRequest;
use App\Services\AccountService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class AccountController extends Controller
{
    protected $service;
    public function __construct(AccountService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title']    = 'Accounts';
        $data['subtitle'] = 'List accounts';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/account/index.js',
        ];
        return view('app.accounts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']    = 'Accounts';
        $data['subtitle'] = 'Add account';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/account/create.js',
        ];
        return view('app.accounts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountFormRequest $req)
    {
        try {
            $response['success'] = false;
            $response['data']    = [];
            $payload             = $req->validated();
            $payload['usr_id']   = Auth::user()->id;
            $payload['ban_id']   = $payload['bank'];
            $data    = $this->service->store($payload);
            if ($data) {
                $response['success'] = true;
                $response['data'] = $data;
                return response()->json(
                    $response,
                    Response::HTTP_CREATED
                );
            }
            return response()->json(
                $response,
                Response::HTTP_BAD_REQUEST
            );
        } catch (\Exception $ex) {
            $response['success'] = false;
            $response['data']    = [$ex];
            return response()->json(
                $response,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['title']    = 'Accounts';
        $data['subtitle'] = 'Info account';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/account/info.js',
        ];
        return view('app.accounts.info', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title']    = 'Accounts';
        $data['subtitle'] = 'Edit account';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/account/edit.js',
        ];
        return view('app.accounts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountFormRequest $req, string $id)
    {
        $payload = $req->validated();
        if ($req->has('bank')) {
            $payload['ban_id']   = $payload['bank'];
        }
        $isNull  = false;
        foreach ($payload as $key => $value) {
            if (!empty($value)) {
                $isNull = true;
                break;
            }
        }
        if ($isNull == false) {
            throw new HttpResponseException(response()->json([
                'message' => 'Data invalid',
                'errors'  => ['general' => ['Error']],
            ], Response::HTTP_BAD_REQUEST));
        }
        $data = $this->service->update($id, $payload);
        $response['success'] = true;
        $response['data']    = $data;
        return response()->json(
            $response,
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->service->destroy($id)) {
            $response['success'] = true;
            $response['data'] = ['general' => ['Account deleted.']];
            return response()->json(
                $response,
                Response::HTTP_OK
            );
        }
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Data invalid',
            'errors'  => ['general' => ['Error in server.']],
        ], Response::HTTP_BAD_REQUEST));
    }

    public function restore(string $id)
    {
        if ($this->service->restore($id)) {
            $response['success'] = true;
            $response['data'] = ['general' => ['Account restored.']];
            return response()->json(
                $response,
                Response::HTTP_OK
            );
        }
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Data invalid',
            'errors'  => ['general' => ['Error in server.']],
        ], Response::HTTP_BAD_REQUEST));
    }

    public function datatable()
    {
        return $this->service->datatable();
    }
    
    public function detail(int $id)
    {
        return $this->service->detail($id);
    }

    public function list(Request $req)
    {
        return $this->service->list($req);
    }

    public function info(string $id)
    {
        return $this->service->info($id);
    }

    public function select()
    {
        return $this->service->select();
    }
}
