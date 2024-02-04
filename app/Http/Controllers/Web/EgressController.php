<?php

namespace App\Http\Controllers\Web;

use App\Services\EgressService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\EgressFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class EgressController extends Controller
{
    protected $service;
    public function __construct(EgressService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title']       = 'Egresses';
        $data['subtitle']    = 'List Egresses';
        $data['cssFILES']    = [];
        $data['jsFILES']     = [
            'assets/app/egress/index.js',
        ];
        $this->logLoadView(auth()->user()->id, "egress.index");
        return view('app.egresses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']    = 'Egresses';
        $data['subtitle'] = 'Add egress';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/egress/create.js',
        ];
        $this->logLoadView(auth()->user()->id, "egress.create");
        return view('app.egresses.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EgressFormRequest $req)
    {
        try {
            $response['success'] = false;
            $response['data']    = [];
            $payload             = $req->validated();
            $payload['usr_id']   = Auth::user()->id;
            $payload['cat_id']   = $payload['category'] ?? null;
            $payload['sav_id']   = $payload['saving'] ?? null;
            $payload['deb_id']   = $payload['debt'] ?? null;
            $payload['acc_id']   = $payload['account'] ?? null;
            $data    = $this->service->store($payload);
            if ($data) {
                $this->logCreated(auth()->user()->id, "egress.store", $data['id']);
                $response['success'] = true;
                $response['data'] = $data;
                return response()->json(
                    $response,
                    Response::HTTP_CREATED
                );
            }
            $this->logError(auth()->user()->id, 'egress.store', 'Data invalid.');
            return response()->json(
                $response,
                Response::HTTP_BAD_REQUEST
            );
        } catch (\Exception $ex) {
            $this->logException(auth()->user()->id, "egress.store", "{$ex->getMessage()}");
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Data invalid',
                'errors'  => ['general' => ['Error in server.']],
            ], Response::HTTP_BAD_REQUEST));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['title']    = 'egresses';
        $data['subtitle'] = 'Info egress';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/egress/info.js',
        ];
        $this->logLoadView(auth()->user()->id, "egress.show", "Load view for egressID: {$id}");
        return view('app.egresses.info', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title']    = 'Egresses';
        $data['subtitle'] = 'Edit egress';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/egress/edit.js',
        ];
        $this->logLoadView(auth()->user()->id, "egress.edit", "Load view for egressID: {$id}");
        return view('app.egresses.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EgressFormRequest $req, string $id)
    {
        $payload = $req->validated();
        if ($req->has('category')) {
            $payload['cat_id']   = $payload['category'];
        }
        if ($req->has('saving')) {
            $payload['sav_id']   = $payload['saving'];
        }
        if ($req->has('debt')) {
            $payload['deb_id']   = $payload['debt'];
        }
        if ($req->has('account')) {
            $payload['acc_id']   = $payload['account'];
        }
        $isNull  = false;
        foreach ($payload as $key => $value) {
            if (!empty($value)) {
                $isNull = true;
                break;
            }
        }
        if ($isNull == false) {
            $this->logError(auth()->user()->id, "egress.update", "Data invalid for egressID: {$id}");
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Data invalid',
                'errors'  => ['general' => ['Error']],
            ], Response::HTTP_BAD_REQUEST));
        }
        $data = $this->service->update($id, $payload);
        $response['success'] = true;
        $response['data']    = $data;
        $this->logUpdated(auth()->user()->id, "egress.update", $data['id']);
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
                $response['data'] = ['general' => ['Egress deleted.']];
                $this->logDeleted(auth()->user()->id, "egress.destroy", $id);
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
            $this->logException(auth()->user()->id, "egress.destroy", "{$ex->getMessage()}");
        }
    }

    public function restore(string $id)
    {
        try {
            if ($this->service->restore($id)) {
                $response['success'] = true;
                $response['data'] = ['general' => ['Egress restored.']];
                $this->logRestored(auth()->user()->id, "egress.restore", $id);
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
            $this->logException(auth()->user()->id, "egress.restore", "{$ex->getMessage()}");
        }
    }

    public function datatable()
    {
        $this->logQuery(auth()->user()->id, "egress.datatable");
        return $this->service->datatable();
    }

    public function detail(int $id)
    {
        $this->logQuery(auth()->user()->id, "egress.detail", "Load Query for egressID: {$id}.");
        return $this->service->detail($id);
    }

    public function list(Request $req)
    {
        $this->logQuery(auth()->user()->id, "egress.list");
        return $this->service->list($req);
    }

    public function info(string $id)
    {
        $this->logQuery(auth()->user()->id, "egress.info", "Load Query for egressID: {$id}.");
        return $this->service->info($id);
    }

    public function select()
    {
        $this->logQuery(auth()->user()->id, "egress.select");
        return $this->service->select();
    }
}
