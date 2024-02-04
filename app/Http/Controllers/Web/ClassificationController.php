<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ClassificationFormRequest;
use App\Services\ClassificationService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ClassificationController extends Controller
{
    protected $service;
    public function __construct(ClassificationService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title']       = 'Classifications';
        $data['subtitle']    = 'List classification';
        $data['cssFILES']    = [];
        $data['jsFILES']     = [
            'assets/app/classification/index.js',
        ];
        $data['labelCreate'] = 'Add classification';
        $data['routeCreate'] = 'app.classification.create';
        $this->logLoadView(auth()->user()->id, "classification.index");
        return view('app.classifications.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']    = 'Classifications';
        $data['subtitle'] = 'Add classification';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/classification/create.js',
        ];
        $this->logLoadView(auth()->user()->id, "classification.create");
        return view('app.classifications.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassificationFormRequest $req)
    {
        try {
            $response['success'] = false;
            $response['data']    = [];
            $payload             = $req->validated();
            $payload['usr_id']   = Auth::user()->id;
            $data    = $this->service->store($payload);
            if ($data) {
                $response['success'] = true;
                $response['data'] = $data;
                $this->logCreated(auth()->user()->id, "classification.store", $data['id']);
                return response()->json(
                    $response,
                    Response::HTTP_CREATED
                );
            }
            $this->logError(auth()->user()->id, 'classification.store', 'Data invalid.');
            return response()->json(
                $response,
                Response::HTTP_BAD_REQUEST
            );
        } catch (\Exception $ex) {
            $this->logException(auth()->user()->id, "classification.store", "{$ex->getMessage()}");
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
        $data['title']    = 'Classifications';
        $data['subtitle'] = 'Info classification';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/classification/info.js',
        ];
        $this->logLoadView(auth()->user()->id, "classification.show", "Load view for classificationID: {$id}");
        return view('app.classifications.info', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title']    = 'Classifications';
        $data['subtitle'] = 'Edit classification';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/classification/edit.js',
        ];
        $this->logLoadView(auth()->user()->id, "classification.edit", "Load view for classificationID: {$id}");
        return view('app.classifications.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassificationFormRequest $req, string $id)
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
            $this->logError(auth()->user()->id, "classification.update", "Data invalid for classificationID: {$id}");
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Data invalid',
                'errors'  => ['general' => ['Error']],
            ], Response::HTTP_BAD_REQUEST));
        }
        $data = $this->service->update($id, $payload);
        $response['success'] = true;
        $response['data']    = $data;
        $this->logUpdated(auth()->user()->id, "classification.update", $data['id']);
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
                $response['data'] = ['general' => ['Classification deleted.']];
                $this->logDeleted(auth()->user()->id, "classification.destroy", $id);
                return response()->json(
                    $response,
                    Response::HTTP_CREATED
                );
            }
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Data invalid',
                'errors'  => ['general' => ['Error in server.']],
            ], Response::HTTP_BAD_REQUEST));
        } catch (\Exception $ex) {
            $this->logException(auth()->user()->id, "classification.destroy", "{$ex->getMessage()}");
        }
    }

    public function restore(string $id)
    {
        try {
            if ($this->service->restore($id)) {
                $response['success'] = true;
                $response['data'] = ['general' => ['Classification restored.']];
                $this->logRestored(auth()->user()->id, "classification.restore", $id);
                return response()->json(
                    $response,
                    Response::HTTP_CREATED
                );
            }
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Data invalid',
                'errors'  => ['general' => ['Error in server.']],
            ], Response::HTTP_BAD_REQUEST));
        } catch (\Exception $ex) {
            $this->logException(auth()->user()->id, "classification.restore", "{$ex->getMessage()}");
        }
    }

    public function datatable()
    {
        $this->logQuery(auth()->user()->id, "classification.datatable");
        return $this->service->datatable();
    }

    public function detail(int $id)
    {
        $this->logQuery(auth()->user()->id, "classification.detail", "Load Query for classificationID: {$id}.");
        return $this->service->detail($id);
    }

    public function list(Request $req)
    {
        $this->logQuery(auth()->user()->id, "classification.list");
        return $this->service->list($req);
    }

    public function info(string $id)
    {
        $this->logQuery(auth()->user()->id, "classification.info", "Load Query for classificationID: {$id}.");
        return $this->service->info($id);
    }

    public function select()
    {
        $this->logQuery(auth()->user()->id, "classification.select");
        return $this->service->select();
    }
}
