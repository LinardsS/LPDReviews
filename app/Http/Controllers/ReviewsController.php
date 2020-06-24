<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager as Image;
use Illuminate\Support\Facades\Storage;
use App\Review;
use App\Category;
use DB;

class ReviewsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews= Review::orderBy('created_at','desc')->paginate(10);
        return view('reviews.index')->with('reviews', $reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('reviews.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_img' => 'image|nullable|max:1999',
            'category_id' => 'required|integer'
        ]);

        //Handle file upload
            if($request->hasFile('cover_img')){
                //Get filename with the extension
                $filenameWithExt = $request->file('cover_img')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //Get just extension
                $extension = $request->file('cover_img')->getClientOriginalExtension();
                //Filename to store
                $filenameToStore = $filename.'_'.time().'.'.$extension; //with time to guarantee unique file names
                //Upload image
                $path = $request->file('cover_img')->storeAs('public/cover_images', $filenameToStore);
            } else {
               $filenameToStore = 'noimage.jpg'; 
            }

        //Create Review
        $review = new Review;
        $review->title = $request->input('title');
        $review->body = $request->input('body');
        $review->user_id = auth()->user()->id;
        $review->cover_img = $filenameToStore;
        $review->category_id =$request->input('category_id');
        $review->save();

        return redirect('/reviews')->with('success', 'Review Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::find($id);
        return view('reviews.show')->with('review',$review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::find($id);
        //Checks for correct user
        if(auth()->user()->id !==$review->user_id){
            return redirect('/reviews')->with('error','Unauthorized user');
        }
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category){
            $cats[$category->id] = $category->name;
        }
        return view('reviews.edit')->with('review',$review)->with('categories',$cats);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_img' => 'image|nullable|max:1999',
            'category_id' => 'required|integer'
        ]);

        //Handle file upload
        if($request->hasFile('cover_img')){
            //Get filename with the extension
            $filenameWithExt = $request->file('cover_img')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_img')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension; //with time to guarantee unique file names
            //Upload image
            $path = $request->file('cover_img')->storeAs('public/cover_images', $filenameToStore);
        }
        //Create Review
        $review = Review::find($id);
        //Checks for correct user
        if(auth()->user()->id !==$review->user_id){
            return redirect('/reviews')->with('error','Unauthorized user');
        }
        $review->title = $request->input('title');
        $review->body = $request->input('body');
        if($request->hasFile('cover_img')) {
            $review->cover_img = $filenameToStore;
        }
        if ($request->hasFile('cover_img')) {
            Storage::delete('public/cover_images/' . $review->cover_image);
            $review->cover_img = $filenameToStore;
        }
        $review->category_id=$request->input('category_id');

        $review->save();

        return redirect('/reviews')->with('success', 'Review Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::find($id);
        //Checks for correct user
        if(auth()->user()->id !==$review->user_id){
            return redirect('/reviews')->with('error','Unauthorized user');
        }
        if($review->cover_img!='noimage.jpg'){
                Storage::delete('public/cover_images/'.$review->cover_img);
        }

        $review->delete();
        return redirect('/reviews')->with('success', 'Review Deleted');
    }
}
