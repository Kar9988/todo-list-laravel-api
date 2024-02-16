<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{

    private ProjectService $projectService;

    /**
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $projects = $this->projectService->getUserProjects(auth()->id());

        return response()->json([
            'success' => 1,
            'type'    => 'success',
            'data'    => $projects
        ]);
    }

    /**
     * @param ProjectStoreRequest $request
     * @return JsonResponse
     */
    public function store(ProjectStoreRequest $request): JsonResponse
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        $project = $this->projectService->createProject($data);

        return response()->json([
            'success' => 1,
            'type'    => 'success',
            'project' => $project
        ]);
    }

    public function show()
    {

    }

    public function update()
    {

    }
}
