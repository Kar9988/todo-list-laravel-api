<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ListService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListController extends Controller
{

    private ListService $listService;

    public function __construct(ListService $listService)
    {

        $this->listService = $listService;
    }

    public function index(int $projectId): JsonResponse
    {
        $lists = $this->listService->getProjectLists($projectId);

        return response()->json([
            'success' => 1,
            'type'    => 'success',
            'data'    => $lists
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $list = $this->listService->createList($request->all());

        return response()->json([
            'success' => 1,
            'type'    => 'success',
            'list'    => $list
        ]);
    }
}
