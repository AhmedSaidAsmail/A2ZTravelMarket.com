<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attraction;
use App\Models\Sort;
use App\Models\Item;
// old
use App\MyModels\Admin\Topic;

class HomeController extends Controller {

    public function welcome() {
        $topAttractions = Attraction::where('status', 1)->orderBy('recommended')->get();
        $moreAttraction = (count($topAttractions) > 9) ? TRUE : FALSE;
        $topCitis = Sort::where('status', 1)->orderBy('recommended')->get();
        $moreCity = (count($topCitis) > 9) ? TRUE : FALSE;
        return view('Web.1_welcome', [
            'topAttractions' => $topAttractions,
            'moreAttraction' => $moreAttraction,
            'topCitis' => $topCitis,
            'moreCity' => $moreCity
        ]);
    }

    public function topicsShow($topicName) {
        if (strtolower($topicName) == "home") {
            return redirect()->route('home');
        }
        $topic = urldecode($topicName);
        $topicFetch = Topic::where('name', $topic)->first();
        return view('Web.topicsShow', [
            'topic' => $topicFetch,]);
    }

    public function searchItems(Request $request) {
        $text = $request->text;
        $items = Item::where('name', 'like', '%' . $text . '%')
                ->orWhere('title', 'like', '%' . $text . '%')
                ->orWhere('intro', 'like', '%' . $text . '%')
                ->get();
        return view('Web.searchResult', ["items" => $items]);
    }

    public function getDays($id) {
        $daysOff = [];
        $weekDays = [0 => "Sunday", 1 => "Monday", 2 => "Tuesday", 3 => "Wednesday", 4 => "Thursday", 5 => "Friday", 6 => "Saturday"];
        $item = Item::find($id);
        if (isset($item->detail)) {
            $days = unserialize($item->detail->availability);
            $daysOff = array_diff($weekDays, $days);
            $returnDays = array_keys($daysOff);
            if (count($returnDays) > 0) {
                return json_encode($returnDays);
            } else {
                return json_encode(null);
            }
        } else {
            return null;
        }
    }

}
