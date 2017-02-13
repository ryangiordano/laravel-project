<?php
namespace App\Http\Controllers;


use App\Author;
use App\Quotes;
use Illuminate\Http\Request;
use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;

class QuoteController extends Controller{
  public function getIndex($author = null){
    if(!is_null($author)){
      $quote_author = Author::where('name', $author)->first();
      if($quote_author){
        $quotes = $quote_author->quotes()->orderBy('created_at', 'desc')->paginate(6);
      }
    }else {
      $quotes = Quotes::orderBy('created_at', 'desc')->paginate(6);

    }
return view('index',['quotes'=>$quotes]);
  }
  public function postQuote(Request $request){
    $this->validate($request,['author'=>'required|max:60|alpha', 'quote'=>'required|max:500','email'=>'required|email']);

    $authorText = ucfirst($request['author']);
    $quoteText = $request['quote'];

    $author = Author::where('name', $authorText)->first();
    if(!$author){
      $author = new Author();
      $author->name = $authorText;
      $author->email = $request['email'];
      $author->save();
    }
    Event::fire(new QuoteCreated($author));
      $quote = new Quotes();
      $quote->quote= $quoteText;

      $author->quotes()->save($quote);

      return redirect()->route('index')->with(['success'=>'Quote Saved']);

  }

  public function getDeleteQuote($quoteId){
    $quote = Quotes::find($quoteId);
    $author_deleted = false;
    if(count($quote->author->quotes)=== 1){
      $quote->author->delete();
      $author_deleted = true;
      }
      $quote->delete();
      $msg = $author_deleted ? "Author deleted along with their shitty quotes" : "Quote deleted.";
      return redirect()->route('index')->with(['success'=>$msg]);

  }
}
 ?>
