<?php

namespace App\Http\Controllers;

use App\Services\PaginateService;
use Illuminate\Http\Request;

class PaginateController extends Controller
{
    private $paginateService;
    public function __construct(PaginateService $paginateService)
    {
        $this->paginateService = $paginateService;
    }

    public function index(Request $request, $search = null)
    {
        if($request)
        {
            return $request->collect('tags');
        }
        return response()->json(['success'=>true,'paginate'=>$this->paginateService->paginate($search, $request)]);
    }
}
