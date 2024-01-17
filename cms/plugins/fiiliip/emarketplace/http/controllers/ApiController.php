<?php namespace Fiiliip\EMarketplace\Http\Controllers;

use Backend\Classes\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Fiiliip\EMarketplace\Models\Category;
use Fiiliip\EMarketplace\Models\Listing;
use Fiiliip\EMarketplace\Models\Image;

use File;

use RainLab\User\Models\User;

class ApiController extends Controller {
    public function getCategories() {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function getListings(Request $request) {
        $query = Listing::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%$search%");
        }

        if ($request->has('category')) {
            $category = $request->input('category');
            $query->where('category_id', $category);
        }

        if ($request->has('mostRecent')) {
            $mostRecent = $request->input('mostRecent'); // Contains number of how many most recent listings to return.
            $query->orderBy('created_at', 'desc')->take($mostRecent);
        }

        if ($request->has('mostViewed')) {
            $mostViewed = $request->input('mostViewed'); // Contains number of how many most viewed listings to return.
            $query->orderBy('views', 'desc')->take($mostViewed);
        }

        $listings = $query->get();

        foreach ($listings as $listing) {
            $images = Image::where('listing_id', $listing->id)->get();
            foreach ($images as $image) {
                $image->url = env('STORAGE_URL').$image->image_path;
            }
            $listing->images = $images;
        }

        return response()->json($listings, 200);
    }

    public function getListing($id) {
        $listing = Listing::where('id', $id)->first();
        if (!$listing) {
            return response()->json(['error' => 'Listing does not exist.'], 500, []);
        }

        $user = User::where('id', $listing->user_id)->first();

        $listing->author = [
            'id' => $user->id,
            'name' => $user->name . ' ' . substr($user->surname, 0, 1) . '.', // Name Surname -> Name S.
            'contact' => [
                'phone' => $user->phone_number,
                'email' => $user->email
            ]
        ];
        $listing->increment('views'); // TODO: Make better way to increment views. Views should not be incremented from the same session.
        
        $images = Image::where('listing_id', $listing->id)->get();
        foreach ($images as $image) {
            $image->url = env('STORAGE_URL').$image->image_path;
        }
        $listing->images = $images;

        return response()->json($listing, 200);
    }

    public function createListing(Request $request) {
        $rules = [
            'title' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            // 'images' => 'required|array',
            // 'images.*' => 'required|image'
            // 'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid data.'], 500, []);
        }

        if ($request->isJson()) {
            $data = $request->json()->all();
        } else {
            return response()->json(['error' => 'Data are not in JSON format.'], 500, []);
        }

        $category = Category::where('id', $data['category_id'])->first();
        if (!$category) {
            return response()->json(['error' => 'Category does not exist.'], 500, []);
        }

        $user = User::where('id', $data['user_id'])->first();
        if (!$user) {
            return response()->json(['error' => 'User does not exist.'], 500, []);
        }

        $listing = new Listing;
        $listing->fill($data);
        if (!$listing->save()) {
            return response()->json(['error' => 'Listing could not be created.'], 500, []);
        }

        foreach ($data['images'] as $image) {
            list($type, $imageData) = explode(';', $image['url']);
            list(, $imageData)      = explode(',', $imageData);

            $decodedImage = base64_decode($imageData);

            $imageName =  time() . '_' . $image['name'];
            $image_path = 'app/uploads/public/' . $imageName;

            file_put_contents(storage_path($image_path), $decodedImage);

            Image::create(['listing_id' => $listing->id, 'image_path' => $image_path]);
        }

        return response()->json([], 201, []);
    }
}