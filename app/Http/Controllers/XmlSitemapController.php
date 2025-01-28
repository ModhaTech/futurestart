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

class XmlSitemapController extends Controller
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
        dd("helllo");
        // echo "his";die;
      $baseurl = array(
      "login",
      "register",
      "star-search",
      "star-search/cosmetics",
      "star-search/author",
      "star-search/fitness",
      "star-search/comedy",
      "star-search/entertainment",
      "star-search/fashion-designer",
      "star-search/food",
      "star-search/mathematics",
      "star-search/model",
      "star-search/music",
      "star-search/nutrition",
      "star-search/photography",
      "star-search/science",
      "star-search/tattoo-artist",
      "talent-mall",
      "social-buzz",
      "blog",
      "privacy-policy",
      "contact-us"
      );
      $blogs = BlogContent::where('blog_status', '1')->whereNotIn('cat_id', [18])->get();
      
      header("Content-type: application/xml");
      echo '<?xml version="1.0" encoding="UTF-8"?>
        <urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

      echo '<url>' . PHP_EOL;   
      echo '<loc>'.url('/') .'</loc>' . PHP_EOL;
      echo '<priority>1.00</priority>' . PHP_EOL;
      echo '</url>' . PHP_EOL;

      foreach($baseurl as $basedata)
      {
      echo '<url>' . PHP_EOL;
      echo '<loc>'.url('/'.$basedata) .'</loc>' . PHP_EOL;
      echo '<priority>0.80</priority>' . PHP_EOL;
      echo '</url>' . PHP_EOL;
      }.
      foreach($blogs as $blog)
      {
      echo '<url>' . PHP_EOL;
    echo '<loc>' . url('/blog/' . $blog->slug) . '</loc>' . PHP_EOL;
      echo '<priority>0.64</priority>' . PHP_EOL;
      echo '</url>' . PHP_EOL;
      }
     echo '</urlset>' . PHP_EOL;    
  }

// public function index(){
//      // Assuming the sitemap.xml file is in the root directory
//     $sitemapFilePath = public_path('sitemap.xml');

//     // Check if the file exists
//     if (file_exists($sitemapFilePath)) {
//         // Read the content of the sitemap.xml file
//         $sitemapContent = file_get_contents($sitemapFilePath);

//         // Output the content with the appropriate header
//         header("Content-type: application/xml");
//         echo $sitemapContent;
//     } else {
//         // Handle the case where the file does not exist
//         echo "Sitemap file not found.";
//     }
// }
 }
