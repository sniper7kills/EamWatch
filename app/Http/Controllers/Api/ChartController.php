<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function characterCount(Request $request): JsonResponse
    {
        // Initialize the letter count array
        $letterCounts = array_fill_keys(array_merge(range(0, 9), range('a', 'z')), 0);

        // Build the query to count the occurrences of each letter
        $query = DB::table((new Message())->getTable())
            ->where('type', 'ALLSTATIONS');

        foreach ($letterCounts as $letter => $count) {
            $query->selectRaw("SUM(CHAR_LENGTH(message) - CHAR_LENGTH(REPLACE(LOWER(message), ?, ''))) as {$letter}_letter", [$letter]);
        }


        // Execute the query and fetch the result
        $result = $query->first();

        // Convert the result object to an associative array
        $letterCounts = collect($result)->toArray();

        return new JsonResponse($letterCounts);
    }

    public function codewordCount()
    {
        // Build the query to select code words from messages of type "SKYKING"
        $codeWords = DB::table((new Message)->getTable())
            ->where('type', 'SKYKING')
            ->selectRaw("TRIM(SUBSTRING_INDEX(message, 'TIME', 1)) AS code_word")
            ->get();

        // Initialize the code word count array
        $codeWordCounts = [];

        // Loop through each code word and count the occurrences
        foreach ($codeWords as $codeWord) {
            if (array_key_exists($codeWord->code_word, $codeWordCounts)) {
                $codeWordCounts[$codeWord->code_word]++;
            } else {
                $codeWordCounts[$codeWord->code_word] = 1;
            }
        }

        return new JsonResponse($codeWordCounts);
    }

    public function dailyCount()
    {
        // Assuming you have a 'created_at' timestamp column in your table
        $dailyMessageCounts = DB::table((new Message)->getTable())
            ->selectRaw("DATE(broadcast_ts) AS date, type, COUNT(*) AS count")
            ->whereIn('type', ['BACKEND', 'SKYKING', 'ALLSTATIONS', 'RADIOCHECK', 'SKYMASTER', 'SKYBIRD', 'DISREGARDED', 'OTHER'])
            ->groupBy(DB::raw("DATE(broadcast_ts)"), 'type')
            ->orderBy('date', 'asc')
            ->get();

        // Initialize an array of message types
        $messageTypes = ['BACKEND', 'SKYKING', 'ALLSTATIONS', 'RADIOCHECK', 'SKYMASTER', 'SKYBIRD', 'DISREGARDED', 'OTHER'];

        // Transform the collection to have a nested list of message types and counts
        $dailyMessageCounts = $dailyMessageCounts->groupBy('date')->map(function ($dateGroup) use ($messageTypes) {
            $result = [];

            // Initialize counts for all message types to 0
            foreach ($messageTypes as $type) {
                $result[$type] = 0;
            }

            // Calculate the counts for each message type
            foreach ($dateGroup as $item) {
                $result[$item->type] = $item->count;
            }

            return $result;
        });

        return new JsonResponse($dailyMessageCounts);
    }
}
