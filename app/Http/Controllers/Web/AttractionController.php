<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attraction;
use App\Models\Item;
use App\Models\Price;

class AttractionController extends Controller {

    private $weekDays = [];
    private $tours = [];

    public function showAttractions($id) {
        $attraction = Attraction::find($id);
        $items = $attraction->items()->where('status', 1)->where('deleted', 0)->orderBy('arrangement')->limit(5)->get();
        $moreAttraction = (count($attraction->items()->where('status', 1)->where('deleted', 0)->get()) > 5) ? true : false;
        $topCityAttractions = $attraction->sort->attractions()->where('status', 1)->where('id', '!=', $id)->orderBy('recommended')->limit(5)->get();
        return view('Web.2_attraction', [
            'attraction' => $attraction,
            'items' => $items,
            'moreAttraction' => $moreAttraction,
            'topCityAttractions' => $topCityAttractions]);
    }

    public function showAllAttractions($id) {
        $attraction = Attraction::find($id);
        $items = $attraction->items()->where('status', 1)->where('deleted', 0)->orderBy('arrangement')->get();
        return view('Web.3_attraction_all', [
            'attraction' => $attraction,
            'items' => $items]);
    }

    public function showAvailability(Request $request, $id) {
        $attraction = Attraction::find($id);
        $dateTo = strtotime($request->to);
        $dateFrom = strtotime($request->from);
        $days = ($dateTo - $dateFrom) / (60 * 60 * 24);
        if ($days >= 7) {
            return $this->showAllAttractions($id);
        }
        return $this->setWeekDays($dateFrom, $dateTo)
                ->setTours($attraction)
                ->getTours($attraction);
    }

    private function setWeekDays($from, $date) {
        while ($from <= $date) {
            $this->weekDays[] = date('l', $from);
            $from += (60 * 60 * 24);
        }
        return $this;
    }

    private function setTours($attraction) {
        $tours = $attraction
                ->prices()
                ->distinct()
                ->whereIn('week_day', $this->weekDays)
                ->orWhere('week_day', 'all')
                ->get(['item_id']);
        foreach ($tours as $tour){
            $this->tours[]=$tour['item_id'];
        }
        return $this;
    }

    private function getTours($attraction) {
        $items = Item::whereIn('id', $this->tours)->get();
        return view('Web.3_attraction_all', [
            'attraction' => $attraction,
            'items' => $items]);
    }

    public static function getLowestPrice($id) {
        $item = Item::find($id);
        $lowestPrice = $item->price()
                ->where('status', 1)
                ->where('deleted', 0)
                ->orderBy('st_price')
                ->first();
        return number_format($lowestPrice['st_price'], 2, '.', '');
    }

}
