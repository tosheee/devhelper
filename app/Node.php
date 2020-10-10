<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Children;

class Node extends Model
{

    public static function createMenu()
    {
        $menu = array();
        $children = Children::all();
        $nodes = Node::all();

        foreach($children as $child){
            for($i = 0; $i < count($nodes); $i++){
                if($child->node_id == $nodes[$i]->node_id){
                    $parentId = $child->father_id == 0 ? null : $child->father_id;
                    $menu[$child->node_id] = array('text' => $nodes[$i]->name, 'parentID' => $parentId);
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
/*
 *
 * $menu_example = array(
        1 => array('text' => 'Item #1',	'parentID' => null),
        2 => array('text' => 'Item #2',	'parentID' => 5),
        3 => array('text' => 'Item #3',	'parentID' => 2),
        4 => array('text' => 'Item #4',	'parentID' => 2),
        5 => array('text' => 'Item #5',	'parentID' => null),
        6 => array('text' => 'Item #6',	'parentID' => 5),
        7 => array('text' => 'Item #7', 'parentID' => 3),
        8 => array('text' => 'Item #8', 'parentID' => 5),
        9 => array('text' => 'Item #9', 'parentID' => 1),
        10 => array('text' => 'Item #10', 'parentID' => 7),
);
*/