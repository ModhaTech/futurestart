<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TalentCatagory;
use App\Models\Metatags;
use App\Models\Talents;
use Response;
use Validator;

class SearchController extends Controller
{
    /**
     * Display a listing of the search
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $slug = '')
    { 
         
     // dd($request->ajax());
        if($request->ajax()){
                
                // $catagories = TalentCatagory::where('id', '>', $slug)->take(6)->get();
                // other category remove
                $catagories = TalentCatagory::whereNotIn('id', [17,18])->where('id', '>', $slug)->take(6)->get();
                $event = $request->event;

                if(!empty($catagories)){
                   
                    $return[] = view('frontend.search.search-ajax')->with(['categories' => $catagories, 'event' => $event])->render();
                    return response()->json(['state' => 1, 'messages' => $return]); 
                }
               
        } else {

            if(empty($slug)) {

                 $catagories = TalentCatagory::paginate(6);
                 
                 $metaTags =  Metatags::where('page_title','=','Starr Search')->first();
                 return view('frontend.search.index',compact('catagories','metaTags'));

            } else {

                 $catagory = TalentCatagory::where('slug','=',$slug)->first();
                 switch ($slug) {
                    case 'author':
                         $catagory->heading = "Advertise Your Books and Sell it Online";
                         break;
                    case 'comedy':
                         $catagory->heading = "Sell Your Comedian Career Aspirations & Earn Online";
                         break;
                    case 'cosmetics':
                         $catagory->heading = "Go Digital with Us & Sell Your Beauty Retail Products";
                         break;
                    case 'entertainment':
                         $catagory->heading = "Entertainment Careers For Actors";
                         break;
                    case 'fashion-designer':
                         $catagory->heading = "Display Your  Fashion Designing & Get Paid";
                         break;
                    case 'fitness':
                         $catagory->heading = "Establish a Fitness Model- Digital Fitness Empire";
                         break;
                    case 'food':
                         $catagory->heading = "Turn your Cooking Talent into a digital business";
                         break;
                    case 'mathematics':
                         $catagory->heading = "Be the Next Role Model in Mathematics & Earn Online";
                         break;
                    case 'model':
                         $catagory->heading = "Sale Your Model Photo to Agencies";
                         break;
                    case 'music':
                         $catagory->heading = "Sell Your Music Notes, Lyrics, and Songs";
                         break;
                    case 'nutrition':
                         $catagory->heading = "Sell Your Dietitian Expertise to Client";
                         break;
                    case 'photography':
                         $catagory->heading = "Sell Your Skills in Photography & Earn Online";
                         break;
                    case 'science':
                         $catagory->heading = "Advertised Your Science Skills & Earn Online";
                         break;
                    case 'tattoo-artist':
                         $catagory->heading = "Turn your Tattoo Tips, Photos, or Portfolios into Online Revenue!";
                         break;
                    default:
                        //  $catagory->heading = "Not a category";
                         break;
                 }
                 if(!empty($catagory)) {
						
                         $metaTags = [];
                         $metaTags = [ 
                              'title' => $catagory['meta_title'], 
                              'description' => $catagory['meta_description'], 
                              'keywords' => $catagory['meta_keywords'],
                              'og_image' => env('APP_URL') .'/'. $catagory['catagory_banner']
                          ];
						
						$whereArr = ['type' => 'Star Search', 'page_title' => $catagory['name']];
						$metaTags = Metatags::where($whereArr)->first();
						
						return view('frontend.search.info',compact('catagory','metaTags'));
                 } else {
                     
                     return redirect( route('search.index') );
                 }   
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $catagory = TalentCatagory::find($id);
        $whereArr =  ['type'=>'Categories','page_title'=> $catagory['name']];
        $metaTags =  Metatags::where($whereArr)->first();
        return view('frontend.search.info',compact('catagory','metaTags'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

   public function indexnew(Request $request, $slug = '')
    {
   
     // dd($request->ajax());
        if($request->ajax()){
                
                // $catagories = TalentCatagory::where('id', '>', $slug)->take(6)->get();
                // other category remove
                $catagories = TalentCatagory::whereNotIn('id', [17,18])->where('id', '>', $slug)->take(6)->get();
                $event = $request->event;

                if(!empty($catagories)){
                   
                    $return[] = view('frontend.search.search-ajax')->with(['categories' => $catagories, 'event' => $event])->render();
                    return response()->json(['state' => 1, 'messages' => $return]); 
                }
               
        } else {

            if(empty($slug)) {

                 $catagories = TalentCatagory::paginate(6);
                 
                 $metaTags =  Metatags::where('page_title','=','Starr Search')->first();
                 return view('frontend.search.newindex',compact('catagories','metaTags'));

            } else {

                 $catagory = TalentCatagory::where('slug','=',$slug)->first();
                 switch ($slug) {
                    case 'author':
                         $catagory->heading = "Advertise Your Books and Sell it Online";
                         break;
                    case 'comedy':
                         $catagory->heading = "Sell Your Comedian Career Aspirations & Earn Online";
                         break;
                    case 'cosmetics':
                         $catagory->heading = "Go Digital with Us & Sell Your Beauty Retail Products";
                         break;
                    case 'entertainment':
                         $catagory->heading = "Entertainment Careers For Actors";
                         break;
                    case 'fashion-designer':
                         $catagory->heading = "Display Your  Fashion Designing & Get Paid";
                         break;
                    case 'fitness':
                         $catagory->heading = "Establish a Fitness Model- Digital Fitness Empire";
                         break;
                    case 'food':
                         $catagory->heading = "Turn your Cooking Talent into a digital business";
                         break;
                    case 'mathematics':
                         $catagory->heading = "Be the Next Role Model in Mathematics & Earn Online";
                         break;
                    case 'model':
                         $catagory->heading = "Sale Your Model Photo to Agencies";
                         break;
                    case 'music':
                         $catagory->heading = "Sell Your Music Notes, Lyrics, and Songs";
                         break;
                    case 'nutrition':
                         $catagory->heading = "Sell Your Dietitian Expertise to Client";
                         break;
                    case 'photography':
                         $catagory->heading = "Sell Your Skills in Photography & Earn Online";
                         break;
                    case 'science':
                         $catagory->heading = "Advertised Your Science Skills & Earn Online";
                         break;
                    case 'tattoo-artist':
                         $catagory->heading = "Turn your Tattoo Tips, Photos, or Portfolios into Online Revenue!";
                         break;
                    default:
                        //  $catagory->heading = "Not a category";
                         break;
                 }
                 if(!empty($catagory)) {
						
                         $metaTags = [];
                         $metaTags = [ 
                              'title' => $catagory['meta_title'], 
                              'description' => $catagory['meta_description'], 
                              'keywords' => $catagory['meta_keywords'],
                              'og_image' => env('APP_URL') .'/'. $catagory['catagory_banner']
                          ];
						
						$whereArr = ['type' => 'Star Search', 'page_title' => $catagory['name']];
						$metaTags = Metatags::where($whereArr)->first();
						
						return view('frontend.search.info',compact('catagory','metaTags'));
                 } else {
                     
                     return redirect( route('newstarr.index') );
                 }   
            }
        }
    }
}
