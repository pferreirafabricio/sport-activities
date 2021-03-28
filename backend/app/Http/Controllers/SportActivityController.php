<?php

namespace App\Http\Controllers;

use App\Http\Resources\SportActivities\CalendarResources;
use App\Models\SportActivity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $activities = SportActivity::select('name', 'description', 'date', 'start_hour', 'end_hour')
                ->get();

            return response()->json([
                'data' => CalendarResources::collection($activities),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'Something was wrong getting the sports activies',
            ], 500);
        }
    }

    /**
     * Create a new sport acitivty
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|min:1|max:60',
                'description' => 'nullable|string|max:255',
                'date' => 'required|date_format:d/m/Y',
                'startHour' => 'required|date_format:H:i',
                'endHour' => 'required|date_format:H:i',
                'recurrence' => 'nullable|integer',
            ]);

            $sportActivityData = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'date' => \DateTime::createFromFormat('d/m/Y', $request->input('date'))->format('Y-m-d'),
                'start_hour' => $request->input('startHour'),
                'end_hour' => $request->input('endHour'),
                'recurrence' => (int) $request->input('recurrence') ?? null,
            ];

            $recurrenceQuantity = $sportActivityData['recurrence'];

            if ($recurrenceQuantity && $recurrenceQuantity > 1) {
                DB::beginTransaction();

                for ($count = 0; $count < $recurrenceQuantity; $count++) {
                    SportActivity::create($sportActivityData);
                    $sportActivityData['date'] = date('Y-m-d', strtotime($sportActivityData['date'] . '+7days'));

                    /**
                     * @note Set the 'children' recurrence as NULL, only the 'father' will
                     * hold the information of how many recurrences this activity has
                     */
                    $sportActivityData['recurrence'] = null;
                }

                DB::commit();
            } else {
                SportActivity::create($sportActivityData);
            }

            return response()->json([
                'message' => 'Sport activity created successfully',
            ], 201);
        } catch (ValidationException $validationException) {
            return response()->json([
                'error' => $validationException->errors()
            ], 400);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'error' => 'Something was wrong creating the sports acitivity',
                'errorMessage' => $exception->getMessage()
            ], 500);
        }
    }
}
