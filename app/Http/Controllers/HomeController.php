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

        $father_id = $request->input('node_id');

        if(!isset($father_id))
        {
            $father_id = 0;
        }

        $children = new Children();
        $children->id = Node::all()->last()->id + 1;
        $children->father_id = $father_id;
        $children->save();

        $level_node = $request->input('level_node');

        if (isset($level_node))
        {
            $level_node += 1;
        }
        else
        {
            $level_node = 0;
        }

        $node = new Node();
        $node->name  = $request->input('name_node');
        $node->txt   = $request->input('txt_node');
        $node->level = $level_node;
        $node->save();

        return redirect('home')->with('success', 'Информациата за сайта е създадена')->with('title', 'Информация за сайта');
    }


    public function update(Request $request)
    {

        //$this->validate($request, [
          //  'name_node' => 'required'
        //]);
        $u_node_id   = $request->input('node_id');

        $node = Node::find($u_node_id);
        $node->name  = $request->input('name_node');
        $node->txt   = $request->input('txt_node');
        $node->level = $request->input('level_node');
        $node->save();

        return redirect('home')->with('u_node_id', $u_node_id);
    }

    public function destroy(Request $request)
    {
        $node = Node::find($request->input('node_id'));
        $child = Children::find($request->input('node_id'));
        $child->delete();
        $node->delete();

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
