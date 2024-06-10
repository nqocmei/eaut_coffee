<?php

namespace App\Http\Controllers;

use App\Repositories\Banner\BannerInterface;
use App\Repositories\Categories\CategoriesInterface;
use App\Repositories\Product\ProductInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $sanphamRepository;
    private $bannerRepository;
    private $productRepository;
    private $categoriesRepository;

    public function __construct(
        BannerInterface $bannerRepository,
        ProductInterface $productRepository,
        CategoriesInterface $categoriesRepository
    ) {
        $this->bannerRepository = $bannerRepository;
        $this->productRepository = $productRepository;
        $this->categoriesRepository = $categoriesRepository;
    }

    public function index(Request $request)
    {
        $banners = $this->bannerRepository->getAllBanner();
        $productsForHome = $this->productRepository->getProductForHome();
        $related_products = $this->productRepository->relatedProduct();
        $categories = $this->categoriesRepository->getAllCategories();
        // get by category
        $products_by_category = $this->productRepository->getProductByCategory(
            $request->query('category') ?? 1
        );
        return view('pages.home', [
            'banners' => $banners,
            'productsForHome' => $productsForHome,
            'related_products' => $related_products,
            'products_by_category' => $products_by_category,
            'categories' => $categories,
        ]);
    }

    public function search(Request $request)
    {
        $searchs = $this->productRepository->searchProduct($request);
        return view('pages.search')->with('searchs', $searchs)->with('keyword', $request->input('keyword'));
    }

    public function viewAll()
    {
        $viewAllPaginations = $this->productRepository->viewAllWithPagination();
        return view('pages.viewall', ['products' => $viewAllPaginations]);
    }

    public function services()
    {
        $banners = $this->bannerRepository->getAllBanner();
        return view('pages.services', compact('banners'));
    }

    public function fallback() {
        return view('pages.notFound');
    }

}
