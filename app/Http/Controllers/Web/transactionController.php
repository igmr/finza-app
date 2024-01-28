<?php

namespace App\Http\Controllers\Web;

use App\Services\EgressService;
use App\Services\IngressService;
use App\Services\TransactionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\TransactionFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class transactionController extends Controller
{
    protected $service;
    protected $serviceIngress;
    protected $serviceEgress;
    public function __construct(
        TransactionService $service,
        EgressService $serviceEgress,
        IngressService $serviceIngress
    ) {
        $this->service        = $service;
        $this->serviceIngress = $serviceIngress;
        $this->serviceEgress  = $serviceEgress;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title']       = 'Transaction';
        $data['subtitle']    = 'List transactions';
        $data['cssFILES']    = [];
        $data['jsFILES']     = [
            'assets/app/tools.js',
            'assets/app/services.js',
            'assets/app/transaction/index.js',
        ];
        return view('app.transactions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title']    = 'Transactions';
        $data['subtitle'] = 'Add transaction';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/tools.js',
            'assets/app/services.js',
            'assets/app/showErrorsForm.js',
            'assets/app/transaction/create.js',
        ];
        return view('app.transactions.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionFormRequest $req)
    {
        $payload = $req->validated();
        try {
            DB::beginTransaction();
            // ================================================================ //
            // Egresses                                                         //
            // ================================================================ //
            $payloadEgress = [];
            $payloadEgress['usr_id']      = Auth::user()->id;
            $payloadEgress['cat_id']      = $payload['category'] ?? null;
            $payloadEgress['sav_id']      = $payload['saving'] ?? null;
            $payloadEgress['deb_id']      = $payload['debt'] ?? null;
            $payloadEgress['acc_id']      = $payload['account_from'] ?? null;
            $payloadEgress['concept']     = $payload['concept'] ?? null;
            $payloadEgress['description'] = $payload['description'] ?? null;
            $payloadEgress['reference']   = $payload['reference'] ?? null;
            $payloadEgress['amount']      = $payload['amount'] ?? null;
            $payloadEgress['observation'] = $payload['observation'] ?? null;
            $payloadEgress['status']      = 'Activo';
            $dataEgress   = $this->serviceEgress->store($payloadEgress);
            // ================================================================ //
            // Ingresses                                                        //
            // ================================================================ //
            $payloadIngress = [];
            $payloadIngress['usr_id']      = Auth::user()->id;
            $payloadIngress['cls_id']      = $payload['classification'] ?? null;
            $payloadIngress['sav_id']      = $payload['saving'] ?? null;
            $payloadIngress['deb_id']      = $payload['debt'] ?? null;
            $payloadIngress['acc_id']      = $payload['account_to'] ?? null;
            $payloadIngress['concept']     = $payload['concept'] ?? null;
            $payloadIngress['description'] = $payload['description'] ?? null;
            $payloadIngress['reference']   = $payload['reference'] ?? null;
            $payloadIngress['amount']      = $payload['amount'] ?? null;
            $payloadIngress['observation'] = $payload['observation'] ?? null;
            $payloadIngress['status']      = 'Activo';
            $dataIngress   = $this->serviceIngress->store($payloadIngress);
            // ================================================================ //
            // Transactions                                                     //
            // ================================================================ //
            $payloadTransaction = [];
            $payloadTransaction['usr_id']       = Auth::user()->id;
            $payloadTransaction['egr_id']       = $dataEgress->id;
            $payloadTransaction['ing_id']       = $dataIngress->id;
            $payloadTransaction['acc_egr_id']   = $payload['account_from'] ?? null;
            $payloadTransaction['acc_ing_id']   = $payload['account_to'] ?? null;
            $payloadTransaction['cls_id']       = $payload['classification'] ?? null;
            $payloadTransaction['cat_id']       = $payload['category'] ?? null;
            $payloadTransaction['sav_id']       = $payload['saving'] ?? null;
            $payloadTransaction['deb_id']       = $payload['debt'] ?? null;
            $payloadTransaction['concept']      = $payload['concept'] ?? null;
            $payloadTransaction['description']  = $payload['description'] ?? null;
            $payloadTransaction['reference']    = $payload['reference'] ?? null;
            $payloadTransaction['amount']       = $payload['amount'] ?? null;
            $payloadTransaction['observation']  = $payload['observation'] ?? null;
            $payloadTransaction['status']       = 'Activo';
            $dataTransaction   = $this->service->store($payloadTransaction);
            // ================================================================ //
            // Create                                                           //
            // ================================================================ //
            DB::commit();
            $response = [
                'transaction' => $dataTransaction,
                'egress' => $dataEgress,
                'ingress' => $dataIngress,
            ];
            return response()->json($response, 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Data invalid',
                'errors'  => ['general' => [$ex->getMessage()]],
            ], Response::HTTP_BAD_REQUEST));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['title']    = 'transactions';
        $data['subtitle'] = 'Info transaction';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/tools.js',
            'assets/app/showErrorsForm.js',
            'assets/app/services.js',
            'assets/app/transaction/info.js',
        ];
        return view('app.transactions.info', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title']    = 'transactions';
        $data['subtitle'] = 'Edit transaction';
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/tools.js',
            'assets/app/showErrorsForm.js',
            'assets/app/services.js',
            'assets/app/transaction/edit.js',
        ];
        return view('app.transactions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionFormRequest $req, string $id)
    {
        $payload = $req->validated();
        try {
            DB::beginTransaction();
            $transaction = $this->service->info($id);
            $ingressId   = $transaction->ing_id;
            $egressId    = $transaction->egr_id;
            $ingress     = $this->serviceIngress->info($ingressId);
            $egress      = $this->serviceEgress->info($egressId);
            // ================================================================ //
            // Egresses                                                         //
            // ================================================================ //
            $payloadEgress = [];
            $payloadEgress['cat_id']      = $payload['category'] ?? $egress->cat_id;
            $payloadEgress['sav_id']      = $payload['saving'] ?? $egress->sav_id;
            $payloadEgress['deb_id']      = $payload['debt'] ?? $egress->deb_id;
            $payloadEgress['acc_id']      = $payload['account_from'] ?? $egress->acc_id;
            $payloadEgress['concept']     = $payload['concept'] ?? $egress->concept;
            $payloadEgress['description'] = $payload['description'] ?? $egress->description;
            $payloadEgress['reference']   = $payload['reference'] ?? $egress->reference;
            $payloadEgress['amount']      = $payload['amount'] ?? $egress->amount;
            $payloadEgress['observation'] = $payload['observation'] ?? $egress->observation;
            $dataEgress   = $this->serviceEgress->update($egressId, $payloadEgress);
            // ================================================================ //
            // Ingresses                                                        //
            // ================================================================ //
            $payloadIngress = [];
            $payloadIngress['cls_id']      = $payload['classification'] ?? $ingress->cls_id;
            $payloadIngress['sav_id']      = $payload['saving'] ?? $ingress->sav_id;
            $payloadIngress['deb_id']      = $payload['debt'] ?? $ingress->deb_id;
            $payloadIngress['acc_id']      = $payload['account_to'] ?? $ingress->acc_id;
            $payloadIngress['concept']     = $payload['concept'] ?? $ingress->concept;
            $payloadIngress['description'] = $payload['description'] ?? $ingress->description;
            $payloadIngress['reference']   = $payload['reference'] ?? $ingress->reference;
            $payloadIngress['amount']      = $payload['amount'] ?? $ingress->amount;
            $payloadIngress['observation'] = $payload['observation'] ?? $ingress->observation;
            $dataIngress   = $this->serviceIngress->update($ingressId, $payloadIngress);
            // ================================================================ //
            // Transactions                                                     //
            // ================================================================ //
            $payloadTransaction = [];
            $payloadTransaction['acc_egr_id']   = $payload['account_from'] ?? $transaction->acc_egr_id;
            $payloadTransaction['acc_ing_id']   = $payload['account_to'] ?? $transaction->acc_ing_id;
            $payloadTransaction['cls_id']       = $payload['classification'] ?? $transaction->cls_id;
            $payloadTransaction['cat_id']       = $payload['category'] ?? $transaction->cat_id;
            $payloadTransaction['sav_id']       = $payload['saving'] ?? $transaction->sav_id;
            $payloadTransaction['deb_id']       = $payload['debt'] ?? $transaction->deb_id;
            $payloadTransaction['concept']      = $payload['concept'] ?? $transaction->concept;
            $payloadTransaction['description']  = $payload['description'] ?? $transaction->description;
            $payloadTransaction['reference']    = $payload['reference'] ?? $transaction->reference;
            $payloadTransaction['amount']       = $payload['amount'] ?? $transaction->amount;
            $payloadTransaction['observation']  = $payload['observation'] ?? $transaction->observation;
            $dataTransaction   = $this->service->update($id, $payloadTransaction);
            // ================================================================ //
            // Create                                                           //
            // ================================================================ //
            DB::commit();
            $response = [
                'transaction' => $dataTransaction,
                'egress' => $dataEgress,
                'ingress' => $dataIngress,
            ];
            return response()->json($response, 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Data invalid',
                'errors'  => ['general' => [$ex->getMessage()]],
            ], Response::HTTP_BAD_REQUEST));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $transaction = $this->service->info($id);
            $ingressId = $transaction->ing_id;
            $egressId = $transaction->egr_id;
            if (
                $this->serviceIngress->destroy($ingressId) &&
                $this->serviceEgress->destroy($egressId) &&
                $this->service->destroy($id)
            ) {
                DB::commit();
                $response['success'] = true;
                $response['data'] = ['general' => ['Transaction deleted.']];
                return response()->json(
                    $response,
                    Response::HTTP_OK
                );
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Data invalid',
                'errors'  => ['general' => [$ex->getMessage()]],
            ], Response::HTTP_BAD_REQUEST));
        }
    }

    public function restore(string $id)
    {
        try {
            DB::beginTransaction();
            $transaction = $this->service->info($id);
            $ingressId = $transaction->ing_id;
            $egressId = $transaction->egr_id;
            if (
                $this->serviceIngress->restore($ingressId) &&
                $this->serviceEgress->restore($egressId) &&
                $this->service->restore($id)
            ) {
                DB::commit();
                $response['success'] = true;
                $response['data'] = ['general' => ['Transaction restored.']];
                return response()->json(
                    $response,
                    Response::HTTP_OK
                );
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Data invalid',
                'errors'  => ['general' => [$ex->getMessage()]],
            ], Response::HTTP_BAD_REQUEST));
        }
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
