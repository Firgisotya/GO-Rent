<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreOrderDetailRequest;
use App\Models\Bank;
use App\Models\Kendaraan;
use App\Models\OrderDetail;
use App\Http\Controllers\CloudinaryStorage;

class checkoutController extends Controller
{
    public function create(OrderDetail $orderDetail)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $orderDetail = OrderDetail::where('order_id', $order->id)->get();
        return view('homepage.checkout', [
            'orderDetail' => $orderDetail,
            'order' => Order::where('user_id', Auth::user()->id)->where('status', 0)->first(),
            'banks' => Bank::all(),
            'title' => 'Checkout',
        ]);
    }

    public function store(StoreOrderDetailRequest $request, $id)
    {
        // dd($request->all());
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $orderDetail = OrderDetail::where('order_id', $order->id)->first();
        $kendaraan = Kendaraan::where('id', $orderDetail->kendaraan_id)->first();

        $validatedData = $request->validate([
            'berkas' => 'image|file',
            'bukti_pembayaran' => 'image|file',
        ]);
        $orderr = $request->validate([
            'bank_id' => 'required',
        ]);
        if ($request->file('berkas')) {
            $validateData['berkas'] = CloudinaryStorage::upload($request->file('berkas')->getRealPath(), $request->file('berkas')->getClientOriginalName());
        }
        if ($request->file('bukti_pembayaran')) {
            $validateData['bukti_pembayaran'] = CloudinaryStorage::upload($request->file('bukti_pembayaran')->getRealPath(), $request->file('bukti_pembayaran')->getClientOriginalName());
            
        }

        $ubahStock = 0;
        Kendaraan::where('id', $kendaraan->id)->update(['stock' => $ubahStock]);

        OrderDetail::where('order_id', $order->id)->update($validatedData);
        $orderr['status'] = $order->status = 1;
        Order::where('id', $order->id)->update($orderr);
        return redirect('/onProcess')->with('success', 'Pembayaran berhasil');
    }
}
