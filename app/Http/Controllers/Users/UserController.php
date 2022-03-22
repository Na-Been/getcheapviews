<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\FAQ;
use App\Models\Fund;
use App\Models\NewOrder;
use App\Models\Product;
use App\Models\Setting;
use App\Models\SubCategory;
use App\Models\Term;
use App\Models\Ticket;
use App\Models\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function newOrder()
    {
        try {
            $subCategories = SubCategory::orderBy('category_id')->get();
            return view('users.dashboard.newOrder', compact('subCategories'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function getServices($id)
    {
        try {
            $products = Product::where('sub_category_id', $id)->with('features')->get();
            return response($products);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function massOrder()
    {
        try {
            return view('users.dashboard.massOrder');
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function services()
    {
        try {
            $services = SubCategory::all();
            return view('users.dashboard.services',compact('services'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function orders()
    {
        try {
            $orders = NewOrder::where('user_id', Auth::id())->get();
            return view('users.dashboard.order', compact('orders'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function orderStatus($id)
    {
        try {
            $orders = NewOrder::where('user_id', Auth::id())->where('status', $id)->get();
            return response($orders);
        } catch (\Exception $e) {
            return response('status', 404);
        }
    }

    public function funds()
    {
        try {
            return view('users.dashboard.addFunds');
        } catch (\Exception $e) {
            return abrot(404);
        }
    }

    public function faq()
    {
        try {
            $questions = FAQ::all();
            return view('users.dashboard.faq', compact('questions'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function tickets()
    {
        try {
            return view('users.dashboard.ticket');
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function terms()
    {
        try {
            $terms = Term::all();
            return view('users.dashboard.terms', compact('terms'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function news()
    {
        try {
            $blogs = Blog::where('status', 1)->orderBy('updated_at')->get();
            return view('users.dashboard.news', compact('blogs'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function account()
    {
        try {
            $user = User::whereId(Auth::id())->first();
            return view('users.dashboard.account', compact('user'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users'
        ]);
        try {
            DB::beginTransaction();
            $user = User::findOrFail(Auth::id());
            $input = $request->only(['name', 'email']);
            $user->update($input);
            DB::commit();
            return back()->with('success', 'User Data Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'User Data Cannot Be Updated');
        }
    }

    public function storeNewOrder(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'services' => 'required',
            'link' => 'required',
            'quantity' => 'required|numeric',
        ]);
        $input = $request->all();
        $subCategoryName = SubCategory::whereId($request->category)->first();
        $product_id = explode(',', $request->services);
        try {
            $userCredit = User::findOrFail(Auth::id());
            if ($userCredit->credits >= $input['charge']) {
                DB::beginTransaction();
                $input['category'] = $subCategoryName->sub_category_name;
                $input['services'] = $product_id[0];
                $input['user_id'] = Auth::id();
                $oldCredits = $userCredit->credits;
                $newCredits = $oldCredits - $input['charge'];
                $userCredit->credits = $newCredits;
                $userCredit->save();
                NewOrder::create($input);
                $this->sendMail();
                DB::commit();
                return back()->with('success', 'New Order Successfully Done');
            } else {
                return back()->with('failed', 'Insufficient Fund. Please Add Fund First');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'Something Went Wrong Please Try Again');
        }
    }

    public function sendMail()
    {
        $name = config('mail.from.name');
        $to_email = Auth::user()->email;
        $userName = Auth::user()->name;
        $setting = Setting::first();
        Mail::send('mail.mail', compact('name', 'userName', 'setting'), function ($mail) use ($to_email) {
            $mail->to($to_email)->subject('Making Order At' . ' ' . config('mail.from.name'));
        });
    }

    public function storeMassOrder(Request $request)
    {
        $this->validate($request, [
            'mass_order' => 'required'
        ]);
        try {
            $input = str_replace("\r\n", ",", $request->mass_order,);
            $data = explode(',', $input);
            $results = [];
            foreach ($data as $d) {
                $finalResult = explode('|', $d);
                array_push($results, $finalResult);
            }
            DB::beginTransaction();
            foreach ($results as $result) {
                $serviceName = Product::whereId($result[0])->first();
                $charge = $serviceName->price * $result[2];
                $user = Auth::user();
                if ($user->credits >= $charge) {
                    NewOrder::create([
                        'category' => $serviceName->subCategory->sub_category_name,
                        'services' => $serviceName->title,
                        'link' => $result[1],
                        'quantity' => $result[2],
                        'charge' => $charge,
                        'user_id' => Auth::id()
                    ]);
                    $oldCredits = $user->credits;
                    $newCredits = $oldCredits - $charge;
                    $user->credits = $newCredits;
                    $user->save();
                } else {
                    return back()->with('failed', 'Insufficient Fund. Please Add Fund First');
                }
            }
            $this->sendMail();
            DB::commit();
            return back()->with('success', 'Thanks For Your Mass Order');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'Cant take your Order. Something Went Wrong Please Try Again Later');
        }
    }

    public function storeFunds(Request $request)
    {
        $this->validate($request, [
            'method' => 'required',
            'amount' => 'required',
            'tokenId' => 'required'
        ]);
        $input = $request->all();
        try {
            DB::beginTransaction();
            $input['user_id'] = Auth::id();
            $input['token_id'] = $request->tokenId;
            Fund::create($input);
            if (Auth::user()) {
                $availableCredit = Auth::user()->credits;
                $finalAmount = $availableCredit + $input['amount'];
                Auth::user()->credits = $finalAmount;
                Auth::user()->save();
            }
            Stripe::charges()->create([
                'source' => $request->tokenId,
                'currency' => 'AUD',
                'amount' => $request->amount * 100
            ]);
            DB::commit();
            return back()->with('success', 'Your Fund Had Been Added');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'Cannot Add Funds, Please Try Again');
        }
    }

    public function storeTicket(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required'
        ]);
        $input = $request->all();
        try {
            DB::beginTransaction();
            $input['user_id'] = Auth::id();
            Ticket::create($input);
            DB::commit();
            return back()->with('success', 'Thanks For Tickets');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('failed', 'Cannot Add Tickets, please Try Again');
        }
    }


}
