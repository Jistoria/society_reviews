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

    public function index($search = null)
    {
        return response()->json(['success'=>true,'paginate'=>$this->paginateService->paginate($search)]);
    }
}
