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
            'assets/app/tools.js',
            'assets/app/services.js',
            'assets/app/gender/index.js',
        ];
        $data['labelCreate'] = 'Add Gender';
        $data['routeCreate'] = 'app.gender.create';
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
            'assets/app/tools.js',
            'assets/app/services.js',
            'assets/app/showErrorsForm.js',
            'assets/app/gender/create.js',
        ];
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['title']    = 'Genders';
        $data['subtitle'] = 'Info gender';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/tools.js',
            'assets/app/showErrorsForm.js',
            'assets/app/services.js',
            'assets/app/gender/info.js',
        ];
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
            'assets/app/tools.js',
            'assets/app/showErrorsForm.js',
            'assets/app/services.js',
            'assets/app/gender/edit.js',
        ];
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
            throw new HttpResponseException(response()->json([
                'success' => false,
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
            $response['data'] = ['general' => ['Gender deleted.']];
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
    }

    public function restore(string $id)
    {
        if ($this->service->restore($id)) {
            $response['success'] = true;
            $response['data'] = ['general' => ['Gender restored.']];
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
