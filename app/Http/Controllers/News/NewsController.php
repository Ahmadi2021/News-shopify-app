<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\News;
use App\User;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $news =  News::latest()->simplePaginate(5);
        $news =  News::latest()->paginate(5);
        return view('News/index')->with(['news'=>$news]);
        // return view('News/index');
    }

    public function pagination(){
        $news =  News::latest()->paginate(5);
        return  view('partials.pagination')->with(['news' =>$news])->render();
    }

    public function  ajaxIndex(Request $request)
    {
       
        if($request->ajax()){
             
            $output='';
            $query = $request->get('query');
            
            if($query != ""){
                  $data = News::where('title','like','%'.$query.'%')->latest()
                  ->get();
            }else{
                // $data =  News::all();
                $data =  News::latest()->paginate(5);
            }
            $total_row = $data->count();
            if($total_row > 0){   
                foreach($data as $n){ 
                $output .= 
                '<tr >
                <td>'.$n->id.'</td>
                <td>'.$n->title.'</td>
                <td class="desc">'.$n->description.'</td>
               <td><span class="tag red" >'.$n->status.'</span></td>
                <td><span class="tag orange">'.$n->feature.'</span></td>
                
                <td><img src="'.url("images/".$n->image ).'" height=80px width=100px></td>
                <td>
                <a href="'. route("news.show", ["news" => $n->id]).'"><button class="secondary icon-preview"></button></a>
                <a href="'.route("news.edit", ["news" => $n->id]).'"><button class="secondary icon-edit"></button></a>
                <form action="'.route("news.destroy",["news"=>$n->id]) .'" class="delete_form"> 
                <input type="hidden" value="'.$n->id.'"  class="id">
                <button type="submit" class="delete_btn secondary icon-trash"></button>
                </form>  
                </td>
            </tr>';
                }
            }else{
                $output .= 
                '<tr> <td style="text-align:center;color:#ccc; font-size:20px" colspan="7">Not Found</td></tr>';
            }
            
           
            return response()->json(['data'=>$output,'totalRow'=>$total_row]);
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('News/create_news');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json(['data'=>$request->all()]);
        $validated = $request->validate([
            'title'       =>'required| unique:news|max:255',
            'description' =>'required',
            'status'      =>'required',
            'feature'     =>'required',
            'image'       => 'mimes:jpg,png,jpeg,jif|required',
            
        ]);
        if(!is_array($validated) && $validated->fails()){
            return response()->json(['error'=>$validated->errors()]);
        }
        $input = $request->all();
        $image = $request->image;
        $extension = $image->getClientOriginalExtension();
        $fileName = strtolower(Str::random(10));
        $file = $fileName.'.'.$extension;
        $image->move(public_path('images/'),$file);
        $input['image'] = $file;
        $news = News::create($input);
        if(!$news){
            return response()->json(['message'=>'News doesnt created!']);
        }
        return response()->json(['message'=>'Successfully Created']);
        


        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        return view('News/show_news')->with(['news'=>$news]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('News/update_news')->with(['news'=>$news]);
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
        
        $validated = $request->validate([
            'title'       =>'required|max:255| unique:news,title,'.$id,
            'description' =>'required',
            'status'      =>'required',
            'feature'     =>'required',
            'image'       => 'mimes:jpg,png,jpeg,jif',
        ]);

        if(!is_array($validated) && $validated->fails()){
            return response()->json(['error'=>$validated->errors()]);
        }
        $input = $request->all();
        if($image = $request->file('image')){
            $fileDestination = public_path('images/');
            $extension = $image->getClientOriginalExtension();
            $fileName = strtolower(Str::random(10));
            $file= $fileName.'.'.$extension;
            $image->move($fileDestination,$file);
            $input['image'] = $file;

        }else{
            unset($input['image']);
        }
        $news = News::find($id);
        $news->update($input);
        if(!$news){
            return response()->json(['error'=>'Sorry This news is not exist']);
        }
        return response()->json(['message'=>'Successfully Updated']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
        return response()->json(['message'=>'Successfully Deleted']);
        
    }

    public function showApi(){
        $user = Auth::user();
        $products = $user->api()->graph(
           'mutation {
            productCreate(input:{
                title:"New Mobile",productType:"tec",vendor:"ahmadi",
            }){
               product{
                   title,
                   id
               }
           }

        }'
    );
    return $products;
    }
}
