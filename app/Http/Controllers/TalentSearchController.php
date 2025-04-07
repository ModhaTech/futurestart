<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TalentCatagory;
use App\Models\Metatags;
use App\Models\Talents;
use App\User;
use Response;

class TalentSearchController extends Controller
{
    /**
     * Display a listing of the search
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = trim($request->input('search'));

        if (empty($query)) {
            return response()->json([
                'state' => 0,
                'message' => 'Empty search query.',
                'results' => []
            ]);
        }

        // Expand input into smart wildcards, e.g. "talent" → "t%a%l%e%n%t"
        $wildcard = implode('%', str_split($query));

        // Common filters
        $talentConditions = ['active' => 'Active', 'approved' => 1];

        // Run all queries
        $talents = Talents::where('title', 'like', "%{$wildcard}%")
                          ->where($talentConditions)
                          ->get();

        $categories = TalentCatagory::where('name', 'like', "%{$wildcard}%")
                                    ->get();

        $sellers = User::where('username', 'like', "%{$wildcard}%")
                       ->where('role_id', 4)
                       ->get();

        $buyers = User::where('username', 'like', "%{$wildcard}%")
                      ->where('role_id', 3)
                      ->get();

        // Return structured JSON
        return response()->json([
            'state' => 1,
            'results' => [
                'talents' => $talents,
                'categories' => $categories,
                'sellers' => $sellers,
                'buyers' => $buyers,
            ]
        ]);
    }

}
