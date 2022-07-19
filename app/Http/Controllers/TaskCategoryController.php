<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\TaskCategory;
use App\Http\Requests\StoreTaskCategoryRequest;
use App\Http\Requests\UpdateTaskCategoryRequest;

class TaskCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = TaskCategory::paginate(16);

        return view('tasks_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TaskCategory $taskCategory)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function showBySlug(string $slug)
    {
        $categories = TaskCategory::paginate(16);

        try {
            $activeCategory = TaskCategory::where('slug', $slug)->with([
                'tasks' => fn ($q) => $q->where('user_id', auth()->id())
            ])->firstOrFail();
        } catch (Exception $ex) {
            $activeCategory = null;
        }

        return view('tasks_categories.show-by-slug', compact('categories', 'activeCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskCategory  $taskCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskCategory $taskCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskCategoryRequest  $request
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskCategoryRequest $request, TaskCategory $taskCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskCategory $taskCategory)
    {
        //
    }
}
