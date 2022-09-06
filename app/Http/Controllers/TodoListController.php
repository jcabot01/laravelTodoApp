<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem; //import model here

class TodoListController extends Controller
{

    public function index() {
        // return view('welcome', ['listItems' => ListItem::all()]);  //to show all
        return view('welcome', ['listItems' => ListItem::where('is_complete', 0)->get()]);
    }

    public function markComplete($id) {

        $listItem = ListItem::find($id);
        //error_log($listItem->name);
        $listItem->is_complete = 1;
        $listItem->save();
        return redirect('/');
    }

    public function saveItem(Request $request) { //POST method to DB
        $newListItem = new ListItem; //set new variable to new instance
        $newListItem->name = $request->listItem; //set name of new instance to payload
        $newListItem->is_complete = 0; //set is_complete to default 'false'
        $newListItem->save(); //perform save() method on new instance. (Persist to DB)
        //return view('welcome', ['listItems' => ListItem::all()]); //redirects back to homepage '/', also show listItems
        return redirect('/');
    }
}
