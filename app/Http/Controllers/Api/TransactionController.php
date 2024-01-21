<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\TransactionFormRequest;
use App\Services\EgressService;
use App\Services\IngressService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\DB;
use stdClass;

class TransactionController extends ApiController
{
    protected $service;
    protected $serviceEgress;
    protected $serviceIngress;
    public function __construct(TransactionService $service, EgressService $serviceEgress, IngressService $serviceIngress)
    {
        $this->service = $service;
        $this->serviceEgress = $serviceEgress;
        $this->serviceIngress = $serviceIngress;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function store(TransactionFormRequest $req)
    {
        try {
            DB::beginTransaction();
            $payload = $req->validated();
            // ================================================================ //
            // Egresses                                                         //
            // ================================================================ //
            $payloadEgress = [];
            $payloadEgress['usr_id']      = 1;
            $payloadEgress['cat_id']      = $payload['category'] ?? null;
            $payloadEgress['sav_id']      = $payload['saving'] ?? null;
            $payloadEgress['deb_id']      = $payload['debt'] ?? null;
            $payloadEgress['acc_id']      = $payload['account_from'] ?? null;
            $payloadEgress['concept']     = $payload['concept'] ?? null;
            $payloadEgress['description'] = $payload['description'] ?? null;
            $payloadEgress['reference']   = $payload['reference'] ?? null;
            $payloadEgress['amount']      = $payload['amount'] ?? null;
            $payloadEgress['observation'] = $payload['observation'] ?? null;
            $payloadEgress['status']      = 'Active';
            $dataEgress   = $this->serviceEgress->store($payloadEgress);
            // ================================================================ //
            // Ingresses                                                        //
            // ================================================================ //
            $payloadIngress = [];
            $payloadIngress['usr_id']      = 1;
            $payloadIngress['cls_id']      = $payload['classification'] ?? null;
            $payloadIngress['sav_id']      = $payload['saving'] ?? null;
            $payloadIngress['deb_id']      = $payload['debt'] ?? null;
            $payloadIngress['acc_id']      = $payload['account_to'] ?? null;
            $payloadIngress['concept']     = $payload['concept'] ?? null;
            $payloadIngress['description'] = $payload['description'] ?? null;
            $payloadIngress['reference']   = $payload['reference'] ?? null;
            $payloadIngress['amount']      = $payload['amount'] ?? null;
            $payloadIngress['observation'] = $payload['observation'] ?? null;
            $payloadIngress['status']      = 'Active';
            $dataIngress   = $this->serviceIngress->store($payloadIngress);
            // ================================================================ //
            // Transactions                                                     //
            // ================================================================ //
            $payloadTransaction = [];
            $payloadTransaction['usr_id']       = 1;
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
            return $this->responseCreated($response);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->responseException($ex->getMessage());
        }
    }

    public function show(string $id)
    {
        return $this->service->show($id) ?? new stdClass();
    }

    public function update(TransactionFormRequest $req, string $id)
    {
        $this->isEmpty($req->validated());
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
            if ($req->has('category'))
                $payloadEgress['cat_id'] = $payload['category'];
            if ($req->has('saving'))
                $payloadEgress['sav_id'] = $payload['saving'];
            if ($req->has('debt'))
                $payloadEgress['deb_id'] = $payload['debt'];
            if ($req->has('account_from'))
                $payloadEgress['acc_id'] = $payload['account_from'];
            if ($req->has('concept'))
                $payloadEgress['concept'] = $payload['concept'];
            if ($req->has('description'))
                $payloadEgress['description'] = $payload['description'];
            if ($req->has('reference'))
                $payloadEgress['reference'] = $payload['reference'];
            if ($req->has('amount'))
                $payloadEgress['amount'] = $payload['amount'];
            if ($req->has('observation'))
                $payloadEgress['observation'] = $payload['observation'];
            if (!empty($payloadEgress))
                $dataEgress   = $this->serviceEgress->update($egressId, $payloadEgress);
            // ================================================================ //
            // Ingresses                                                        //
            // ================================================================ //
            $payloadIngress = [];
            if ($req->has('classification'))
                $payloadIngress['cls_id'] = $payload['classification'];
            if ($req->has('saving'))
                $payloadIngress['sav_id'] = $payload['saving'];
            if ($req->has('debt'))
                $payloadIngress['deb_id'] = $payload['debt'];
            if ($req->has('account_to'))
                $payloadIngress['acc_id'] = $payload['account_to'];
            if ($req->has('concept'))
                $payloadIngress['concept'] = $payload['concept'];
            if ($req->has('description'))
                $payloadIngress['description'] = $payload['description'];
            if ($req->has('reference'))
                $payloadIngress['reference'] = $payload['reference'];
            if ($req->has('amount'))
                $payloadIngress['amount'] = $payload['amount'];
            if ($req->has('observation'))
                $payloadIngress['observation'] = $payload['observation'];
            if (!empty($payloadIngress))
                $dataIngress   = $this->serviceIngress->update($ingressId, $payloadIngress);
            // ================================================================ //
            // Transactions                                                     //
            // ================================================================ //
            $payloadTransaction = [];
            if ($req->has('account_from'))
                $payloadTransaction['acc_egr_id']   = $payload['account_from'];
            if ($req->has('account_to'))
                $payloadTransaction['acc_ing_id']   = $payload['account_to'];
            if ($req->has('classification'))
                $payloadTransaction['cls_id']       = $payload['classification'];
            if ($req->has('category'))
                $payloadTransaction['cat_id']       = $payload['category'];
            if ($req->has('saving'))
                $payloadTransaction['sav_id']       = $payload['saving'];
            if ($req->has('debt'))
                $payloadTransaction['deb_id']       = $payload['debt'];
            if ($req->has('concept'))
                $payloadTransaction['concept']      = $payload['concept'];
            if ($req->has('description'))
                $payloadTransaction['description']  = $payload['description'];
            if ($req->has('reference'))
                $payloadTransaction['reference']    = $payload['reference'];
            if ($req->has('amount'))
                $payloadTransaction['amount']       = $payload['amount'];
            if ($req->has('observation'))
                $payloadTransaction['observation']  = $payload['observation'];
            if (!empty($payloadTransaction))
                $dataTransaction   = $this->service->update($id, $payloadTransaction);
            // ================================================================ //
            // Create                                                           //
            // ================================================================ //
            $transaction = $this->service->info($id);
            $egress      = $this->serviceEgress->info($egressId);
            $ingress     = $this->serviceIngress->info($ingressId);
            DB::commit();
            $response = [
                'transaction' => $transaction,
                'egress'      => $egress,
                'ingress'     => $ingress,
            ];
            return $this->responseSuccess($response);
        } catch (\Exception $ex) {
            return $this->responseException($ex->getMessage());
        }
    }

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
                return $this->responseDeleted();
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->responseException($ex->getMessage());
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
                return $this->responseRestored();
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->responseException($ex->getMessage());
        }
    }
}
