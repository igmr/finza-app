<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\DebtFormRequest;
use App\Services\DebtService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class DebtController extends Controller
{
    protected $service;
    public function __construct(DebtService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title']    = 'Debts';
        $data['subtitle'] = 'List debts';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/debt/index.js',
        ];
        return view('app.debts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']    = 'Debts';
        $data['subtitle'] = 'Add debt';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/debt/create.js',
        ];
        return view('app.debts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DebtFormRequest $req)
    {
        try {
            $response['success'] = false;
            $response['data']    = [];
            $payload             = $req->validated();
            $payload['usr_id']   = Auth::user()->id;
            $payload['cat_id']   = $payload['category'] ?? null;
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
        $data['title']    = 'Debts';
        $data['subtitle'] = 'Info debt';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/debt/info.js',
        ];
        return view('app.debts.info', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title']    = 'Debts';
        $data['subtitle'] = 'Edit debt';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/debt/edit.js',
        ];
        return view('app.debts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DebtFormRequest $req, string $id)
    {
        try {
            $payload = $req->validated();
            if ($req->has('category')) {
                $payload['cat_id']   = $payload['category'];
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
            $response['payload']    = $payload;
            $response['id']       = $id;
            $response['data']       = $data;
            return response()->json(
                $response,
                Response::HTTP_OK
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->service->destroy($id)) {
            $response['success'] = true;
            $response['data'] = ['general' => ['Debt deleted.']];
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
            $response['data'] = ['general' => ['Debt restored.']];
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
