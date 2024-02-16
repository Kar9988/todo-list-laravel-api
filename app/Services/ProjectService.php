<?php

namespace App\Services;

use App\Http\Resources\ProjectsResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectService
{

    /**
     * @param int $userId
     * @return AnonymousResourceCollection
     */
    public function getUserProjects(int $userId): AnonymousResourceCollection
    {
        $projects = Project::where('user_id', $userId)
            ->withSum('listCards', 'tracker')->get();

        return ProjectsResource::collection($projects);
    }

    /**
     * @param array $data
     * @return ProjectsResource
     */
    public function createProject(array $data): ProjectsResource
    {
        $project = Project::create($data);

        return new ProjectsResource($project);
    }

    public function updateProject(int $projectId, array $data)
    {
        return Project::where('id', $projectId)
            ->update($data);
    }
}
