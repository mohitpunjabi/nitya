<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller {

    /**
     * Creates a new Controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Generates a basic sitemap.
     *
     */
    public function index()
    {
        $sitemap = $this->buildSitemap();
        return $sitemap->render('xml');
    }

    /**
     * Submits the sitemap to various sites.
     *
     */
    public function submit()
    {
        submit_sitemap();
        $sitemap = $this->buildSitemap();
        foreach($sitemap->model->items as $item)
        {
            submit_to_facebook($item['loc']);
        }
    }

    /**
     * Builds all links.
     *
     * @return Sitemap
     */
    private function buildSitemap()
    {
        $sitemap = App::make("sitemap");
        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached())
        {
            $lastMod = Carbon::now();
            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add(URL::to('/'), $lastMod, '1.0', 'weekly');
            $sitemap->add(URL::to('about'), $lastMod, '0.9', 'monthly');
            $sitemap->add(URL::to('products'), $lastMod, '0.9', 'weekly');
            $sitemap->add(URL::to('contact'), $lastMod, '0.9', 'weekly');


            $products = Product::visibleToUser()->get();

            // add every public Product to the sitemap
            foreach ($products as $product)
            {
                $sitemap->add(route('products.show', $product), $product->updated_at, '0.8', 'weekly');
            }
        }

        return $sitemap;
    }
}
