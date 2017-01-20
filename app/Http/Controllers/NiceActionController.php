<?php
namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use App\NiceAction;
class NiceActionController extends Controller{
  public function getHome(){
    $actions = NiceAction::all();
    return view('home',['actions'=>$actions]);
  }
  public function getNiceAction($action, $name = null){
    if($name === null){
      $name ='you';
    }
    return view('actions.nice',['action'=>$action,'name'=>$name]);
  }
  public function postInsertNiceAction(Request $request){
    $this->validate($request,[
      'name'=>'required|alpha',
      'niceness'=>'required|numberic'
    ]);
    $action = new NiceAction();
    $action->name = $request['name'];
    $action->niceness ='';
    $action->save();
      return view('home', ['actions'=> $request['actions']]);
    }

}
 ?>
