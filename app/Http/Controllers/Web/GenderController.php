<?php

namespace App\Http\Controllers\Web;

use App\Services\GenderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\GenderFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class GenderController extends Controller
{
    protected $service;
    public function __construct(GenderService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title']       = 'Genders';
        $data['subtitle']    = 'List genders';
        $data['cssFILES']    = [];
        $data['jsFILES']     = [
            'assets/app/gender/index.js',
        ];
        $data['labelCreate'] = 'Add Gender';
        $data['routeCreate'] = 'app.gender.create';
        $this->logLoadView(auth()->user()->id, "gender.index");
        return view('app.genders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']    = 'Genders';
        $data['subtitle'] = 'Add gender';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/gender/create.js',
        ];
        $this->logLoadView(auth()->user()->id, "gender.create");
        return view('app.genders.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenderFormRequest $req)
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
                $this->logCreated(auth()->user()->id, "gender.store", $data['id']);
                return response()->json(
                    $response,
                    Response::HTTP_CREATED
                );
            }
            $this->logError(auth()->user()->id, 'gender.store', 'Data invalid.');
            return response()->json(
                $response,
                Response::HTTP_BAD_REQUEST
            );
        } catch (\Exception $ex) {
            $this->logException(auth()->user()->id, "gender.store", "{$ex->getMessage()}");
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
        $data['title']    = 'Genders';
        $data['subtitle'] = 'Info gender';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/gender/info.js',
        ];
        $this->logLoadView(auth()->user()->id, "gender.show", "Load view for genderID: {$id}");
        return view('app.genders.info', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title']    = 'Genders';
        $data['subtitle'] = 'Edit gender';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/gender/edit.js',
        ];
        $this->logLoadView(auth()->user()->id, "gender.edit", "Load view for genderID: {$id}");
        return view('app.genders.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenderFormRequest $req, string $id)
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
            $this->logError(auth()->user()->id, "gender.update", "Data invalid for genderID: {$id}");
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Data invalid',
                'errors'  => ['general' => ['Error']],
            ], Response::HTTP_BAD_REQUEST));
        }
        $data = $this->service->update($id, $payload);
        $response['success'] = true;
        $response['data']    = $data;
        $this->logUpdated(auth()->user()->id, "gender.update", $data['id']);
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
                $response['data'] = ['general' => ['Gender deleted.']];
                $this->logDeleted(auth()->user()->id, "gender.destroy", $id);
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
            $this->logException(auth()->user()->id, "gender.destroy", "{$ex->getMessage()}");
        }
    }

    public function restore(string $id)
    {
        try {
            if ($this->service->restore($id)) {
                $response['success'] = true;
                $response['data'] = ['general' => ['Gender restored.']];
                $this->logRestored(auth()->user()->id, "gender.restore", $id);
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
            $this->logException(auth()->user()->id, "gender.restore", "{$ex->getMessage()}");
        }
    }

    public function datatable()
    {
        $this->logQuery(auth()->user()->id, "gender.datatable");
        return $this->service->datatable();
    }

    public function detail(int $id)
    {
        $this->logQuery(auth()->user()->id, "gender.detail", "Load Query for genderID: {$id}.");
        return $this->service->detail($id);
    }

    public function list(Request $req)
    {
        $this->logQuery(auth()->user()->id, "gender.list");
        return $this->service->list($req);
    }

    public function info(string $id)
    {
        $this->logQuery(auth()->user()->id, "gender.info", "Load Query for genderID: {$id}.");
        return $this->service->info($id);
    }

    public function select()
    {
        $this->logQuery(auth()->user()->id, "gender.select");
        return $this->service->select();
    }
}
