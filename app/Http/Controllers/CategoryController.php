<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $User_id = Auth::user()->id;
        $UserPath = Auth::user()->email;

      

                        

        $categories = Category::all()
                      ->where('user_id', $User_id);
                   

  
        //category id 
        $category_id_all = Gallery::
                           select('categories_id')
                          ->distinct()
                          ->where('user_id', $User_id)            
                          ->get()
                          ->toArray();

            $ArrayIDCategories = Arr::flatten($category_id_all);

  
            $ResultCountImageLastInCategory = array();

            foreach ($ArrayIDCategories as  $value) {
            
               $ResultCountImageLastInCategory[]  = DB::table('gallery')
                                                        ->select('src')
                                                        ->where('categories_id',$value)
                                                        ->where('user_id',$User_id)
                                                        ->orderBy('id','DESC')
                                                        ->first();
              
                                                    }

                                                  

       return view('categories.index',compact('categories','ResultCountImageLastInCategory'));

       

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');   
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

        Category::create([
            'user_id' => $User_id,
            'title' => $request->input('title')

        ]);



        $category_query_ID = DB::table('categories')
        ->select('id')
        ->orderBy('id','DESC')
        ->first();

  
        $categoryID = Arr::flatten($category_query_ID);
  
        $gallery = new Gallery;
        $gallery->src = $request->input('imgCategory');

  
    
    if ($request->hasFile('imgCategory')) {

            $file = $request->file('imgCategory');
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $fileMimeType = $file->getMimeType();
            $Create = date("d-m-Y H:i:s");


            $categoryName = DB::table('categories')
            ->select('id')
            ->where('id',$categoryID[0])
            ->get();

            $NameCategoryPath = Arr::flatten($categoryName);

          
            $file->move('uploads/'.$UserPath.'/'.'images/'.$NameCategoryPath[0]->id.'/', $fileName);

            $MineType = explode("/", $fileMimeType);

            $gallery->categories_id = $categoryID[0];
            $gallery->user_id = $User_id;
            $gallery->src = $fileName;
            $gallery->size = $fileSize;
            $gallery->mine =  $MineType[1];
            $gallery->created_at =  $Create;

  

        }
       

        $gallery->save();


        

        return redirect()->route('categories.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        
        $User_id = Auth::user()->id;
        $UserPath = Auth::user()->email;

        $categoryID = $category->id;

       

        $galleryAll = Gallery::all()
                            ->where('categories_id', $category->id)
                            ->where('user_id',$User_id);

        //count Image all on gallery
        $countImageAll = DB::table('gallery')->where('user_id',$User_id)->where('categories_id', $category->id)->get()->count();
        //link type
        $linkType = DB::table('gallery')->select('mine')->distinct()->where('categories_id', $category->id)->where('user_id',$User_id)->get();

        //count only on gallery
         $TypeImage= Gallery::
                     select('mine')
                     ->distinct()
                     ->where('user_id',$User_id)
                     ->get()
                     ->toArray();


         $ArrayTypeImage = Arr::flatten($TypeImage);
         $ResultCountType = array();
 
             foreach ($ArrayTypeImage as  $value) {
 
                $ResultCountType[]  = DB::table('gallery')
                ->select('mine')
                ->where('mine',$value)
                ->where('categories_id',$category->id)
                ->where('user_id',$User_id)
                ->get()
                ->count();
 
                }


        //gallery By ID
        $gallery_by_id = DB::table('gallery')
        ->select('id')
        ->where('user_id',$User_id)
        ->where('categories_id',$category->id)
        ->get();

        $ArrayIDCategory = Arr::flatten($gallery_by_id);
 
   

        return view('categories.view',compact('galleryAll','categoryID','countImageAll','ArrayIDCategory','ResultCountType','linkType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
   

      $category->update([
 
        'title' => $request->input('title')
   
      ]);


        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('categories.index');
    }


    public function showType(Gallery $photo, $link,$category)
    {


        $User_id = Auth::user()->id;
        $User_path = Auth::user()->email;
        $categoryID = $category;

        if ($link == 'all') {

            $ImagesType = Gallery::all()
            ->where('user_id',$User_id)
            ->where('categories_id',$category);

        }else{

            $ImagesType = Gallery::all()
            ->where('mine',$link)
            ->where('user_id',$User_id)
            ->where('categories_id',$category);
        }
      

        $linkType = DB::table('gallery')
        ->select('mine')
        ->distinct()
        ->where('user_id',$User_id)
        ->where('categories_id',$category)
        ->get()->toArray();
        //all count images
        $countImageAll = DB::table('gallery')->where('user_id',$User_id)->where('categories_id',$category)->get()->count();
        //count only type
        $TypeImage= Gallery::
        select('mine')
        ->distinct()
        ->where('user_id',$User_id)
        ->where('categories_id',$category)
        ->get()
        ->toArray();

        $ArrayTypeImage = Arr::flatten($TypeImage);
        $ResultCountType = array();

            foreach ($ArrayTypeImage as  $value) {

                        $ResultCountType[]  = DB::table('gallery')
                                                  ->select('mine')
                                                  ->where('mine',$value)
                                                  ->where('user_id',$User_id)
                                                  ->where('categories_id',$category)
                                                  ->get()
                                                  ->count();

               }

           

        
        return view('categories.showtype')->with(compact('linkType','ImagesType','countImageAll','ResultCountType','categoryID'));
              
   

   
}

public function UploadImageOnCategory(Request $request, $category){

    $User_id = Auth::user()->id;
    $UserPath = Auth::user()->email;  
    $gallery = new Gallery;


  
 if ($request->hasFile('imgCategory')) {

  

        $file = $request->file('imgCategory');
        $fileName = $file->getClientOriginalName();
        $fileSize = $file->getSize();
        $fileMimeType = $file->getMimeType();
        $Create = date("d-m-Y H:i:s");


        $categoryName = DB::table('categories')
        ->select('id')
        ->where('id',$category)
        ->get();

        $NameCategoryPath = Arr::flatten($categoryName);

      
        $file->move('uploads/'.$UserPath.'/'.'images/'.$NameCategoryPath[0]->id.'/', $fileName);

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


  public function EditImageOnCategory(Request $request){

    $User_id = Auth::user()->id;
    $UserPath = Auth::user()->email;

    $CategoryID = $request->input('categoryID');

    
    $ImageOldID = $request->input('ImageOldID');


    $QueryNameOldImage  = DB::table('gallery')
                         ->select('src')
                         ->where('user_id',$User_id)
                         ->where('categories_id',$CategoryID)
                         ->where('id',$ImageOldID)                   
                         ->get();

    $NameOldImage = Arr::flatten($QueryNameOldImage);

      
    
   $OldSrcImage  = public_path('uploads/'.$UserPath.'/'.'images/'.$CategoryID.'/'.$NameOldImage[0]->src);
   unlink($OldSrcImage);


   if ($request->hasFile('photo_edit_on_category')) {

       $file = $request->file('photo_edit_on_category');
       $fileName = $file->getClientOriginalName();
       $fileSize = $file->getSize();
       $fileMimeType = $file->getMimeType();
       $file->move('uploads/'.$UserPath.'/'.'images/'.$CategoryID.'/', $fileName);

       $MineType = explode("/", $fileMimeType);

       DB::table('gallery')
           ->where('user_id',$User_id)
           ->where('categories_id',$CategoryID)
           ->where('id', $ImageOldID)
           ->update([

                    'src' => $fileName,
                    'size' => $fileSize,
                    'mine' => $MineType[0],
                    'updated_at' => now(),

                    ]);
        

   }

   return redirect()->back();
  
  }


  public function destroyImageInCategory(Request $request)
  {


    
      $User_id = Auth::user()->id;
      $UserPath = Auth::user()->email;

       $gallery = $request->input('gallery');
       $photo_id =$request->input('photo_id');

       $QNameImage = DB::table('gallery')
                        ->select('src')
                        ->where('id',$photo_id)
                        ->where('categories_id',$gallery)
                        ->where('user_id', $User_id)
                        ->get();

        $NameOldImage = Arr::flatten($QNameImage);

      
       $OldSrcImage  = public_path('uploads/'.$UserPath.'/'.'images/'.$gallery.'/'.$NameOldImage[0]->src); 
       unlink($OldSrcImage);
      
       DB::table('gallery')
           ->where('id', $photo_id)
           ->where('user_id', $User_id)
           ->where('src',$NameOldImage[0]->src)
           ->delete();

     
      return redirect()->back();

  }


  public function DeleteCategory(Request $request, Category  $category)

  {

    $User_id = Auth::user()->id;
    $UserPath = Auth::user()->email;
    $gallery =  $request->input('CategoryID');


    DB::table('categories')
    ->where('id', $gallery)
    ->where('user_id', $User_id)
    ->delete();

    File::deleteDirectory(public_path('uploads/'.$UserPath.'/'.'images/'.$gallery));


    
    return redirect()->back();

  }
}
