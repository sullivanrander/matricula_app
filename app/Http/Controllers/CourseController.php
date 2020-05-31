<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\StoreCourse;
use App\Http\Requests\UpdateCourse;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        try {
            $query = Course::query();

            if ($request->input('name')) {
                $query->where('name', 'LIKE', "%{$request->input('name')}%");
            }

            return CourseResource::collection($query->paginate());
        } catch (\Exception $e) {
            abort(500, 'O servidor não conseguiu processar sua requisição no momento, tente novamente mais tarde.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCourse $request
     * @return CourseResource
     */
    public function store(StoreCourse $request)
    {
        try {
            DB::beginTransaction();

            $course = Course::create([
                'name' => $request->input('name')
            ]);

            DB::commit();

            return new CourseResource($course);
        } catch (\Exception $e) {
            DB::rollback();
            abort(500, 'O servidor não conseguiu processar sua requisição no momento, tente novamente mais tarde.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Course $course
     * @return CourseResource
     */
    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course $course
     * @return CourseResource
     */
    public function update(UpdateCourse $request, Course $course)
    {
        try {
            DB::beginTransaction();

            $course->update([
                'name' => $request->input('name')
            ]);

            DB::commit();

            return new CourseResource($course);
        } catch (\Exception $e) {
            DB::rollback();
            abort(500, 'O servidor não conseguiu processar sua requisição no momento, tente novamente mais tarde.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Course $course)
    {
        if($course->usersRegistered() > 0) {
            abort(400, 'Não é possível excluir um curso com matrículas existentes.');
        }

        try {
            DB::beginTransaction();

            $course->delete();

            DB::commit();

            return response()->json(['message' => 'Excluido com sucesso.'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            abort(500, 'O servidor não conseguiu processar sua requisição no momento, tente novamente mais tarde.');
        }
    }
}
