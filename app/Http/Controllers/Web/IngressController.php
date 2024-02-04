<?php

namespace App\Http\Controllers\Web;

use App\Services\IngressService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\IngressFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class IngressController extends Controller
{
    protected $service;
    public function __construct(IngressService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title']       = 'Ingresses';
        $data['subtitle']    = 'List ingresses';
        $data['cssFILES']    = [];
        $data['jsFILES']     = [
            'assets/app/ingress/index.js',
        ];
        $this->logLoadView(auth()->user()->id, "ingress.index");
        return view('app.ingresses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']    = 'Ingresses';
        $data['subtitle'] = 'Add ingress';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/ingress/create.js',
        ];
        $this->logLoadView(auth()->user()->id, "ingress.create");
        return view('app.ingresses.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IngressFormRequest $req)
    {
        try {
            $response['success'] = false;
            $response['data']    = [];
            $payload             = $req->validated();
            $payload['usr_id']   = Auth::user()->id;
            $payload['cls_id']   = $payload['classification'] ?? null;
            $payload['sav_id']   = $payload['saving'] ?? null;
            $payload['deb_id']   = $payload['debt'] ?? null;
            $payload['acc_id']   = $payload['account'] ?? null;
            $data    = $this->service->store($payload);
            if ($data) {
                $this->logCreated(auth()->user()->id, "ingress.store", $data['id']);
                $response['success'] = true;
                $response['data'] = $data;
                return response()->json(
                    $response,
                    Response::HTTP_CREATED
                );
            }
            $this->logError(auth()->user()->id, 'ingress.store', 'Data invalid.');
            return response()->json(
                $response,
                Response::HTTP_BAD_REQUEST
            );
        } catch (\Exception $ex) {
            $this->logException(auth()->user()->id, "ingress.store", "{$ex->getMessage()}");
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
        $data['title']    = 'Ingresses';
        $data['subtitle'] = 'Info ingress';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/ingress/info.js',
        ];
        $this->logLoadView(auth()->user()->id, "ingress.show", "Load view for ingressID: {$id}");
        return view('app.ingresses.info', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title']    = 'Ingresses';
        $data['subtitle'] = 'Edit ingress';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/ingress/edit.js',
        ];
        $this->logLoadView(auth()->user()->id, "ingress.edit", "Load view for ingressID: {$id}");
        return view('app.ingresses.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IngressFormRequest $req, string $id)
    {
        $payload = $req->validated();
        if ($req->has('classification')) {
            $payload['cls_id']   = $payload['classification'];
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
            $this->logError(auth()->user()->id, "ingress.update", "Data invalid for ingressID: {$id}");
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Data invalid',
                'errors'  => ['general' => ['Error']],
            ], Response::HTTP_BAD_REQUEST));
        }
        $data = $this->service->update($id, $payload);
        $response['success'] = true;
        $response['data']    = $data;
        $this->logUpdated(auth()->user()->id, "ingress.update", $data['id']);
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
                $response['data'] = ['general' => ['Ingress deleted.']];
                $this->logDeleted(auth()->user()->id, "ingress.destroy", $id);
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
            $this->logException(auth()->user()->id, "ingress.destroy", "{$ex->getMessage()}");
        }
    }

    public function restore(string $id)
    {
        try {
            if ($this->service->restore($id)) {
                $response['success'] = true;
                $response['data'] = ['general' => ['Ingress restored.']];
                $this->logRestored(auth()->user()->id, "ingress.restore", $id);
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
            $this->logException(auth()->user()->id, "ingress.restore", "{$ex->getMessage()}");
        }
    }

    public function datatable()
    {
        $this->logQuery(auth()->user()->id, "ingress.datatable");
        return $this->service->datatable();
    }

    public function detail(int $id)
    {
        $this->logQuery(auth()->user()->id, "ingress.detail", "Load Query for ingressID: {$id}.");
        return $this->service->detail($id);
    }

    public function list(Request $req)
    {
        $this->logQuery(auth()->user()->id, "ingress.list");
        return $this->service->list($req);
    }

    public function info(string $id)
    {
        $this->logQuery(auth()->user()->id, "ingress.info", "Load Query for ingressID: {$id}.");
        return $this->service->info($id);
    }

    public function select()
    {
        $this->logQuery(auth()->user()->id, "ingress.select");
        return $this->service->select();
    }
}
