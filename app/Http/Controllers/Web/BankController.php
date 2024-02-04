<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BankFormRequest;
use App\Services\AccountService;
use App\Services\BankService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class BankController extends Controller
{
    protected $service;
    protected $serviceAccount;
    public function __construct(BankService $service, AccountService $serviceAccount)
    {
        $this->service = $service;
        $this->serviceAccount = $serviceAccount;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title']    = 'Banks';
        $data['subtitle'] = 'List banks';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/bank/index.js',
        ];
        $this->logLoadView(auth()->user()->id, "bank.index");
        return view('app.banks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']    = 'Banks';
        $data['subtitle'] = 'Add bank';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/bank/create.js',
        ];
        $this->logLoadView(auth()->user()->id, "bank.create");
        return view('app.banks.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BankFormRequest $req)
    {
        try {
            $response['success'] = false;
            $response['data']    = [];
            $payload             = $req->validated();
            $payload['usr_id']   = Auth::user()->id;
            $payload['status']   = 'Activo';
            $data    = $this->_store($payload);
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
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Data invalid',
                'errors'  => ['general' => ['Error in server.']],
            ], Response::HTTP_BAD_REQUEST));
        }
    }

    private function _store($payload)
    {
        try {
            DB::beginTransaction();
            /* ============================================================= */
            /* CREATE BANK                                                   */
            /* ============================================================= */
            $bank = $this->service->store($payload);
            /* ============================================================= */
            /* PAYLOAD ACCOUNT                                               */
            /* ============================================================= */
            $data['usr_id'] = $bank->usr_id;
            $data['ban_id'] = $bank->id;
            $data['name']   = $bank->name;
            $data['status'] = 'Activo';
            /* ============================================================= */
            /* CREATE ACCOUNT                                                */
            /* ============================================================= */
            $store = $this->serviceAccount->store($data);
            $this->logCreated(auth()->user()->id, "bank.store", $store['id']);
            DB::commit();
            return $bank;
        } catch (\Exception $ex) {
            $this->logException(auth()->user()->id, "bank.store", "{$ex->getMessage()}");
            DB::rollBack();
            return new stdClass();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['title']    = 'Banks';
        $data['subtitle'] = 'Info bank';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/bank/info.js',
        ];
        $this->logLoadView(auth()->user()->id, "bank.show", "Load view for bankID: {$id}");
        return view('app.banks.info', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title']    = 'Banks';
        $data['subtitle'] = 'Edit bank';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/bank/edit.js',
        ];
        $this->logLoadView(auth()->user()->id, "bank.edit", "Load view for bankID: {$id}");
        return view('app.banks.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BankFormRequest $req, string $id)
    {
        $payload = $req->validated();
        $isNull  = false;
        foreach ($payload as $key => $value) {
            if (!empty($value)) {
                $isNull = true;
                break;
            }
        }
        if ($isNull == false) {
            $this->logError(auth()->user()->id, "bank.update", "Data invalid for bankID: {$id}");
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Data invalid',
                'errors'  => ['general' => ['Error']],
            ], Response::HTTP_BAD_REQUEST));
        }
        $data = $this->service->update($id, $payload);
        $response['success'] = true;
        $response['data']    = $data;
        $this->logUpdated(auth()->user()->id, "bank.update", $data['id']);
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
                $response['data'] = ['general' => ['Bank deleted.']];
                $this->logDeleted(auth()->user()->id, "bank.destroy", $id);
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
            $this->logException(auth()->user()->id, "bank.destroy", "{$ex->getMessage()}");
        }
    }

    public function restore(string $id)
    {
        try {
            if ($this->service->restore($id)) {
                $response['success'] = true;
                $response['data'] = ['general' => ['Bank restored.']];
                $this->logRestored(auth()->user()->id, "bank.restore", $id);
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
            $this->logException(auth()->user()->id, "bank.restore", "{$ex->getMessage()}");
        }
    }

    public function datatable()
    {
        $this->logQuery(auth()->user()->id, "bank.datatable");
        return $this->service->datatable();
    }

    public function detail(int $id)
    {
        $this->logQuery(auth()->user()->id, "bank.detail", "Load Query for bankID: {$id}.");
        return $this->service->detail($id);
    }

    public function list(Request $req)
    {
        $this->logQuery(auth()->user()->id, "bank.list");
        return $this->service->list($req);
    }

    public function info(string $id)
    {
        $this->logQuery(auth()->user()->id, "bank.info", "Load Query for bankID: {$id}.");
        return $this->service->info($id);
    }

    public function select()
    {
        $this->logQuery(auth()->user()->id, "bank.select");
        return $this->service->select();
    }
}
