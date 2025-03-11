<?php

namespace App\Http\Controllers;

use App\Interfaces\FavoriteRepositoryInterface;
use App\Transformers\FavoriteTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    protected $favoriteRepository;

    public function __construct(FavoriteRepositoryInterface $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function index()
    {
        $favorites = $this->favoriteRepository->getUserFavorites(Auth::id());
        //     return fractal($favorites, new FavoriteTransformer())->respond();
        // $favorites = Favorite::with('product')->where('user_id', auth()->id())->get();

        return fractal()
            ->collection($favorites)
            ->transformWith(FavoriteTransformer::class)
            ->respond();
    }

    public function store(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);
        $this->favoriteRepository->addToFavorites(Auth::id(), $request->product_id);
        return response()->json(['message' => 'Product added to favorites']);
    }

    public function destroy($id)
    {
        $this->favoriteRepository->removeFromFavorites(Auth::id(), $id);
        return response()->json(['message' => 'Product removed from favorites']);
    }
}
