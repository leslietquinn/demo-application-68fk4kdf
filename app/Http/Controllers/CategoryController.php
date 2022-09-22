<?php

namespace App\Http\Controllers;

use App\Exceptions\ServiceFaultException;
use App\Services\CategoryService;

use Log;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service=$service;
    }
    
    public function index() : View
    {
        return view('categories.index')
            ->with('categories', $this->service->paginate()
            );
    }

    public function create() : View
    {
        return view('categories.create.index');
    }

    public function store(Request $request) : JsonResponse
    {
        $request->merge([
            'slug'=>Str::slug($request->name)
          , 'name'=>Str::title($request->name)
        ]);

        try
        {
            $res=$this->service->create(
                $request->only([
                    'name'
                  , 'slug'
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
            'message'=>'Great! A new category has been created'
        ], 201)
        ->withHeaders(['Content-Type'=>'application/json; charset=utf-8']);
    }


    public function show(string $id) : View
    {
        return view('categories.show.index')->with(
            'categories', $this->service->getRepository()->findOne($id)
        );
    }

    public function edit(string $id) : View
    {
        return view('categories.edit.index')->with(
            'category', $this->service->getRepository()->findOne($id)
        );
    }

    public function update(Request $request, string $id) : JsonResponse
    {
        /**
         * @note    mutators don't work on an update, using the Query Builder, so resort 
         *          to this for solution
         * 
         * @todo    refactor to place this in the Service layer
         */

        $request->merge([
            'slug'=>Str::slug($request->name)
          , 'name'=>Str::title($request->name)
        ]);
        
        try
        {
            $res=$this->service->update(
                $id
              , $request->only([
                    'id'
                  , 'name'
                  , 'slug'
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
            'message'=>'Great! Category details have been updated'
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
            'message'=>'Great! You have deleted a category'
        ], 201)->withHeaders(['Content-Type'=>'application/json; charset=utf-8']);
    }
}
