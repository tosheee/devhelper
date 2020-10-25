<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

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
        $father_id = $request->input('node_id');

        if(!isset($father_id))
        {
            $father_id = 0;
        }



        $level_node = $request->input('level_node');

        $level_node = isset($level_node) ?  $level_node += 1 : 0;

        $txt_node = $request->input('txt_node');

        $node = new Node();
        $node->name  = $request->input('name_node');
        $node->txt   = isset($txt_node) ? $txt_node : '';
        $node->level = $level_node;
        $node->save();


        $last_id = Node::all()->last()->id;

        $children = new Children();
        $children->id =  $last_id;
        $children->father_id = $father_id;
        $children->save();

        return redirect('home')->with('u_node_id', $last_id);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name_node' => 'required'
        ]);

        $u_node_id   = $request->input('node_id');

        $node = Node::find($u_node_id);
        $node->name  = $request->input('name_node');
        $node->txt   = $request->input('txt_node');
        $node->level = $request->input('level_node');
        $node->save();

        return View::make("home")->with('u_node_id', $u_node_id);
    }

    public function destroy(Request $request)
    {

        $node_id = $request->input('node_id');

        $node = Node::find($node_id);

        $child = Children::find($node_id);
        $child->delete();
        $node->delete();

        return back()->with('u_node_id', 'destroy');
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
