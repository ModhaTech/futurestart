<?php

namespace App\Http\Controllers;

use App\Models\BlogContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogSitemapController extends Controller
{
    public function index()
    {
        // Fetch all blog posts
        $posts = BlogContent::all();
        
        // Initialize array to store URLs
        $urls = [];

        // Add URLs for individual post details pages to the sitemap
        foreach ($posts as $post) {
            if (!empty($post->canonical_url)) {
                $urls[] = [
                    'loc' => e($post->canonical_url),
                    'lastmod' => $post->updated_at ? $post->updated_at->toAtomString() : now()->toAtomString(),
                ];
            }
        }

        // Generate the sitemap XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . $url['loc'] . '</loc>';
            $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>';
            $xml .= '<changefreq>daily</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        // Save the XML to the public directory as sitemap.xml
        $sitemapPath = public_path('sitemap.xml');
        File::put($sitemapPath, $xml);

        // Return the XML response
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
