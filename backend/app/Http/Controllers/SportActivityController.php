<?php

namespace App\Http\Controllers;

use App\Models\SportActivity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SportActivityController extends Controller
{
    /**
     * Return all sport activities
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json([
                'data' => SportActivity::all(),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'Something was wrong getting the sports activies'
            ], 500);
        }
    }

    /**
     * Create a new sport acitivty
     *
     * @return void
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|min:1|max:60',
                'description' => 'nullable|string|max:255',
                'date' => 'required|date',
                'start_hour' => 'required|time',
                'end_hour' => 'required|time',
                'recurrence' => 'nullable|integer',
            ]);

            $sportActivityData = [
                'name' => $request->only('name'),
                'description' => $request->only('description'),
                'date' => $request->only('date'),
                'start_hour' => $request->only('start_hour'),
                'end_hour' => $request->only('end_hour'),
                'recurrence' => $request->only('recurrence'),
            ];

            SportActivity::create($sportActivityData);

            return response()->json([
                'message' => 'Sport activity created successfully',
            ], 201);
        } catch (ValidationException $validationException) {
            return response()->json([
                'error' => $validationException->errors()
            ], 400);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'Something was wrong creating the sports acitivity'
            ], 500);
        }
    }
}
