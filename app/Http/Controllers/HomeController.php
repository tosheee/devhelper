<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Node;
use App\Children;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {

        $nodes = Node::all();
        return view('home')->with('nodes', $nodes);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {

        return view('home');
    }

    public function show(Request $request)
    {

        return view('home');
    }

    public function edit(Request $request)
    {

        return view('home');
    }

    public function update(Request $request)
    {

        return view('home');
    }

    public function destroy(Request $request)
    {

        return view('home');
    }
}
