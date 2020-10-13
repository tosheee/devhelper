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


    public function store(Request $request)
    {

        $this->validate($request, [
            'name_node' => 'required'
        ]);

        var_dump($request);
        $node = new Node();
        $node->name_company    = $request->input('name_company');
        $node->address_com     = $request->input('address_com');
        $node->email_com       = $request->input('email_com');
        $node->phone_com       = $request->input('phone_com');
        $node->save();

        return redirect('home')->with('success', 'Информациата за сайта е създадена')->with('title', 'Информация за сайта');
    }


    public function update(Request $request)
    {

        //$this->validate($request, [
          //  'name_node' => 'required'
        //]);

        $node = Node::find($request->input('node_id'));


        $node->name  = $request->input('name_node');
        $node->txt   = $request->input('txt_node');
        $node->level = $request->input('level_node');
        $node->save();

        return redirect('home')->with('success', 'Информациата за сайта е създадена')->with('title', 'Информация за сайта');
    }

    public function destroy(Request $request)
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

    public function create()
    {
        return view('create');
    }
}
