<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BudgetFormRequest;
use App\Services\BudgetService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class BudgetController extends Controller
{
    protected $service;
    public function __construct(BudgetService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title']    = 'Budgets';
        $data['subtitle'] = 'List budgets';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/services.js',
            'assets/app/tools.js',
            'assets/app/budget/index.js',
        ];
        return view('app.budgets.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']    = 'Budgets';
        $data['subtitle'] = 'Add budget';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/tools.js',
            'assets/app/services.js',
            'assets/app/showErrorsForm.js',
            'assets/app/budget/create.js',
        ];
        return view('app.budgets.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BudgetFormRequest $req)
    {
        try {
            $response['success'] = false;
            $response['data']    = [];
            $payload             = $req->validated();
            $payload['usr_id']   = Auth::user()->id;
            $payload['acc_id']   = $payload['account'] ?? null;
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
        $data['title']    = 'Budgets';
        $data['subtitle'] = 'Info budget';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/tools.js',
            'assets/app/showErrorsForm.js',
            'assets/app/services.js',
            'assets/app/budget/info.js',
        ];
        return view('app.budgets.info', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title']    = 'Budgets';
        $data['subtitle'] = 'Edit budget';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/tools.js',
            'assets/app/showErrorsForm.js',
            'assets/app/services.js',
            'assets/app/budget/edit.js',
        ];
        return view('app.budgets.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BudgetFormRequest $req, string $id)
    {
        $payload = $req->validated();
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
            $response['data'] = ['general' => ['Budget deleted.']];
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
            $response['data'] = ['general' => ['Budget restored.']];
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
