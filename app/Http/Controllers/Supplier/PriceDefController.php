<?php
namespace App\Http\Controllers\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Price_definition;
class PriceDefController extends Controller {
    public function store(Request $request){
        $data=$request->all();
        Price_definition::create($data);
        return redirect()->back();
    }

}
