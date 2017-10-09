<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Customer;

class HomeController extends Controller {

    private $months = [];
    private $reservations = [];
    private $users = [];

    public function index() {
        $current_date = time();
        $past_date = $current_date - (6 * 30 * 24 * 60 * 60);
        $this->setMonths($current_date, $past_date)
                ->setReservations()
                ->setUsers();
        return view('Admin.Welcome', [
            'current_date' => $current_date,
            'past_date' => $past_date,
            'months' => $this->months,
            'reseravtions' => $this->reservations,
            'users'=> $this->users
        ]);
    }

    private function setMonths($start_date, $end_date) {
        $this->months[] = $end_date;
        for ($i = 5; $i > 0; $i--) {
            $date = $start_date - ($i * 30 * 24 * 60 * 60);
            $this->months[] = $date;
        }
        $this->months[] = $start_date;
        return $this;
    }

    private function setReservations() {
        foreach ($this->months as $month) {
            $MonthSatrting = date('Y-m-d H:i:s', $month);
            $MonthEnd = date('Y-m-d H:i:s', $month + (30 * 24 * 60 * 60));
            $resrvation = Reservation::whereBetween('created_at', array($MonthSatrting, $MonthEnd))->count();
            $this->reservations[] = $resrvation;
        }
        return $this;
    }

    private function setUsers() {
        foreach ($this->months as $month) {
            $MonthSatrting = date('Y-m-d H:i:s', $month);
            $MonthEnd = date('Y-m-d H:i:s', $month + (30 * 24 * 60 * 60));
            $customers = Customer::whereBetween('created_at', array($MonthSatrting, $MonthEnd))->count();
            $this->users[] = $customers;
        }
        
    }

}
