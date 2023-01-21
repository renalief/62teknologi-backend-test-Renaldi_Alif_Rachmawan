<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $param = 0;
        $id = $request->input('id');
        $matchThese = array();
        if ($id) {
            $matchThese = Arr::add($matchThese, 'id', $id);
            $param++;
        }

        $location = $request->input('location');
        if ($location) {
            $matchThese = Arr::add($matchThese, 'location', $location);
            $param++;
        }

        $latitude = $request->input('latitude');
        if ($latitude) {
            $matchThese = Arr::add($matchThese, 'latitude', $latitude);
            $param++;
        }

        $longitude = $request->input('longitude');
        if ($longitude) {
            $matchThese = Arr::add($matchThese, 'longitude', $longitude);
            $param++;
        }

        $term = $request->input('term');
        if ($term) {
            $matchThese = Arr::add($matchThese, 'term', $term);
            $param++;
        }

        $radius = $request->input('radius');
        if ($radius) {
            $matchThese = Arr::add($matchThese, 'radius', $radius);
            $param++;
        }

        $categories = $request->input('categories');
        if ($categories) {
            $matchThese = Arr::add($matchThese, 'categories', $categories);
            $param++;
        }

        $locale = $request->input('locale');
        if ($locale) {
            $matchThese = Arr::add($matchThese, 'locale', $locale);
            $param++;
        }

        $price = $request->input('price');
        if ($price) {
            $matchThese = Arr::add($matchThese, 'price', $price);
            $param++;
        }

        $open_now = $request->input('open_now');
        if ($open_now) {
            $matchThese = Arr::add($matchThese, 'open_now', $open_now);
            $param++;
        }

        $open_at = $request->input('open_at');
        if ($open_at) {
            $matchThese = Arr::add($matchThese, 'open_at', $open_at);
            $param++;
        }

        $attributes = $request->input('attributes');
        if ($attributes) {
            $matchThese = Arr::add($matchThese, 'attributes', $attributes);
            $param++;
        }

        $sort_by = $request->input('sort_by');
        if ($sort_by) {
            $matchThese = Arr::add($matchThese, 'sort_by', $sort_by);
            $param++;
        }

        $device_platform = $request->input('device_platform');
        if ($device_platform) {
            $matchThese = Arr::add($matchThese, 'device_platform', $device_platform);
            $param++;
        }

        $reservation_date = $request->input('reservation_date');
        if ($reservation_date) {
            $matchThese = Arr::add($matchThese, 'reservation_date', $reservation_date);
            $param++;
        }

        $reservation_time = $request->input('reservation_time');
        if ($reservation_time) {
            $matchThese = Arr::add($matchThese, 'reservation_time', $reservation_time);
            $param++;
        }

        $reservation_covers = $request->input('reservation_covers');
        if ($reservation_covers) {
            $matchThese = Arr::add($matchThese, 'reservation_covers', $reservation_covers);
            $param++;
        }

        $matches_party_size_param = $request->input('matches_party_size_param');
        if ($matches_party_size_param) {
            $matchThese = Arr::add($matchThese, 'matches_party_size_param', $matches_party_size_param);
            $param++;
        }

        $limit = $request->input('limit');
        if ($limit) {
            $matchThese = Arr::add($matchThese, 'limit', $limit);
            $param++;
        }

        $offset = $request->input('offset');
        if ($offset) {
            $matchThese = Arr::add($matchThese, 'offset', $offset);
            $param++;
        }

        if ($param >= 5) {
            $post = Post::where($matchThese)->first();
            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Detail Post!',
                    'data'    => $post
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Tidak Ditemukan!',
                    'data'    => ''
                ], 401);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Searching Membutuhkan Minimal 5 Parameter!',
                'data'    => ''
            ], 401);
        }
    }

    public function store(Request $request)
    {
        $id = Post::whereId($request->input('id'))->first();
        $required = $id == null ? "required" : "";

        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'location'                      => 'min:1|max:255',
                'latitude'                      => 'numeric|min:-90|max:90',
                'longitude'                     => 'numeric|min:-180|max:180',
                'radius'                        => 'numeric|min:0|max:40000',
                'categories'                    => "$required|min:1",
                'price'                         => "$required|numeric|min:1|max:4",
                'attributes'                    => "$required",
                'reservation_covers'            => 'numeric|min:1|max:10',
                'limit'                         => 'numeric|min:0|max:50',
                'offset'                        => 'numeric|min:0|max:1000',
            ],
            [
                'categories.required'                   => 'Masukkan Categories !',
                'price.required'                        => 'Masukkan Price !',
                'attributes.required'                   => 'Masukkan Attributes !',

                'location.min'                          => 'Location Kurang Dari Batas Minimum !',
                'latitude.min'                          => 'Latitude Kurang Dari Batas Minimum !',
                'longitude.min'                         => 'Longitude Kurang Dari Batas Minimum !',
                'radius.min'                            => 'Radius Kurang Dari Batas Minimum !',
                'categories.min'                        => 'Categories Kurang Dari Batas Minimum !',
                'price.min'                             => 'Price Kurang Dari Batas Minimum !',
                'reservation_covers.min'                => 'Reservation Covers Kurang Dari Batas Minimum !',
                'limit.min'                             => 'Limit Kurang Dari Batas Minimum !',
                'offset.min'                            => 'Offset Kurang Dari Batas Minimum !',

                'location.max'                          => 'Location Melebihi Batas Maximum !',
                'latitude.max'                          => 'Latitude Melebihi Batas Maximum !',
                'longitude.max'                         => 'Longitude Melebihi Batas Maximum !',
                'radius.max'                            => 'Radius Melebihi Batas Maximum !',
                'price.max'                             => 'Price Melebihi Batas Maximum !',
                'reservation_covers.max'                => 'Reservation Covers Melebihi Batas Maximum !',
                'limit.max'                             => 'Limit Melebihi Batas Maximum !',
                'offset.max'                            => 'Offset Melebihi Batas Maximum !',
            ]
        );

        $insertData = [
            'location'                  => $request->input('location'),
            'latitude'                  => $request->input('latitude'),
            'longitude'                 => $request->input('longitude'),
            'term'                      => $request->input('term'),
            'radius'                    => $request->input('radius'),
            'categories'                => $request->input('categories'),
            'locale'                    => $request->input('locale'),
            'price'                     => $request->input('price'),
            'open_now'                  => $request->input('open_now'),
            'open_at'                   => $request->input('open_at'),
            'attributes'                => $request->input('attributes'),
            'sort_by'                   => $request->input('sort_by'),
            'device_platform'           => $request->input('device_platform'),
            'reservation_date'          => $request->input('reservation_date'),
            'reservation_time'          => $request->input('reservation_time'),
            'reservation_covers'        => $request->input('reservation_covers'),
            'matches_party_size_param'  => $request->input('matches_party_size_param'),
            'limit'                     => $request->input('limit'),
            'offset'                    => $request->input('offset'),
        ];

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Data Yang Kosong',
                'data'    => $validator->errors()
            ], 401);
        } else {
            $post = Post::whereId($request->input('id'))->update($insertData);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Disimpan!',
                ], 200);
            } else {
                $post = Post::create($insertData);

                if ($post) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Post Berhasil Disimpan!',
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Post Gagal Disimpan!',
                    ], 401);
                }
            }
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Dihapus!',
            ], 400);
        }
    }
}
