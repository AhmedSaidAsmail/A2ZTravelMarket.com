<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sort;
use App\Models\Item;

class CityController extends Controller {

    private $weekDays = [];
    private $tours = [];

    public function show($id) {
        $city = Sort::find($id);
        $country = $city->basicsort;
        $attractions = $city->attractions()->where('status', 1)->get();
        $items = $city->items()->where([['items.status', 1], ['deleted', 0]])->orderBy('arrangement')->limit(4)->get();
        return view('Web.8_City_show', ['city' => $city, 'attractions' => $attractions, 'items' => $items, 'country' => $country]);
    }

    public function showAll($id) {
        $city = Sort::find($id);
        $items = $city->items()->where([['items.status', 1], ['deleted', 0]])->orderBy('arrangement')->get();
        return view('Web.9_city_all', [
            'city' => $city,
            'items' => $items]);
    }

    public function showAvailability(Request $request, $id) {
        $city = Sort::find($id);
        $dateTo = strtotime($request->to);
        $dateFrom = strtotime($request->from);
        if (empty($request->to) || empty($request->from)) {
            return $this->showAll($id);
        }
        $days = ($dateTo - $dateFrom) / (60 * 60 * 24);
        if ($days >= 7) {
            return $this->showAll($id);
        }
        return $this->setWeekDays($dateFrom, $dateTo)
                        ->setTours($city)
                        ->getTours($city);
    }

    private function setWeekDays($from, $date) {
        while ($from <= $date) {
            $this->weekDays[] = date('l', $from);
            $from += (60 * 60 * 24);
        }
        return $this;
    }

    private function setTours($city) {
        $attractions = $city->attractions;
        foreach ($attractions as $attraction) {
            $tours = $attraction
                    ->prices()
                    ->distinct()
                    ->whereIn('week_day', $this->weekDays)
                    ->orWhere('week_day', 'all')
                    ->get(['item_id']);
            foreach ($tours as $tour) {
                $this->tours[] = $tour['item_id'];
            }
        }

        return $this;
    }

    private function getTours($city) {
        $items = Item::whereIn('id', $this->tours)->get();
        return view('Web.9_city_all', [
            'city' => $city,
            'items' => $items]);
    }

}
