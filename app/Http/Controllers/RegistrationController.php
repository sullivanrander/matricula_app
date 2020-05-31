<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistration;
use App\Http\Requests\UpdateRegistration;
use App\Http\Resources\RegistrationResource;
use App\Registration;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
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
            $query = Registration::query();

            if ($request->input('name')) {
                $query->join('students', 'registrations.student_id', '=', 'students.id')
                    ->where('students.name', 'LIKE', "%{$request->input('name')}%");
            }

            return RegistrationResource::collection($query->paginate());
        } catch (\Exception $e) {
            abort(500, 'O servidor não conseguiu processar sua requisição no momento, tente novamente mais tarde.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRegistration $request
     * @return RegistrationResource
     */
    public function store(StoreRegistration $request)
    {
        try {
            DB::beginTransaction();

            $student = Student::create([
                'name' => $request->input('student.name'),
                'cpf' => $request->input('student.cpf'),
                'born_date' => $request->input('student.born_date'),
                'email' => $request->input('student.email'),
                'telephone' => $request->input('student.telephone'),
            ]);

            $registration = Registration::create([
                'registration_date' => now(),
                'status' => $request->input('status'),
                'course_id' => $request->input('course'),
                'student_id' => $student->id,
            ]);

            DB::commit();

            return new RegistrationResource($registration);
        } catch (\Exception $e) {
            DB::rollback();
            abort(500, 'O servidor não conseguiu processar sua requisição no momento, tente novamente mais tarde.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Registration  $registration
     * @return RegistrationResource
     */
    public function show(Registration $registration)
    {
        return new RegistrationResource($registration);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRegistration $request
     * @param \App\Registration $registration
     * @return RegistrationResource
     */
    public function update(UpdateRegistration $request, Registration $registration)
    {
        if($registration->status === 'SUSPENDED' && in_array($request->input('status'), ['COMPLETED', 'PAUSED'])) {
            abort(400, 'Alteração de status inválido.');
        }

        if($registration->status === 'TERMINATED' && in_array($request->input('status'), ['ACTIVE', 'SUSPENDED', 'DROPOUT', 'COMPLETED', 'PAUSED'])) {
            abort(400, 'Alteração de status inválido.');
        }

        if($registration->status === 'DROPOUT' && in_array($request->input('status'), ['ACTIVE', 'SUSPENDED', 'TERMINATED', 'COMPLETED', 'PAUSED'])) {
            abort(400, 'Alteração de status inválido.');
        }

        if($registration->status === 'COMPLETED' && in_array($request->input('status'), ['ACTIVE', 'SUSPENDED', 'TERMINATED', 'DROPOUT', 'PAUSED'])) {
            abort(400, 'Alteração de status inválido.');
        }

        if($registration->status === 'PAUSED' && in_array($request->input('status'), ['TERMINATED', 'DROPOUT', 'COMPLETED'])) {
            abort(400, 'Alteração de status inválido.');
        }

        try {
            DB::beginTransaction();

            $registration->student()->update([
                'name' => $request->input('student.name'),
                'cpf' => $request->input('student.cpf'),
                'born_date' => $request->input('student.born_date'),
                'email' => $request->input('student.email'),
                'telephone' => $request->input('student.telephone'),
            ]);

            $registration->update([
                'registration_date' => $request->input('registration_date'),
                'status' => $request->input('status'),
                'course_id' => $request->input('course'),
            ]);

            DB::commit();

            return new RegistrationResource($registration);
        } catch (\Exception $e) {
            DB::rollback();
            abort(500, 'O servidor não conseguiu processar sua requisição no momento, tente novamente mais tarde.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Registration $registration)
    {
        try {
            DB::beginTransaction();

            $registration->delete();

            DB::commit();

            return response()->json(['message' => 'Excluido com sucesso.'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            abort(500, 'O servidor não conseguiu processar sua requisição no momento, tente novamente mais tarde.');
        }
    }
}
