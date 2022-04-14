<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Repository\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;

class BlogController extends Controller
{
    protected $articleRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index(Request $request)
    {
        try{
            return BlogResource::collection($this->blogRepository->getAll($request));
        }catch(\Exception $errors){
            Log::error("Error *index BlogController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function show($id, Request $request)
    {
        try{
            return new BlogResource($this->blogRepository->getById($id));
        }catch(\Exception $errors){
            Log::error("Error *show BlogController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try{
            return new BlogResource($this->blogRepository->create($request));
        }catch(\Exception $errors){
            Log::error("Error *store BlogController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function update($id, Request $request)
    {
        try{
            return new BlogResource($this->blogRepository->update($id, $request));
        }catch(\Exception $errors){
            Log::error("Error *update BlogController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function delete($id, Request $request)
    {
        try{
            return new BlogResource($this->blogRepository->delete($id));
        }catch(\Exception $errors){
            Log::error("Error *delete BlogController*, IP: " . FacadesRequest::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

}
