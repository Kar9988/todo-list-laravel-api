<?php

namespace App\Services;

use App\Http\Resources\ListsResource;
use App\Models\ProjectList;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListService
{

    /**
     * @param int $projectId
     * @return AnonymousResourceCollection
     */
    public function getProjectLists(int $projectId): AnonymousResourceCollection
    {
        $projects = ProjectList::where('project_id', $projectId)
            ->with('cards')
            ->get();

        return ListsResource::collection($projects);
    }

    /**
     * @param array $data
     * @return ListsResource
     */
    public function createList(array $data): ListsResource
    {
        $list = ProjectList::create($data);

        return new ListsResource($list);
    }
}
