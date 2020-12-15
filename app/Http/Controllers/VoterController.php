<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {

    }

    public function welcome(Request $request)
    {
        $voter = $request->session()->get('token');
        if ($voter) {
            return \redirect('/vote');
        } else {
            return \redirect('/login');
        }
    }

    /**
     * Show the form for creating a login.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function login(Request $request)
    {
        switch ($request->method()) {
            case 'GET':
                $voter = $request->session()->get('token');
                if ($voter) {
                    return \redirect('/vote');
                }
                return Inertia::render('Login');
                break;

            case 'POST':
                $validator = Validator::make($request->all(),
                    ['token' => 'required|min:6|max:6'],
                    [
                        'required' => 'Tokennya diisi dulu',
                        'min' => 'Token seharusnya berisi 6 huruf',
                        'max' => 'Token seharusnya berisi 6 huruf'
                    ]
                );


                DB::enableQueryLog();
                if (!$validator->fails()) {
                    $validator->after(function ($validator) {
                        $voter = Token::where('token', $validator->valid('token'))->first();
                        if (!$voter) {
                            $validator->errors()->add('token', 'Token tidak cocok');
                        }
//
//                        $voter = Token::where('token', $validator->valid('token'))
//                            ->where('voted', 0)
//                            ->firstOrFail();
//
//                        if ($voter->login) {
//                            $validator->errors()->add('token', 'Token sedang digunakan');
//                        }
                    });
                }

                if ($validator->fails()) {
                    return back()
                        ->withErrors($validator)
                        ->withInput();
                }

                $request->session()->put('token', $request->token);

                return \redirect('/vote');
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function vote(Request $request)
    {
        $voter = $request->session()->get('token');
        if (!$voter) {
            return \redirect('/login');
        }
        switch ($request->method()) {
            case 'GET':

                $candidates = Candidate::where('year', 2020)->orderBy('number')->select('id', 'number', 'name', 'vision', 'mission')->get();
                return Inertia::render('Vote', compact('candidates', 'voter'));
                break;
            case 'POST':
                $candidate = DB::table('candidates')->where('id', $request['candidate_id'])->increment('votes');
                $token = Token::where('token', $voter)->update(['voted' => 1]);

                $request->session()->forget('token');
                return back();
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function liveCount(Request $request)
    {
        $candidates = Candidate::where('year', 2020)->orderBy('number')->select('number', 'name', 'votes')->get();
        return Inertia::render('LiveCount', [
            'votes' => $candidates->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Token $token
     * @return \Illuminate\Http\Response
     */
    public function edit(Token $token)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Token $token
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Token $token)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Token $token
     * @return \Illuminate\Http\Response
     */
    public function destroy(Token $token)
    {
        //
    }
}
