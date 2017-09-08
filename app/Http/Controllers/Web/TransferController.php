<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MyModels\Admin\Transfer;

class TransferController extends Controller {
        public function transferAllShow() {
        $lowest_taxi    = Transfer::orderBy('type_limousine')->first();
        $lowest_van     = Transfer::orderBy('type_van')->first();
        $lowest_caoster = Transfer::orderBy('type_coaster')->first();
        $lowest_bus     = Transfer::orderBy('type_bus')->first();
        $transfer_all   = Transfer::all();
        return view('Web.TransferAllShow', [
            'lowest_taxi'    => $lowest_taxi,
            'lowest_van'     => $lowest_van,
            'lowest_caoster' => $lowest_caoster,
            'lowest_bus'     => $lowest_bus,
            'transfers'      => $transfer_all]);
    }
    public function transferOneShow($id) {
        $transfer = Transfer::find($id);
        return view('Web.TranferShowOne', [
            'transfer'   => $transfer
        ]);
    }
    public function transferGetOne(Request $request) {
        $transfer = Transfer::where('dist_from', $request->dist_from)->where('dist_to', $request->dist_to)->first();
        return redirect()->route('trnafsre.one', [
                    'id' => $transfer->id
        ]);
    }
    public static function getLowestPrice() {
        $numbers = func_get_args();
        sort($numbers);
        return number_format($numbers[0], 2, '.', '');
    }
}
