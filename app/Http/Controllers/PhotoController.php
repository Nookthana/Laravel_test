<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
    {
        $idAuthenticated = Auth::user()->id;

        //user_photo
        $photos  = DB::table('user_photo')->where('user_id',$idAuthenticated)->get();
        $countImageAll = DB::table('user_photo')->where('user_id',$idAuthenticated)->get()->count();
        $linkType = DB::table('user_photo')->select('mine')->distinct()->where('user_id',$idAuthenticated)->get();

        //category 
        $categories = DB::table('categories')->where('user_id',$idAuthenticated)->get();

        //category By ID
        $categories_by_id = DB::table('categories')
        ->select('id')
        ->where('user_id',$idAuthenticated)
        ->get();

        $ArrayIDCategory = Arr::flatten($categories_by_id);
    
         //count only type _user
         $TypeImage= Photo::
         select('mine')
         ->distinct()
         ->where('user_id',$idAuthenticated)
         ->get()
         ->toArray();
 
         $ArrayTypeImage = Arr::flatten($TypeImage);
         $ResultCountType = array();
 
             foreach ($ArrayTypeImage as  $value) {
 
                $ResultCountType[]  = DB::table('user_photo')
                ->select('mine')
                ->where('mine',$value)
                ->where('user_id',$idAuthenticated)
                ->get()
                ->count();
 
                }




        return view('home',compact('photos','linkType','countImageAll','ResultCountType','categories','ArrayIDCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$category)
    {


       
        $User_id = Auth::user()->id;
        $UserPath = Auth::user()->email;

        $gallery = new Gallery;

    if ($request->hasFile('file')) {

      


            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $fileMimeType = $file->getMimeType();
            $Create = date("d-m-Y H:i:s");


            $categoryName = DB::table('categories')
            ->select('id')
            ->where('id',$category)
            ->get();

            $NameCategoryPath = Arr::flatten($categoryName);

          
            $file->move('uploads/'.$UserPath.'/'.'images/'.$NameCategoryPath[0]->id.'/',$fileName);

            $MineType = explode("/", $fileMimeType);

            $gallery->categories_id = $category;
            $gallery->user_id = $User_id;
            $gallery->src = $fileName;
            $gallery->size = $fileSize;
            $gallery->mine =  $MineType[1];
            $gallery->created_at =  $Create;

        }
       

        $gallery->save();

        return redirect()->back();


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $User_id = Auth::user()->id;
        $UserPath = Auth::user()->email;
        

       
        $photo = new Photo;
        $photo->src = $request->input('photo_upload');

        if ($request->hasFile('photo_upload')) {

            $file = $request->file('photo_upload');
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $fileMimeType = $file->getMimeType();
            $Create = date("d-m-Y H:i:s");
            $file->move('uploads/'.$UserPath.'/'.'images/', $fileName);

            $MineType = explode("/", $fileMimeType);

            $photo->user_id = $User_id;
            $photo->src = $fileName;
            $photo->size = $fileSize;
            $photo->mine =  $MineType[1];
            $photo->created_at =  $Create;

        }
       

        $photo->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo, $link)
    {

        $User_id = Auth::user()->id;

        if ($link == 'all') {

            $ImagesType = Photo::all()
            ->where('user_id',$User_id);

        }else{

            $ImagesType = Photo::all()
            ->where('mine',$link)
            ->where('user_id',$User_id);
        }
      

        $linkType = DB::table('user_photo')
        ->select('mine')
        ->distinct()
        ->where('user_id',$User_id)
        ->get()->toArray();
        //all count images
        $countImageAll = DB::table('user_photo')->where('user_id',$User_id)->get()->count();
        //count only type
        $TypeImage= Photo::
        select('mine')
        ->distinct()
        ->where('user_id',$User_id)
        ->get()
        ->toArray();

        $ArrayTypeImage = Arr::flatten($TypeImage);
        $ResultCountType = array();

            foreach ($ArrayTypeImage as  $value) {

                        $ResultCountType[]  = DB::table('user_photo')
                                                  ->select('mine')
                                                  ->where('mine',$value)
                                                  ->where('user_id',$User_id)
                                                  ->get()
                                                  ->count();

               }


      
        
        return view('photos.show_type_only')->with(compact('linkType','ImagesType','countImageAll','ResultCountType'));
              
   

     


        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $User_id = Auth::user()->id;
        $UserPath = Auth::user()->email;
        
        $ImageOldID = $request->input('ImageOldID');
  
        $QueryNameOldImage  = DB::table('user_photo')
                             ->select('src')
                             ->where('user_id',$User_id)
                             ->where('id',$ImageOldID)                   
                             ->get();

        $NameOldImage = Arr::flatten($QueryNameOldImage);


        
       $OldSrcImage  = public_path('uploads/'.$UserPath.'/'.'images/'.$NameOldImage[0]->src); 
       unlink($OldSrcImage);


       if ($request->hasFile('photo_edit')) {

           $file = $request->file('photo_edit');
           $fileName = $file->getClientOriginalName();
           $fileSize = $file->getSize();
           $fileMimeType = $file->getMimeType();
           $file->move('uploads/'.$UserPath.'/'.'images/', $fileName);

           $MineType = explode("/", $fileMimeType);

           DB::table('user_photo')
               ->where('user_id',$User_id)
               ->where('id', $ImageOldID)
               ->update([

                        'src' => $fileName,
                        'size' => $fileSize,
                        'mine' => $MineType[0],
                        'updated_at' => now(),

                        ]);
            

       }
      


       return redirect()->route('home.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Photo $photo)
    {

       $photo_id = $request->photo['id'];
       $user_id = $request->photo['user_id'];
       $src = $request->photo['src'];

       $OldSrcImage  = public_path('uploads/'.Auth::user()->email.'/'.'images/'.$src); 
       unlink($OldSrcImage);
      
       DB::table('user_photo')
           ->where('id', $photo_id)
           ->where('user_id',$user_id)
           ->where('src',$src)
           ->delete();


           return redirect()->back();
 
        
    }


    public function FetchAllImageFromUser(Request $request,Photo $photo)
    {

      
                        $Image = Photo::all();


                        return view('welcome')->with(compact('Image'));
                    // return view('welcome',compact('Image'));
        
    }






}
