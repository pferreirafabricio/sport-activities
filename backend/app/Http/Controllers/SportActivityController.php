<?php

namespace App\Http\Controllers;

use App\Http\Resources\SportActivities\CalendarResources;
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
                'data' => CalendarResources::collection(SportActivity::all()),
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
                'startHour' => 'required|date_format:H:i',
                'endHour' => 'required|date_format:H:i',
                'recurrence' => 'nullable|integer',
            ]);

            $sportActivityData = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'date' => date('Y-m-d', strtotime($request->input('date'))) ,
                'start_hour' => $request->input('startHour'),
                'end_hour' => $request->input('endHour'),
                'recurrence' => (int) $request->input('recurrence') ?? null,
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
                'error' => 'Something was wrong creating the sports acitivity',
                'errorMessage' => $exception->getMessage()
            ], 500);
        }
    }
}
