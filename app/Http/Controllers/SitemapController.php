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

        return "Submitted";
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
            $sitemap->add(URL::to('/'), $lastMod, '1.0', 'weekly',  [
                [
                    'url' => asset('img/nitya-logo.png'),
                    'caption' => 'Nitya - Eternal Fashion'
                ],
                [
                    'url' => asset('img/default-og-image.jpg'),
                    'caption' => 'Manufacturers and wholesalers of Jaipuri kurtis, Cotton kurtis, Palazzos, indian women\'s clothing and dress material'
                ]
            ]);
            $sitemap->add(URL::to('about'), $lastMod, '0.9', 'monthly');
            $sitemap->add(URL::to('products'), $lastMod, '0.9', 'weekly');
            $sitemap->add(URL::to('contact'), $lastMod, '0.9', 'weekly');
            $sitemap->add(URL::to('search'), $lastMod, '0.9', 'weekly');
            $products = Product::visibleToUser()->with('images')->get();

            // add every public Product to the sitemap
            foreach ($products as $product)
            {
                $imageUrls = [];
                foreach($product->images as $image) {
                    $imageUrls[] = [
                        'url' => asset('img/md/' . $image->name),
                        'caption' => $product->name
                    ];
                }
                $sitemap->add(url_product($product), $product->updated_at, '0.9', 'weekly', $imageUrls);
            }

            $sitemap->add(URL::to('more'), $lastMod, '0.7', 'weekly');
        }

        return $sitemap;
    }
}
