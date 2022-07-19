<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Models\TaskCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskCategoryRequest;
use App\Http\Requests\UpdateTaskCategoryRequest;
use App\Http\Resources\TaskCategoryResource;

class TaskCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = TaskCategory::withCount(['tasks'])->get();

        return TaskCategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskCategoryRequest $request)
    {

        $taskCategory = TaskCategory::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'))
        ]);

        return new TaskCategoryResource($taskCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function showBySlug(string $slug, int $user_id)
    {
        $taskCategory = TaskCategory::with([
            'tasks' => fn ($q) => $q->where('user_id', $user_id)
        ])->where('slug', $slug)->get()->first();

        return new TaskCategoryResource($taskCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskCategoryRequest $request
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskCategoryRequest $request, TaskCategory $taskCategory)
    {
        $taskCategory->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'))
        ]);

        return new TaskCategoryResource($taskCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskCategory $taskCategory)
    {
        $taskCategory->delete();

        return response()->noContent();
    }
}
