<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Set permissions on methods
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index order', ['only' => ['index']]);
        $this->middleware('permission:show order', ['only' => ['show']]);
        $this->middleware('permission:create order', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit order', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete order', ['only' => ['delete', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.orders.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request)
    {
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->orderdate = $request->orderdate;
        $order->save();

        return redirect()->route('orders.index')->with('status', 'Order toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $users = User::all();
        $order->orderdate = Carbon::createFromFormat('Y-m-d H:i:s', $order->orderdate)
            ->format('Y-m-d\TH:i');
        return view('admin.orders.edit', compact('order', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderStoreRequest $request, Order $order)
    {
        $order->user_id = $request->user_id;
        $order->orderdate = $request->orderdate;
        $order->save();

        return redirect()->route('orders.index')->with('status', 'Order gewijzigd');
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function delete(Order $order)
    {
        $users = User::all();
        $order->orderdate = Carbon::createFromFormat('Y-m-d H:i:s', $order->orderdate)
            ->format('Y-m-d\TH:i');
        return view('admin.orders.delete', compact('order', 'users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('status', 'Order verwijderd');
    }
}
