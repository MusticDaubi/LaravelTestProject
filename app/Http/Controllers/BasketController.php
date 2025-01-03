<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }else {
            return view('empty');
        }
        return view('basket', compact('order'));
    }

    public function basketConfirm(Request $request)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::findOrFail($orderId);
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->status = 1;
        $order->save();
        session()->forget('orderId');
        session()->flash('success', 'Ваш заказ принят в обработку');

        return redirect()->route('index');
    }
    public function basketPlace()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::findOrFail($orderId);
        return view('order', compact('order'));
    }

    public function basketAdd($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId))
        {
            $order = Order::create();
            session(['orderId' => $order->id]);
        }else {
            $order = Order::find($orderId);
        }
        if ($order->products->contains($productId))
        {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        }else {
            $order->products()->attach($productId);
        }
        $product = Product::find($productId);
        session()->flash('success','Добавлен товар ' . $product->name);
        return redirect()->route('basket');

    }

    public function basketRemove($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);
        if ($order->products->contains($productId))
        {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            }else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        $product = Product::find($productId);
        session()->flash('warning','Удален товар ' . $product->name);

        return redirect()->route('basket');
    }
}
