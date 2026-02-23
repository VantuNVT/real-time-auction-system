<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuctionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // admin routes will be checked in methods
    }

    public function index()
    {
        $auctions = Auction::orderBy('start_time', 'desc')->paginate(10);
        return view('auctions.index', compact('auctions'));
    }

    public function show(Auction $auction)
    {
        // load bids relationship for history
        $auction->load('bids.user');
        return view('auctions.show', compact('auction'));
    }

    public function create()
    {
        $this->authorize('manage-auctions');
        return view('auctions.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manage-auctions');
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'starting_price' => 'required|numeric|min:0',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $data['current_price'] = $data['starting_price'];
        $data['status'] = 'pending';

        Auction::create($data);

        return redirect()->route('auctions.index')->with('success', 'Auction created');
    }

    /**
     * Handle a bid submission.
     * Must be > current price; uses transaction & lock to avoid race.
     */
    public function bid(Request $request, Auction $auction)
    {
        $request->validate([
            'amount' => 'required|numeric|gt:'.$auction->current_price,
        ]);

        if ($auction->status !== 'active') {
            return back()->withErrors(['amount' => 'Phiên đấu giá chưa mở hoặc đã đóng.']);
        }

        $user = Auth::user();

        // transaction with locking
        
        
        
        \DB::transaction(function () use ($auction, $user, $request) {
            $fresh = Auction::lockForUpdate()->find($auction->id);
            if ($request->amount <= $fresh->current_price) {
                throw new \Exception('Giá phải cao hơn giá hiện tại');
            }
            // update price
            $fresh->current_price = $request->amount;
            $fresh->save();

            $fresh->bids()->create([
                'user_id' => $user->id,
                'amount' => $request->amount,
            ]);
        });

        return back()->with('success', 'Đặt giá thành công');
    }
}
