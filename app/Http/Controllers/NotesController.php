<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use App\Note;
use App\NotesChildren;


class NotesController extends Controller
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
        $notes = Note::all();
        $note = $notes->last();
        $note_menu = $this->createMenu();

        return view('notes.index')->with('notes', $notes)->with('note', $note)->with('note_menu', $note_menu);
    }

    public function show($id)
    {
        $note = Note::find($id);

        return view('notes.show')->with('note',  $note)->with('title', '');
    }

    public function create()
    {
        $note_menu = $this->createMenu();

        $notes = Note::all();

        return view('notes.create')->with('notes', $notes)->with('note_menu', $note_menu);
    }

    public function store(Request $request)
    {
        $father_id = $request->input('note_id');

        if(!isset($father_id))
        {
            $father_id = 0;
        }

        $level_node = $request->input('note_level');

        $level_node = isset($level_node) ?  $level_node += 1 : 0;

        $txt_node = $request->input('note_content');

        $node = new Note();
        $node->name    = $request->input('note_name');
        $node->content = isset($txt_node) ? $txt_node : '';
        $node->level   = $level_node;
        $node->save();


        $last_id = Note::all()->last()->id;

        $noteChildren = new NotesChildren();
        $noteChildren->id        =  $last_id;
        $noteChildren->father_id = $father_id;
        $noteChildren->save();

        return redirect('/notes')->with('note_id', $last_id);
    }

    public function edit($id)
    {
        $note = Note::find($id);
        return view('notes.edit')->with('note',  $note)->with('title', '');
    }

    public function update(Request $request)
    {
        //$this->validate($request, [
          //  'name_node' => 'required'
        //]);

        $note_id   = $request->input('note_id');

        $note = Note::find($note_id);
        $note->name     = $request->input('note_name');

        $note->level    = $request->input('note_level');
        $note->content  = $request->input('note_content');
        $note->bookmark = $request->input('note_bookmark');
        $note->save();

        $note = Note::find($note_id);
        $notes = Note::all();
        $note_menu = $this->createMenu();

        return View::make('notes.index')->with('note', $note)->with('note_menu', $note_menu)->with('notes', $notes);
    }

    public function destroy($id)
    {
        $note = Note::find($id);
        $noteChild = NotesChildren::find($id);
        $noteChild->delete();
        $note->delete();

        return redirect('/notes')->with('message', 'Категорията е изтрита');
    }

    public function createMenu()
    {
        $menu = array();
        $children = NotesChildren::all();
        $nodes = Note::all();

        foreach($children as $child){
            for($i = 0; $i < count($nodes); $i++){
                if($child->id == $nodes[$i]->id){
                    $parentId = $child->father_id == 0 ? null : $child->father_id;
                    $menu[$child->id] = array('text' => $nodes[$i]->name, 'parentID' => $parentId);
                }
            }
        }

        $addedAsChildren = array();

        foreach ($menu as $id => &$menuItem) { // note that we use a reference so we don't duplicate the array
            if (!empty($menuItem['parentID'])) {
                $addedAsChildren[] = $id;

                if (!isset($menu[$menuItem['parentID']]['children'])) {
                    $menu[$menuItem['parentID']]['children'] = array($id => &$menuItem);
                } else {
                    $menu[$menuItem['parentID']]['children'][$id] = &$menuItem;
                }
            }

            unset($menuItem['parentID']); // we don't need this any more
        }

        unset($menuItem); // unset the reference

        foreach ($addedAsChildren as $itemID) {
            unset($menu[$itemID]); // remove it from root so it's only in the ['children'] subarray
        }

        return $menu;
    }
}
