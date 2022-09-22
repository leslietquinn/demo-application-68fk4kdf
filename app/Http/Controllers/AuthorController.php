<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Exceptions\ServiceFaultException;

use Log;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    protected $service;

    public function __construct(AuthorService $service)
    {
        $this->middleware('guest');
        $this->service=$service;
    }
    
    public function index() : View
    {
        return view('authors.index')
            ->with('authors', $this->service->paginate()
            );
    }

    public function create() : View
    {
        return view('authors.create.index');
    }

    public function store(Request $request) : JsonResponse
    {
        try
        {
            $res=$this->service->create($request->only(['name']));
        }
        catch(ServiceFaultException $e)
        {
            return response()->json([
                'message'=>'Oops! There was a technical fault, please try again'
              , 'errors'=>[]
            ], 409)
            ->withHeaders(['Content-Type'=>'application/json; charset=utf-8']);
        }
        
        if(is_array($res))
        {
            return response()->json([
                'message'=>'Oops! Please correct form validation errors'
              , 'errors'=>$res
            ], 409)
            ->withHeaders(['Content-Type'=>'application/json; charset=utf-8']);
        }

        return response()->json([
            'message'=>'Great! A new author has been created'
        ], 201)
        ->withHeaders(['Content-Type'=>'application/json; charset=utf-8']);
    }

    public function show(string $id) : View
    {
        return view('authors.show.index')->with(
            'author', $this->service->getRepository()->findOne($id)
        );
    }

    public function edit(string $id) : View
    {
        return view('authors.edit.index')->with(
            'author', $this->service->getRepository()->findOne($id)
        );
    }

    public function update(Request $request, string $id) : JsonResponse
    {
        try
        {
            $res=$this->service->update(
                $id
              , $request->only([
                    'id'
                  , 'name'
                ])
            );
        }
        catch(ServiceFaultException $e)
        {
            return response()->json([
                'message'=>'Oops! There was a technical fault, please try again'
              , 'errors'=>[]
            ], 409)
            ->withHeaders(['Content-Type'=>'application/json; charset=utf-8']);
        }
        
        if(is_array($res))
        {
            return response()->json([
                'message'=>'Oops! Please correct form validation errors'
              , 'errors'=>$res
            ], 409)
            ->withHeaders(['Content-Type'=>'application/json; charset=utf-8']);
        }

        return response()->json([
            'message'=>'Great! Author details have been updated'
        ], 201)
        ->withHeaders(['Content-Type'=>'application/json; charset=utf-8']);
    }

    public function destroy(string $id) : JsonResponse
    {
        try
        {
            $this->service->delete($id);
        }
        catch(ServiceFaultException $e)
        {
            return response()->json([
                'message'=>'Oops! There was a technical fault, please try again'
              , 'errors'=>[]
            ], 409)
            ->withHeaders(['Content-Type'=>'application/json; charset=utf-8']);
        }

        return response()->json([
            'message'=>'Great! You have deleted an author'
        ], 201)->withHeaders(['Content-Type'=>'application/json; charset=utf-8']);
    }
}
