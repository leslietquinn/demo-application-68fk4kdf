<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use App\Exceptions\ServiceFaultException;

use Log;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    protected $service;

    public function __construct(BookService $service)
    {
        $this->middleware('guest');
        $this->service=$service;
    }
    
    public function index() : View
    {
        return view('books.index')
            ->with('books', 
                $this->service->paginate()
            )
            ->with('authors',
                $this->service->getAuthors()
            )
            ->with('categories',
                $this->service->getCategories()
            );
    }

    public function create() : View
    {
        return view('books.create.index');
    }

    public function store(Request $request) : JsonResponse
    {
        $request->merge([
            'name'=>Str::title($request->name)
        ]);

        try
        {
            $res=$this->service->create(
                $request->only([
                    'name'
                  , 'author_id'
                  , 'category_id'
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
            'message'=>'Great! A new book has been created'
        ], 201)
        ->withHeaders(['Content-Type'=>'application/json; charset=utf-8']);
    }

    public function show(string $id) : View
    {
        return view('books.show.index')->with(
            'book', $this->service->getRepository()->findOne($id)
        );
    }

    public function edit(string $id) : View
    {
        return view('books.edit.index')->with(
            'book', $this->service->getRepository()->findOne($id)
            )
            ->with('authors',
                $this->service->getAuthors()
            )
            ->with('categories',
                $this->service->getCategories()
            );
    }

    public function update(Request $request, string $id) : JsonResponse
    {
        $request->merge([
            'name'=>Str::title($request->name)
        ]);

        try
        {
            $res=$this->service->update(
                $id
              , $request->only([
                    'id'
                  , 'name'
                  , 'author_id'
                  , 'category_id'
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
            'message'=>'Great! Book details have been updated'
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
            'message'=>'Great! You have deleted a book'
        ], 201)->withHeaders(['Content-Type'=>'application/json; charset=utf-8']);
    }
}
