<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ZohoController;
use Illuminate\Http\Request;
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;
use zcrmsdk\crm\crud\ZCRMRecord;
use zcrmsdk\crm\crud\ZCRMInventoryLineItem;
use zcrmsdk\crm\crud\ZCRMTax;
use App\Models\SelectValue;
use App\Models\Profession;
use App\Models\Specialty;
use App\Models\BlogContent;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class NewsXmlSitemapController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
      $blogs = BlogContent::where('cat_id', [18])->orderBy('id', 'DESC')->get();

      header("Content-type: application/xml");
      echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">' . PHP_EOL;

     foreach($blogs as $blog)
     {
        $canonical_url = $blog->canonical_url;
        $canonical_url = preg_replace('/News/', 'news', $canonical_url, 1);
      $blog->title = preg_replace('/[^A-Za-z0-9\- ]/', '', $blog->title);
       echo '<url>' . PHP_EOL;
         echo '<loc>'.$canonical_url.'</loc>' . PHP_EOL;
         echo '<news:news>' . PHP_EOL;
           echo '<news:publication>' . PHP_EOL;
             echo '<news:name>Future Starr</news:name>' . PHP_EOL;
             echo '<news:language>en</news:language>' . PHP_EOL;
           echo '</news:publication>' . PHP_EOL;
           echo '<news:publication_date>'.($blog->date).'</news:publication_date>' . PHP_EOL;
           echo '<news:title>'.($blog->title).'</news:title>' . PHP_EOL;
         echo '</news:news>' . PHP_EOL;
       echo '</url>' . PHP_EOL;
     }
     echo '</urlset>' . PHP_EOL;    
   }
 }
