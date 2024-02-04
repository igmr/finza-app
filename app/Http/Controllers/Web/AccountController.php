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
        $this->logLoadView(auth()->user()->id, "account.index");
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
        $this->logLoadView(auth()->user()->id, "account.create");
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
                $this->logCreated(auth()->user()->id, "account.store", $data['id']);
                $response['success'] = true;
                $response['data'] = $data;
                return response()->json(
                    $response,
                    Response::HTTP_CREATED
                );
            }
            $this->logError(auth()->user()->id, 'account.store', 'Data invalid.');
            return response()->json(
                $response,
                Response::HTTP_BAD_REQUEST
            );
        } catch (\Exception $ex) {
            $response['success'] = false;
            $response['data']    = [$ex];
            $this->logException(auth()->user()->id, "account.store", "{$ex->getMessage()}");
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
        $this->logLoadView(auth()->user()->id, "bank.show", "Load view for accountID: {$id}");
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
        $this->logLoadView(auth()->user()->id, "account.edit", "Load view for accountID: {$id}");
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
            $this->logError(auth()->user()->id, "account.update", "Data invalid for accountID: {$id}");
            throw new HttpResponseException(response()->json([
                'message' => 'Data invalid',
                'errors'  => ['general' => ['Error']],
            ], Response::HTTP_BAD_REQUEST));
        }
        $data = $this->service->update($id, $payload);
        $response['success'] = true;
        $response['data']    = $data;
        $this->logUpdated(auth()->user()->id, "account.update", $data['id']);
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
        try {
            if ($this->service->destroy($id)) {
                $response['success'] = true;
                $response['data'] = ['general' => ['Account deleted.']];
                $this->logDeleted(auth()->user()->id, "account.destroy", $id);
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
        } catch (\Exception $ex) {
            $this->logException(auth()->user()->id, "account.destroy", "{$ex->getMessage()}");
        }
    }

    public function restore(string $id)
    {
        try {
            if ($this->service->restore($id)) {
                $response['success'] = true;
                $response['data'] = ['general' => ['Account restored.']];
                $this->logRestored(auth()->user()->id, "account.restore", $id);
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
        } catch (\Exception $ex) {
            $this->logException(auth()->user()->id, "account.restore", "{$ex->getMessage()}");
        }
    }

    public function datatable()
    {
        $this->logQuery(auth()->user()->id, "account.datatable");
        return $this->service->datatable();
    }

    public function detail(int $id)
    {
        $this->logQuery(auth()->user()->id, "account.detail", "Load Query for accountID: {$id}.");
        return $this->service->detail($id);
    }

    public function list(Request $req)
    {
        $this->logQuery(auth()->user()->id, "account.list");
        return $this->service->list($req);
    }

    public function info(string $id)
    {
        $this->logQuery(auth()->user()->id, "account.info", "Load Query for accountID: {$id}.");
        return $this->service->info($id);
    }

    public function select()
    {
        $this->logQuery(auth()->user()->id, "account.select");
        return $this->service->select();
    }
}
