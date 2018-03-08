<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class SearchController extends Controller
{

    public function search_city_address()
    {
        $address = request('address');
        $include = request('include');
        $centerLat = request('centerLat');
        $centerLng = request('centerLng');
        $neLat = request('neLat');
        $neLng = request('neLng');
        $center = $centerLat . ',' . $centerLng;
        $radiusraw = $this->haversineGreatCircleDistance($centerLat, $centerLng, $neLat, $neLng);
        // $radiusraw = $this->haversineGreatCircleDistance('41.308969', '19.810926','41.325019', '19.822760');
        $radius = round($radiusraw);
        $radiusf = round($radiusraw) * 1000;
        if ($include == 'true') {
            if ($address != '') {
                $offers = DB::select(DB::raw("SELECT DISTINCT offers.id_offer,offers.name,offers.address,offers.latitude, offers.longitude,(6371 * ACOS(COS(RADIANS('$centerLat')) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS('$centerLng')) + SIN(RADIANS('$centerLat')) * SIN(RADIANS(latitude)))) AS distance FROM offers JOIN photos ON photos.offer_id = offer.id_offer WHERE offers.active = 1  AND offers.address LIKE '%$address%' HAVING distance < '$radius'"));
                if ($offers) {
                    return $offers;
                } else {
                    return Response::json(["response" => "Error", "message" => "There are no results!"]);
                }
            } else {
                return Response::json(["response" => "Error", "message" => "Please insert a valid address!"]);
            }
        } else {
            if ($address != '') {
                $offers = DB::select(DB::raw("SELECT DISTINCT offers.id_offer, offers.name, offers.address, offers.latitude, offers.longitude, photos.photo FROM offers JOIN city ON city.id_city = offers.city_id JOIN photos ON photos.offer_id = offers.id_offer WHERE offers.active = 1 AND offers.address LIKE '%$address%'"));
                if ($offers) {
                    return $offers;
                } else {
                    return Response::json(["response" => "Error", "message" => "There are no results!"]);
                }
            } else {
                return Response::json(["response" => "Error", "message" => "Please insert a valid address!"]);
            }
        }

    }

    public function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    public function map()
    {
        $offers = Offer::where('latitude', '!=', '0')->where('longitude', '!=', '0')->get();
        return view('items.map', compact('offers'));
    }
    public function offers() {
        $offers = Offer::where('latitude', '!=', '0')->where('longitude', '!=', '0')->get();
        return $offers;
    }


    public function advanced_search(Request $request, Offer $offers)
    {
        $offer = $offers->newQuery();
        $include = $request->input('include');
        $newListing = $request->input('newListing');
        $centerLat = $request->input('centerLat');
        $centerLng = $request->input('centerLng');
        $neLat = $request->input('neLat');
        $neLng = $request->input('neLng');
        $sort = $request->input('sort');
        $showMap = $request->input('showMap');

        $center = $centerLat . ',' . $centerLng;
        $radiusraw = $this->haversineGreatCircleDistance($centerLat, $centerLng, $neLat, $neLng);
        $radius = round($radiusraw);
        $radiusf = round($radiusraw) * 1000;

        // Search for a offer based on their bedrooms.
        if ($request->has('bedroomsMin') || $request->has('bedroomMax')) {
            $bedroomMin = $request->input('bedroomsMin');
            $bedroomMax = $request->input('bedroomsMax');
            if ($bedroomMin != 'Any' && $bedroomMax != 'Any') {
                if ($bedroomMin == 'Any' && $bedroomMax != 'Any') {
                    $offer->where('bedrooms', '<=', $bedroomMax);
                } elseif ($bedroomMin != 'Any' && $bedroomMax == 'Any') {
                    $offer->where('bedrooms', '>=', $bedroomMin);
                } else {
                    $offer->where('bedrooms', '>=', $bedroomMin)->where('bedrooms', '<=', $bedroomMax);
                }
            }
        }

        //Search for an offer based on their property type
        if ($request->has('property_type')) {
            $property_type = $request->input('property_type');
            if ($property_type != '0') {
                if ($property_type == '1') $offer->where('type_id', '=', 7);
                elseif ($property_type == '2') $offer->whereBetween('type_id', [1, 6]);
                elseif ($property_type == '3') $offer->whereBetween('type_id', [7, 9]);
                elseif ($property_type == '4') $offer->where('type_id', '=', 9);
                elseif ($property_type == '5') $offer->where('type_id', '=', 10);
            }
        }

        // Search for a offer based on their price.
        if ($request->has('priceRngMin') || $request->has('priceRngMax')) {
            $priceRng1 = $request->input('priceRngMin');
            $priceRng2 = $request->input('priceRngMax');
            if ($priceRng1 != 'Any' || $priceRng2 != 'Any') {
                if ($priceRng1 == 'Any' && $priceRng2 != 'Any') {
                    $offer->where('euro', '<=', $priceRng2);
                } elseif ($priceRng1 != 'Any' && $priceRng2 == 'Any') {
                    $offer->where('euro', '>=', $priceRng1);
                } else {
                    $offer->where('euro', '>=', $priceRng1)->where('euro', '<=', $priceRng2);
                }
            }
        }

        // Search for a offer based on their bathrooms.
        if ($request->has('bathrooms')) {
            $bathroom = $request->input('bathrooms');
            $offer->where('bathrooms', '=>', $bathroom);
        }

        // Search for a offer based on their parking spaces.
        if ($request->has('parking_spaces')) {
            $parking = $request->input('parking_spaces');
            if ($parking != 'Any') {
                $offer->where('parking_space', '>=', $parking);
            }
        }

        if ($newListing == 1) {
          $date = date("Y-m-d H:i:s", strtotime("-1 week"));
          $offer->where('offers.created_at', '>', $date);
        }

        if ($include == 0) {
            $offer->join('types', 'types.id_types', '=', 'offers.type_id')
                ->select('offers.*', 'types.type', DB::raw('(6371 * ACOS(COS(RADIANS(' . $centerLat . ')) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS(' . $centerLng . ')) + SIN(RADIANS(' . $centerLat . ')) * SIN(RADIANS(latitude)))) AS distance'))
                ->having('distance', '<', $radius);
        } else if ($include == 1) {
            $radiusInc = 1.5 * $radius;
            $offer->join('types', 'types.id_types', '=', 'offers.type_id')
                ->select('offers.*', 'types.type', DB::raw('(6371 * ACOS(COS(RADIANS(' . $centerLat . ')) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS(' . $centerLng . ')) + SIN(RADIANS(' . $centerLat . ')) * SIN(RADIANS(latitude)))) AS distance '))
                ->having('distance', '<', $radiusInc);
        }


        if($sort == 'address' ){
          $offer->orderBy('address', 'ASC');
        }elseif ($sort == 'lowest' ) {
          $offer->orderBy('euro', 'ASC');
        }elseif ($sort == 'highest' ) {
          $offer->orderBy('euro','DESC');
        }elseif ($sort == 'newest' ){
          $offer->orderBy('created_at', 'DESC');
        }elseif($sort == 'oldest' ){
          $offer->orderBy('created_at', 'ASC');
        }

        // Get the results and return them.
        $offers = $offer->with('photos')->where('offers.active', '=', 1);
        $counter = $offers->get();
        $count = count($counter);

        if($showMap == 'map'){
            $data['offer'] = $offer->get();
            $data['count'] = $count;
            return $data ;
        } else {
            $data['offer'] = $offer->simplePaginate(20);
            $data['count'] = $count;
            return $data ;
        }
    }

    public function nearby_properties(Request $request, $offer_id) {
      $offer = Offer::where('id_offer', '=', $offer_id)->first();
      $centerLat = $offer->latitude;
      $centerLng = $offer->longitude;
      $center = $centerLat . ',' . $centerLng;
      $offer = Offer::join('types', 'types.id_types', '=', 'offers.type_id')
      ->select('offers.*', 'types.type', DB::raw('(6371 * ACOS(COS(RADIANS(' . $centerLat . ')) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS(' . $centerLng . ')) + SIN(RADIANS(' . $centerLat . ')) * SIN(RADIANS(latitude)))) AS distance '))
      ->having('distance', '<', 0.5)->where('offers.active', '=', 1)->where('id_offer', '!=', $offer_id)->with('photos')->limit(4)->get();
      return $offer;
    }

}
