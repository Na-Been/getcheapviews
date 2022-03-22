<?php

namespace App\Http\Controllers;

use App\Models\NewOrder;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        try {
            $totalSales = NewOrder::where('status', 3)->count();
            $newOrders = NewOrder::count();
            $products = Product::count();
            $users = User::where('status', 0)->count();
            $orders = NewOrder::take(10)->latest()->get();
            return view('admin.dashboard', compact('newOrders', 'totalSales', 'products', 'users', 'orders'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function markAsRead($id)
    {
        $notify = NewOrder::whereId($id)->first();
        $notify->mark_as_read = 1;
        $notify->save();
    }

    public function allOrderItmes()
    {
        try {
            $items = NewOrder::all();
            return view('admin.user.allOrders', compact('items'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function displayUsers()
    {
        try {
            $users = User::where('status', 0)->get();
            return view('admin.user.userList', compact('users'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function displayUserOrder($id)
    {
        try {
            $user = User::whereId($id)->first();
            $orders = NewOrder::where('user_id', $id)->get();
            return view('admin.user.orderList', compact('orders', 'user'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function displayAllOrderStatus($id)
    {
        try {
            $user = User::whereId($id)->first();
            $orders = NewOrder::where('user_id', $id)->get();
            return view('admin.user.userOrderStatus', compact('orders', 'user'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function displaySingleOrder($id)
    {
        try {
            $order = NewOrder::whereId($id)->with('user')->first();
            return view('admin.user.singleProduct', compact('order'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function changeUserStatus($id, $status)
    {
        try {
            DB::beginTransaction();
            $orders = NewOrder::whereId($id)->first();
            if ($status == 6) {
                $user = User::whereId($orders->user_id)->first();
                $balance = $user->credits;
                $refund = $balance + $orders->charge;
                $user->credits = $refund;
                $user->save();
                $orders->status = $status;
                $orders->save();
            } else {
                $orders->status = $status;
                $orders->save();
            }
            DB::commit();
            return back()->with('success', 'Status Changed Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'Status Cannot Be Changed');
        }
    }

    public function deleteUser()
    {
        try {
            DB::beginTransaction();
            $findUser = User::where('id', request()->user_id)->first();
            $findUser->delete();
            DB::commit();
            return back()->with('success', 'User Deleted Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'User Cannot Be Deleted');
        }

    }

    public function deleteUserOrders()
    {
        try {
            DB::beginTransaction();
            $findOrder = NewOrder::whereId(request()->order_id)->first();
            $findOrder->delete();
            DB::commit();
            return back()->with('success', 'Order Deleted Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'Order Cannot Be Deleted');
        }
    }

    public function showAllTickets()
    {
        try {
            $tickets = Ticket::all();
            return view('admin.ticket.index', compact('tickets'));
        } catch (\Exception $exception) {
            return abort(404);
        }
    }

    public function destroyTicket()
    {
        try {
            DB::beginTransaction();
            $ticket = Ticket::whereId(request()->ticket_id);
            $ticket->delete();
            DB::commit();
            return back('success', 'Tickets Deleted Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'Something Went Wrong While Deleting Ticket');
        }
    }


}
