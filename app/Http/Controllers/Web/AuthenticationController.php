<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\AuthenticationFormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        $data['cssFILES'] = [];
        $data['jsFILES']  = [
            'assets/app/showErrorsForm.js',
            'assets/app/authentication/authorization.js',
        ];
        return View('authorization', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthenticationFormRequest $req)
    {
        $credentials = $req->validated();
        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();
            return response()->json(
                ['success' => true],
                Response::HTTP_OK
            );
        }
        return response()->json(
            ['email' => 'The provided credentials do not match our records.'],
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req)
    {
        $req->user()->tokens()->delete();
        return response()->json(
            ['success' => true],
            Response::HTTP_OK
        );
    }
}
