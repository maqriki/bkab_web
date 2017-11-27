<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Katalog\Kategori;
use App\Models\Product\Product;
use App\Models\Product\ProductExclude;
use App\Models\Product\ProductInclude;
use App\Models\Product\ProductSchedule;
use App\Models\Product\ProductMedia;

use App\Models\Katalog\LokasiWisata;
use App\Models\Katalog\LokasiFasilitas;
use App\Models\Katalog\LokasiMedia;


use App\Models\Katalog\PaketWisata;
use App\Models\Katalog\PaketWisataFasilitas;
use App\Models\Katalog\PaketWisataMedia;
use App\Models\Katalog\PaketWisataExclude;
use App\Models\Katalog\PaketWisataItenarary;
use App\Models\Katalog\PaketWisataLokasi;

use App\Models\Ticketing\Ticket;
use App\Models\Ticketing\TicketOrdered;
use App\Models\Ticketing\TicketingHarga;
use App\Models\Ticketing\TicketingKendaraan;

use App\Models\Ticketing\UserTicketing;
use App\Models\Ticketing\TicketOrder;
use App\Models\Ticketing\TicketDetailOrder;

use App\Models\Member\Guide;

use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AllAdminController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
    return view('administrator.dashboard');
  }

  // ==============================================================================
  // Katalog
  // ============================================================================== 

    // kategori
      public function katIndex()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $type='index';
        $kat=Kategori::all();
        return view('administrator.katalog.kategori.index')
                  ->with('type', $type)
                  ->with('kat', $kat);
      }

      public function katStore(Request $request)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $table=new Kategori();
        $table->kat_name=$request['namaKategori'];
        $table->kat_description=$request['deskripsiKategori'];
        $table->kat_status=1;
        $table->save();

        return redirect()->to('/a/admin/kategori');
      }
      
      public function katEdit($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $edit=Kategori::find($id);
        $type='edit';
        $kat=Kategori::all();
        return view('administrator.katalog.kategori.index')
                  ->with('edit', $edit)
                  ->with('type', $type)
                  ->with('kat', $kat);
      }

      public function katUpdate(Request $request, $id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $table=Kategori::find($id);
        $table->kat_name=$request['namaKategori'];
        $table->kat_description=$request['deskripsiKategori'];
        $table->kat_status=1;
        $table->update();

        return redirect()->to('/a/admin/kategori');
      }

    // Product
      public function prodIndex()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = Product::where('prod_type', '=', 'Location')->get();
        return view('administrator.katalog.product.index')
                ->with('data', $data);
      }
      public function prodCreate()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        return view('administrator.katalog.product.create')
                ->with('kategori', $kategori);
      }
      public function prodStore(Request $request)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $unique = md5(Carbon::now());
        $preSlug =Str::slug($request['name']);
        $newSlug=$preSlug;

        $check = Product::all();
        $i=0;
        foreach ($check as $key) {
          if ($newSlug==$key->product_slug) {
            $newSlug = $newSlug.'-'.$i;$i++;
            if ($newSlug==$key->product_slug) {
              $newSlug = $newSlug.'-'.$i;$i++;
            }
          }
        }

        $product = new Product();
        $product->prod_id=$unique;
        $product->prod_type='Location';
        $product->prod_name=$request['name'];
        $product->prod_description=$request['description'];
        $product->prod_category=$request['category'];
        $product->prod_location=$request['location'];
        $product->prod_address=$request['address'];
        $product->prod_lat=$request['lat'];
        $product->prod_long=$request['long'];
        $product->prod_price_usd=$request['p_usd'];
        $product->prod_price_idr=$request['p_idr'];
        $product->prod_retrib_usd=$request['r_usd'];
        $product->prod_retrib_idr=$request['r_idr'];
        $product->prod_tp_usd=$request['tp_usd'];
        $product->prod_tp_idr=$request['tp_idr'];
        $product->prod_slug=$newSlug;
        $product->prod_status=1;
        $product->save();

        # schedule 
        for ($i=0; $i < 100; $i++) { 
          if (!empty($request['sch-des'.$i]) && !empty($request['sch-time'.$i])) {
            $include = new ProductSchedule ();
            $include->prod_id=$unique;
            $include->psch_description=$request['sch-des'.$i];
            $include->psch_time=$request['sch-time'.$i];
            $include->save();
          }
        }

        # inlcude 
        foreach ($request['incl'] as $values) {
          if (!empty($values)) {
            $include = new ProductInclude ();
            $include->prod_id=$unique;
            $include->pincl_description=$values;
            $include->save();
          }
        }

        # exclude 
        foreach ($request['exc'] as $values) {
          if (!empty($values)) {
            $exclude = new ProductExclude ();
            $exclude->prod_id=$unique;
            $exclude->pexcl_description=$values;
            $exclude->save();
          }
        }


        return redirect()->to('a/admin/product');
      }
      public function prodShow($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        $data = Product::where('prod_id', '=', $id)->first();
        $schedule = ProductSchedule::where('prod_id', '=', $id)->get();
        $include = ProductInclude::where('prod_id', '=', $id)->get();
        $exclude = ProductExclude::where('prod_id', '=', $id)->get();
        return view('administrator.katalog.product.show')
                ->with('data', $data)
                ->with('schedule', $schedule)
                ->with('include', $include)
                ->with('exclude', $exclude)
                ->with('kategori', $kategori);
      }
      public function prodEdit($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        $data = Product::where('prod_id', '=', $id)->first();
        $schedule = ProductSchedule::where('prod_id', '=', $id)->get();
        $include = ProductInclude::where('prod_id', '=', $id)->get();
        $exclude = ProductExclude::where('prod_id', '=', $id)->get();
        return view('administrator.katalog.product.edit')
                ->with('data', $data)
                ->with('schedule', $schedule)
                ->with('include', $include)
                ->with('exclude', $exclude)
                ->with('kategori', $kategori);
      }
      public function prodUpdate(Request $request, $id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $unique = md5(Carbon::now());
        $preSlug =Str::slug($request['name']);
        $newSlug=$preSlug;

        $check = Product::all();
        $i=0;
        foreach ($check as $key) {
          if ($newSlug==$key->product_slug) {
            $newSlug = $newSlug.'-'.$i;$i++;
            if ($newSlug==$key->product_slug) {
              $newSlug = $newSlug.'-'.$i;$i++;
            }
          }
        }

        $product = Product::where('prod_id','=', $id)->first();
        $product->prod_name=$request['name'];
        $product->prod_description=$request['description'];
        $product->prod_category=$request['category'];
        $product->prod_location=$request['location'];
        $product->prod_address=$request['address'];
        $product->prod_lat=$request['lat'];
        $product->prod_long=$request['long'];
        $product->prod_price_usd=$request['p_usd'];
        $product->prod_price_idr=$request['p_idr'];
        $product->prod_retrib_usd=$request['r_usd'];
        $product->prod_retrib_idr=$request['r_idr'];
        $product->prod_tp_usd=$request['tp_usd'];
        $product->prod_tp_idr=$request['tp_idr'];
        $product->prod_slug=$newSlug;
        $product->prod_status=1;
        $product->update();

        # schedule
        $schDel=ProductSchedule::where('prod_id', '=', $id)->get();
        foreach ($schDel as $schDel) {
          $schDel->delete();
        }
        for ($i=0; $i < 100; $i++) { 
          if (!empty($request['sch-des'.$i]) && !empty($request['sch-time'.$i])) {
            $schedule = new ProductSchedule();
            $schedule->prod_id=$id;
            $schedule->psch_description=$request['sch-des'.$i];
            $schedule->psch_time=$request['sch-time'.$i];
            $schedule->save();
          }
        }

        # inlcude 
        $incDel=ProductInclude::where('prod_id', '=', $id)->get();
        foreach ($incDel as $incDel) {
          $incDel->delete();
        }
        foreach ($request['incl'] as $values) {
          if (!empty($values)) {
            $include = new ProductInclude();
            $include->prod_id=$id;
            $include->pincl_description=$values;
            $include->save();
          }
        }

        # exclude 
        $excDel=ProductExclude::where('prod_id', '=', $id)->get();
        foreach ($excDel as $excDel) {
          $excDel->delete();
        }
        foreach ($request['exc'] as $values) {
          if (!empty($values)) {
            $exclude = new ProductExclude();
            $exclude->prod_id=$id;
            $exclude->pexcl_description=$values;
            $exclude->save();
          }
        }


        return redirect()->to('a/admin/product');
      }
      public function prodDestroy($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $product = Product::where('prod_id','=', $id)->first();
        $product->delete();

        # schedule
        $schDel=ProductSchedule::where('prod_id', '=', $id)->get();
        foreach ($schDel as $schDel) {
          $schDel->delete();
        }

        # inlcude 
        $incDel=ProductInclude::where('prod_id', '=', $id)->get();
        foreach ($incDel as $incDel) {
          $incDel->delete();
        }

        # exclude 
        $excDel=ProductExclude::where('prod_id', '=', $id)->get();
        foreach ($excDel as $excDel) {
          $excDel->delete();
        }

        return redirect()->to('a/admin/product');
      }

    // Product Special Event
      public function pwIndex()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        // $paket = DB::table('paket_wisatas')
        //     ->join('paket_wisata_lokasis', 'paket_wisatas.pw_id', '=', 'paket_wisata_lokasis.pw_id')
        //     ->join('lokasi_wisata', 'paket_wisata_lokasis.lokasi_id', '=', 'lokasi_wisata.lokasi_id')
        //     ->select('paket_wisatas.*', 'lokasi_wisata.lokasi_name')
        //     ->get();
        $paket = PaketWisata::all();
        return view('administrator.katalog.paket-wisata.index')
                  ->with('paket', $paket);
      }
      public function pwCreate()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        $wisata = LokasiWisata::all();
        return view('administrator.katalog.paket-wisata.create')
                ->with('wisata', $wisata)
                ->with('kategori', $kategori);
      }
      public function pwStore(Request $request)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $uid=md5(Carbon::now());
        $check = PaketWisata::all();
        $jmlLokasi=0;

        $preSlug =Str::slug($request['pw_name']);
        $newSlug=$preSlug;
        $i=0;
        foreach ($check as $key) {
          if ($newSlug==$key->pw_slug) {
              $newSlug = $newSlug.'-'.$i;$i++;
            if ($newSlug==$key->pw_slug) {
              $newSlug = $newSlug.'-'.$i;$i++;
            }
          }
        }

        $pw= new PaketWisata();
        $pw->pw_id=$uid;
        $pw->pw_name=$request['pw_name'];
        $pw->pw_description=$request['pw_description'];
        $pw->pw_category=$request['pw_category'];
        $pw->pw_price_usd=$request['pw_usd'];
        $pw->pw_price_idr=$request['pw_idr'];
        // $pw->pw_pw_total_location=$request['pw_'];
        $pw->pw_start=$request['pw_start'];
        $pw->pw_end=$request['pw_end'];
        $pw->pw_duration=$request['pw_duration'];
        // $pw->pw_url_image=$request['pw_'];
        // $pw->pw_url_video=$request['pw_'];
        $pw->pw_slug=$newSlug;
        $pw->pw_status=1;
        $pw->save();

        foreach ($request['lokasiW'] as $lok) {
          $paketLok = new PaketWisataLokasi();
          $paketLok->pw_id=$uid;
          $paketLok->lokasi_id=$lok;
          $paketLok->save();
        }

        foreach ($request['pwi_now'] as $value) {
          if (!empty($request['pwi_des'.$value])){
            $pwi = new PaketWisataItenarary();
            $pwi->pw_id=$uid;
            $pwi->pwi_itenerary=$request['pwi_des'.$value];
            $pwi->pwi_description_1=$request['pwi_time'.$value];
            $pwi->pwi_description_2=$request['pwi_dur'.$value];
            $pwi->save();
          }
        }

        foreach ($request['fas_now'] as $key=>$values) {
          if (!empty($request['fas'.$values])) {
            $pwf = new PaketWisataFasilitas();
            $pwf->pw_id=$uid;
            $pwf->pwf_fasilitas=$request['fas'.$values];
            $pwf->pwf_description_1=$request['fas_1des'.$key];
            $pwf->pwf_description_2=$request['fas_2des'.$key];
            $pwf->save();
          }
        }

        foreach ($request['exc'] as $key=>$valus) {
          if (!empty($valus)) {
            $pwe = new PaketWisataExclude();
            $pwe->pw_id=$uid;
            $pwe->pwe_exclude=$valus;
            $pwe->save();
          }
        }

        return redirect()->to('a/admin/paket-wisata');

      }

      public function prodEIndex()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = Product::where('prod_type', '=', 'Special Event')->get();
        return view('administrator.katalog.product-event.index')
                ->with('data', $data);
      }
      public function prodECreate()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        return view('administrator.katalog.product-event.create')
                ->with('kategori', $kategori);
      }
      public function prodEStore(Request $request)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $start_ = $request['prod_start'];
        $_start = str_replace('/', '-', $start_);
        $start =date('Y-m-d', strtotime($_start));

        $end_ = $request['prod_end'];
        $_end = str_replace('/', '-', $end_);
        $end =date('Y-m-d', strtotime($_end));

        $unique = md5(Carbon::now());
        $preSlug =Str::slug($request['name']);
        $newSlug=$preSlug;

        $check = Product::all();
        $i=0;
        foreach ($check as $key) {
          if ($newSlug==$key->product_slug) {
            $newSlug = $newSlug.'-'.$i;$i++;
            if ($newSlug==$key->product_slug) {
              $newSlug = $newSlug.'-'.$i;$i++;
            }
          }
        }

        $product = new Product();
        $product->prod_id=$unique;
        $product->prod_type='Special Event';
        $product->prod_name=$request['name'];
        $product->prod_description=$request['description'];
        $product->prod_category=$request['category'];
        $product->prod_location=$request['location'];
        $product->prod_address=$request['address'];
        $product->prod_start_date=$request['prod_start'];
        $product->prod_end_date=$request['prod_end'];
        $product->prod_start=$start;
        $product->prod_end=$end;
        $product->prod_lat=$request['lat'];
        $product->prod_long=$request['long'];
        $product->prod_price_usd=$request['p_usd'];
        $product->prod_price_idr=$request['p_idr'];
        $product->prod_retrib_usd=$request['r_usd'];
        $product->prod_retrib_idr=$request['r_idr'];
        $product->prod_tp_usd=$request['tp_usd'];
        $product->prod_tp_idr=$request['tp_idr'];
        $product->prod_slug=$newSlug;
        $product->prod_status=1;
        $product->save();

        # schedule 
        for ($i=0; $i < 100; $i++) { 
          if (!empty($request['sch-des'.$i]) && !empty($request['sch-time'.$i])) {
            $include = new ProductSchedule ();
            $include->prod_id=$unique;
            $include->psch_description=$request['sch-des'.$i];
            $include->psch_time=$request['sch-time'.$i];
            $include->save();
          }
        }

        # inlcude 
        foreach ($request['incl'] as $values) {
          if (!empty($values)) {
            $include = new ProductInclude ();
            $include->prod_id=$unique;
            $include->pincl_description=$values;
            $include->save();
          }
        }

        # exclude 
        foreach ($request['exc'] as $values) {
          if (!empty($values)) {
            $exclude = new ProductExclude ();
            $exclude->prod_id=$unique;
            $exclude->pexcl_description=$values;
            $exclude->save();
          }
        }


        return redirect()->to('a/admin/product-event');
      }
      public function prodEShow($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        $data = Product::where('prod_id', '=', $id)->first();
        $schedule = ProductSchedule::where('prod_id', '=', $id)->get();
        $include = ProductInclude::where('prod_id', '=', $id)->get();
        $exclude = ProductExclude::where('prod_id', '=', $id)->get();
        return view('administrator.katalog.product-event.show')
                ->with('data', $data)
                ->with('schedule', $schedule)
                ->with('include', $include)
                ->with('exclude', $exclude)
                ->with('kategori', $kategori);
      }
      public function prodEEdit($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        $data = Product::where('prod_id', '=', $id)->first();
        $schedule = ProductSchedule::where('prod_id', '=', $id)->get();
        $include = ProductInclude::where('prod_id', '=', $id)->get();
        $exclude = ProductExclude::where('prod_id', '=', $id)->get();
        return view('administrator.katalog.product-event.edit')
                ->with('data', $data)
                ->with('schedule', $schedule)
                ->with('include', $include)
                ->with('exclude', $exclude)
                ->with('kategori', $kategori);
      }
      public function prodEUpdate(Request $request, $id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $start_ = $request['prod_start'];
        $_start = str_replace('/', '-', $start_);
        $start =date('Y-m-d', strtotime($_start));

        $end_ = $request['prod_end'];
        $_end = str_replace('/', '-', $end_);
        $end =date('Y-m-d', strtotime($_end));

        $unique = md5(Carbon::now());
        $preSlug =Str::slug($request['name']);
        $newSlug=$preSlug;

        $check = Product::all();
        $i=0;
        foreach ($check as $key) {
          if ($newSlug==$key->product_slug) {
            $newSlug = $newSlug.'-'.$i;$i++;
            if ($newSlug==$key->product_slug) {
              $newSlug = $newSlug.'-'.$i;$i++;
            }
          }
        }

        $product = Product::where('prod_id','=', $id)->first();
        $product->prod_name=$request['name'];
        $product->prod_description=$request['description'];
        $product->prod_category=$request['category'];
        $product->prod_location=$request['location'];
        $product->prod_address=$request['address'];
        $product->prod_start_date=$request['prod_start'];
        $product->prod_end_date=$request['prod_end'];
        $product->prod_start=$start;
        $product->prod_end=$end;
        $product->prod_lat=$request['lat'];
        $product->prod_long=$request['long'];
        $product->prod_price_usd=$request['p_usd'];
        $product->prod_price_idr=$request['p_idr'];
        $product->prod_retrib_usd=$request['r_usd'];
        $product->prod_retrib_idr=$request['r_idr'];
        $product->prod_tp_usd=$request['tp_usd'];
        $product->prod_tp_idr=$request['tp_idr'];
        $product->prod_slug=$newSlug;
        $product->prod_status=1;
        $product->update();

        # schedule
        $schDel=ProductSchedule::where('prod_id', '=', $id)->get();
        foreach ($schDel as $schDel) {
          $schDel->delete();
        }
        for ($i=0; $i < 100; $i++) { 
          if (!empty($request['sch-des'.$i]) && !empty($request['sch-time'.$i])) {
            $schedule = new ProductSchedule();
            $schedule->prod_id=$id;
            $schedule->psch_description=$request['sch-des'.$i];
            $schedule->psch_time=$request['sch-time'.$i];
            $schedule->save();
          }
        }

        # inlcude 
        $incDel=ProductInclude::where('prod_id', '=', $id)->get();
        foreach ($incDel as $incDel) {
          $incDel->delete();
        }
        foreach ($request['incl'] as $values) {
          if (!empty($values)) {
            $include = new ProductInclude();
            $include->prod_id=$id;
            $include->pincl_description=$values;
            $include->save();
          }
        }

        # exclude 
        $excDel=ProductExclude::where('prod_id', '=', $id)->get();
        foreach ($excDel as $excDel) {
          $excDel->delete();
        }
        foreach ($request['exc'] as $values) {
          if (!empty($values)) {
            $exclude = new ProductExclude();
            $exclude->prod_id=$id;
            $exclude->pexcl_description=$values;
            $exclude->save();
          }
        }


        return redirect()->to('a/admin/product-event');
      }
      public function prodEDestroy($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $product = Product::where('prod_id','=', $id)->first();
        $product->delete();

        # schedule
        $schDel=ProductSchedule::where('prod_id', '=', $id)->get();
        foreach ($schDel as $schDel) {
          $schDel->delete();
        }

        # inlcude 
        $incDel=ProductInclude::where('prod_id', '=', $id)->get();
        foreach ($incDel as $incDel) {
          $incDel->delete();
        }

        # exclude 
        $excDel=ProductExclude::where('prod_id', '=', $id)->get();
        foreach ($excDel as $excDel) {
          $excDel->delete();
        }
        return redirect()->to('a/admin/product-event');
      }

    // Product Paket Wisata
      public function prodPIndex()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = Product::where('prod_type', '=', 'Special Event')->get();
        return view('administrator.katalog.product-paket.index')
                ->with('data', $data);
      }
      public function prodPCreate()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        $lokasi = Product::all();
        return view('administrator.katalog.paket-wisata.create')
                ->with('lokasi', $lokasi)
                ->with('kategori', $kategori);
      }
      public function prodPStore(Request $request)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        // foreach ($request['data-wisata'] as $key) {
        //   echo $key."<br>";
        // }
        $result = Product::query();
        foreach ($request['data-wisata'] as $key) {
          $result = $result->orWhere('prod_id','=', $key);
        }
        // if (!empty($request['cat'])) {
        //     $result = $result->where('item_category', $request['cat']);
        // }
        $result = $result->get();
        // dd($result);
        // echo $result;

        return view('administrator.katalog.product-paket.create-2')
                ->with('result', $result);
      }

    // ================================================================================
    // Katalog Lokasi 
    // ================================================================================

      public function wisataIndex()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = LokasiWisata::where('lokasi_type', '=', 'Location')->get();
        return view('administrator.katalog.wisata.index')
                ->with('data', $data);
      }
      public function wisataCreate()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        return view('administrator.katalog.wisata.create')
                ->with('kategori', $kategori);
      }
      public function wisataStore(Request $request)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $unique = md5(Carbon::now());
        $preSlug =Str::slug($request['name']);
        $newSlug=$preSlug;

        $check = LokasiWisata::all();
        $i=0;
        foreach ($check as $key) {
          if ($newSlug==$key->lokasi_slug) {
            $newSlug = $newSlug.'-'.$i;$i++;
            if ($newSlug==$key->lokasi_slug) {
              $newSlug = $newSlug.'-'.$i;$i++;
            }
          }
        }

        $product = new LokasiWisata();
        $product->lokasi_id=$unique;
        $product->lokasi_type='Location';
        $product->lokasi_name=$request['name'];
        $product->lokasi_description=$request['description'];
        $product->lokasi_category=$request['category'];
        $product->lokasi_location=$request['location'];
        $product->lokasi_address=$request['address'];
        $product->lokasi_lat=$request['lat'];
        $product->lokasi_long=$request['long'];
        $product->lokasi_slug=$newSlug;
        $product->lokasi_status=1;
        $product->save();

        # schedule 
        for ($i=0; $i < 100; $i++) { 
          if (!empty($request['sch-des'.$i]) && !empty($request['sch-time'.$i])) {
            $include = new LokasiFasilitas ();
            $include->lokasi_id=$unique;
            $include->fasilitas=$request['sch-des'.$i];
            $include->fasilitas_keterangan=$request['sch-time'.$i];
            $include->save();
          }
        }


        return redirect()->to('a/admin/wisata');
      }
      public function wisataShow($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        $data = LokasiWisata::where('lokasi_id', '=', $id)->first();
        $schedule = LokasiFasilitas::where('lokasi_id', '=', $id)->get();
        return view('administrator.katalog.wisata.show')
                ->with('data', $data)
                ->with('schedule', $schedule)
                ->with('kategori', $kategori);
      }
      public function wisataEdit($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        $data = LokasiWisata::where('lokasi_id', '=', $id)->first();
        $schedule = LokasiFasilitas::where('lokasi_id', '=', $id)->get();
        return view('administrator.katalog.wisata.edit')
                ->with('data', $data)
                ->with('schedule', $schedule)
                ->with('kategori', $kategori);
      }
      public function wisataUpdate(Request $request, $id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $unique = md5(Carbon::now());
        $preSlug =Str::slug($request['name']);
        $newSlug=$preSlug;

        $check = LokasiWisata::all();
        $i=0;
        foreach ($check as $key) {
          if ($newSlug==$key->lokasi_slug) {
            $newSlug = $newSlug.'-'.$i;$i++;
            if ($newSlug==$key->lokasi_slug) {
              $newSlug = $newSlug.'-'.$i;$i++;
            }
          }
        }

        $product = LokasiWisata::where('lokasi_id','=', $id)->first();
        $product->lokasi_type='Location';
        $product->lokasi_name=$request['name'];
        $product->lokasi_description=$request['description'];
        $product->lokasi_category=$request['category'];
        $product->lokasi_location=$request['location'];
        $product->lokasi_address=$request['address'];
        $product->lokasi_lat=$request['lat'];
        $product->lokasi_long=$request['long'];
        $product->lokasi_slug=$newSlug;
        $product->lokasi_status=1;
        $product->update();

        # schedule
        $schDel=LokasiFasilitas::where('lokasi_id', '=', $id)->get();
        foreach ($schDel as $schDel) {
          $schDel->delete();
        }
        for ($i=0; $i < 100; $i++) { 
          if (!empty($request['sch-des'.$i]) && !empty($request['sch-time'.$i])) {
            $schedule = new LokasiFasilitas();
            $schedule->lokasi_id=$id;
            $schedule->fasilitas=$request['sch-des'.$i];
            $schedule->fasilitas_keterangan=$request['sch-time'.$i];
            $schedule->save();
          }
        }


        return redirect()->to('a/admin/wisata');
      }
      public function wisataDestroy($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $product = Product::where('prod_id','=', $id)->first();
        $product->delete();

        # schedule
        $schDel=ProductSchedule::where('prod_id', '=', $id)->get();
        foreach ($schDel as $schDel) {
          $schDel->delete();
        }

        # inlcude 
        $incDel=ProductInclude::where('prod_id', '=', $id)->get();
        foreach ($incDel as $incDel) {
          $incDel->delete();
        }

        # exclude 
        $excDel=ProductExclude::where('prod_id', '=', $id)->get();
        foreach ($excDel as $excDel) {
          $excDel->delete();
        }

        return redirect()->to('a/admin/wisata');
      }

      public function eventWindex()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = LokasiWisata::where('lokasi_type', '=', 'Special Event')->get();
        return view('administrator.katalog.wisata-event.index')
                ->with('data', $data);
      }
      public function eventWcreate()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        return view('administrator.katalog.wisata-event.create')
                ->with('kategori', $kategori);
      }
      public function eventWstore(Request $request)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $unique = md5(Carbon::now());
        $preSlug =Str::slug($request['name']);
        $newSlug=$preSlug;

        $check = LokasiWisata::all();
        $i=0;
        foreach ($check as $key) {
          if ($newSlug==$key->lokasi_slug) {
            $newSlug = $newSlug.'-'.$i;$i++;
            if ($newSlug==$key->lokasi_slug) {
              $newSlug = $newSlug.'-'.$i;$i++;
            }
          }
        }

        $product = new LokasiWisata();
        $product->lokasi_id=$unique;
        $product->lokasi_type='Special Event';
        $product->lokasi_name=$request['name'];
        $product->lokasi_description=$request['description'];
        $product->lokasi_category=$request['category'];
        $product->lokasi_location=$request['location'];
        $product->lokasi_address=$request['address'];
        $product->lokasi_start=$request['start'];
        $product->lokasi_end=$request['end'];
        $product->lokasi_lat=$request['lat'];
        $product->lokasi_long=$request['long'];
        $product->lokasi_slug=$newSlug;
        $product->lokasi_status=1;
        $product->save();

        # schedule 
        for ($i=0; $i < 100; $i++) { 
          if (!empty($request['sch-des'.$i]) && !empty($request['sch-time'.$i])) {
            $include = new LokasiFasilitas ();
            $include->lokasi_id=$unique;
            $include->fasilitas=$request['sch-des'.$i];
            $include->fasilitas_keterangan=$request['sch-time'.$i];
            $include->save();
          }
        }


        return redirect()->to('a/admin/event-wisata');
      }
      public function eventWshow($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        $data = LokasiWisata::where('lokasi_id', '=', $id)->first();
        $schedule = LokasiFasilitas::where('lokasi_id', '=', $id)->get();
        return view('administrator.katalog.wisata-event.show')
                ->with('data', $data)
                ->with('schedule', $schedule)
                ->with('kategori', $kategori);
      }
      public function eventWedit($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $kategori = Kategori::all();
        $data = LokasiWisata::where('lokasi_id', '=', $id)->first();
        $schedule = LokasiFasilitas::where('lokasi_id', '=', $id)->get();
        return view('administrator.katalog.wisata-event.edit')
                ->with('data', $data)
                ->with('schedule', $schedule)
                ->with('kategori', $kategori);
      }
      public function eventWupdate(Request $request, $id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $unique = md5(Carbon::now());
        $preSlug =Str::slug($request['name']);
        $newSlug=$preSlug;

        $check = LokasiWisata::all();
        $i=0;
        foreach ($check as $key) {
          if ($newSlug==$key->lokasi_slug) {
            $newSlug = $newSlug.'-'.$i;$i++;
            if ($newSlug==$key->lokasi_slug) {
              $newSlug = $newSlug.'-'.$i;$i++;
            }
          }
        }

        $product = LokasiWisata::where('lokasi_id','=', $id)->first();
        $product->lokasi_name=$request['name'];
        $product->lokasi_description=$request['description'];
        $product->lokasi_category=$request['category'];
        $product->lokasi_location=$request['location'];
        $product->lokasi_address=$request['address'];
        $product->lokasi_start=$request['start'];
        $product->lokasi_end=$request['end'];
        $product->lokasi_lat=$request['lat'];
        $product->lokasi_long=$request['long'];
        $product->lokasi_slug=$newSlug;
        $product->lokasi_status=1;
        $product->update();

        # schedule
        $schDel=LokasiFasilitas::where('lokasi_id', '=', $id)->get();
        foreach ($schDel as $schDel) {
          $schDel->delete();
        }
        for ($i=0; $i < 100; $i++) { 
          if (!empty($request['sch-des'.$i]) && !empty($request['sch-time'.$i])) {
            $schedule = new LokasiFasilitas();
            $schedule->lokasi_id=$id;
            $schedule->fasilitas=$request['sch-des'.$i];
            $schedule->fasilitas_keterangan=$request['sch-time'.$i];
            $schedule->save();
          }
        }


        return redirect()->to('a/admin/event-wisata');
      }
      public function eventWdestroy($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $product = Product::where('prod_id','=', $id)->first();
        $product->delete();

        # schedule
        $schDel=ProductSchedule::where('prod_id', '=', $id)->get();
        foreach ($schDel as $schDel) {
          $schDel->delete();
        }

        # inlcude 
        $incDel=ProductInclude::where('prod_id', '=', $id)->get();
        foreach ($incDel as $incDel) {
          $incDel->delete();
        }

        # exclude 
        $excDel=ProductExclude::where('prod_id', '=', $id)->get();
        foreach ($excDel as $excDel) {
          $excDel->delete();
        }

        return redirect()->to('a/admin/product');
      }

  // ==================================================================================
  // Ticketing 
  // ==================================================================================

    // Ticket
      public function ticketIndex()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = LokasiWisata::all();
        return view('administrator.ticketing.retribusi.index')
                ->with('data', $data);
      }
      public function ticketCreate($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = LokasiWisata::where('lokasi_id', '=', $id)->first();
        if ($data->status_retribusi==0) {
         return view('administrator.ticketing.retribusi.create')
                ->with('data', $data);
        }else{
          return redirect()->to('/a/admin/ticketing/edit/'.$id);
        }
        
      }
      public function ticketStore(Request $request, $id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $ticket= new TicketingHarga();
        $ticket->lokasi_id=$id;
        $ticket->nama_lokasi=$request['lokasi'];
        $ticket->harga_dewasa=$request['dewasa'];
        $ticket->harga_anak=$request['anak'];
        $ticket->harga_bus_besar=$request['busBesar'];
        $ticket->harga_bus_kecil=$request['bus'];
        $ticket->harga_mobil=$request['mobil'];
        $ticket->harga_motor=$request['motor'];
        $ticket->save();

        $lokasi=LokasiWisata::where('lokasi_id', '=', $id)->first();
        if (!empty($request['dewasa']) && !empty($request['anak']) && !empty($request['busBesar']) && !empty($request['bus']) && !empty($request['mobil']) && !empty($request['motor'])) {
          $lokasi->status_retribusi=2;
          $lokasi->update();
        }elseif (empty($request['dewasa']) || empty($request['anak']) || empty($request['busBesar']) || empty($request['bus']) || empty($request['mobil']) || empty($request['motor'])) {
          $lokasi->status_retribusi=1;
          $lokasi->update();
        }else{
          $lokasi->status_retribusi=0;
          $lokasi->update();
        }

        return redirect()->to('/a/admin/ticketing');
      }
      public function ticketShow($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = LokasiWisata::where('lokasi_id', '=', $id)->first();
        $retribusi = TicketingHarga::where('lokasi_id', '=', $id)->first();
        return view('administrator.ticketing.retribusi.edit')
                ->with('data', $data)
                ->with('retribusi', $retribusi);
      }
      public function ticketEdit($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = LokasiWisata::where('lokasi_id', '=', $id)->first();
        $retribusi = TicketingHarga::where('lokasi_id', '=', $id)->first();
        return view('administrator.ticketing.retribusi.edit')
                ->with('data', $data)
                ->with('retribusi', $retribusi);
      }
      public function ticketUpdate(Request $request, $id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $ticket= TicketingHarga::where('lokasi_id', '=', $id)->first();
        $ticket->harga_dewasa=$request['dewasa'];
        $ticket->harga_anak=$request['anak'];
        $ticket->harga_bus_besar=$request['busBesar'];
        $ticket->harga_bus_kecil=$request['bus'];
        $ticket->harga_mobil=$request['mobil'];
        $ticket->harga_motor=$request['motor'];
        $ticket->update();

        $lokasi=LokasiWisata::where('lokasi_id', '=', $id)->first();
        if (!empty($request['dewasa']) && !empty($request['anak']) && !empty($request['busBesar']) && !empty($request['bus']) && !empty($request['mobil']) && !empty($request['motor'])) {
          $lokasi->status_retribusi=2;
          $lokasi->update();
        }elseif (empty($request['dewasa']) || empty($request['anak']) || empty($request['busBesar']) || empty($request['bus']) || empty($request['mobil']) || empty($request['motor'])) {
          $lokasi->status_retribusi=1;
          $lokasi->update();
        }else{
          $lokasi->status_retribusi=0;
          $lokasi->update();
        }

        return redirect()->to('/a/admin/ticketing');
      }
      public function ticketPenjualan($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = LokasiWisata::where('lokasi_id', '=', $id)->first();
        $retribusi = TicketingHarga::where('lokasi_id', '=', $id)->first();
        return view('administrator.ticketing.retribusi.ticketing')
                ->with('data', $data)
                ->with('retribusi', $retribusi);
      }
      public function PenjualanStore(Request $request, $id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $uid=md5(Carbon::now());

        $ticket=new Ticket();
        $ticket->ticketing_id=$uid;
        $ticket->id_lokasi=$request['lokasiId'];
        $ticket->nama_lokasi=$request['nama'];
        $ticket->ticket_dewasa=$request['tD'];
        $ticket->total_retrib_dewasa=$request['rD'];
        $ticket->ticket_anak=$request['tA'];
        $ticket->total_retrib_anak=$request['rA'];
        $ticket->total_ticket=$request['tD']+$request['tA'];
        $ticket->total_retrib_pengunjung=$request['rD']+$request['rA'];
        $ticket->total_bus_besar=$request['tBB'];
        $ticket->total_retrib_bus_besar=$request['rBB'];
        $ticket->total_bus=$request['tB'];
        $ticket->total_retrib_bus=$request['rB'];
        $ticket->total_mobil=$request['tMB'];
        $ticket->total_retrib_mobil=$request['rMB'];
        $ticket->total_motor=$request['tM'];
        $ticket->total_retrib_motor=$request['rM'];
        $ticket->total_kendaraan=$request['tBB']+$request['tB']+$request['tMB']+$request['tM'];
        $ticket->total_retrib_kendaraan=$request['rBB']+$request['rB']+$request['rMB']+$request['rM'];
        $ticket->total_retrib=$request['rTotal'];
        $ticket->operator=Auth::user()->name;
        $ticket->status_ticketing=1;
        $ticket->save();

        return redirect()->to('/a/admin/ticketing');
      }
      public function ticketDetail($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = LokasiWisata::where('lokasi_id', '=', $id)->first();

        $datas = DB::table("tickets")
                        ->select(
                            DB::raw('DATE(created_at) as date'),
                            // DB::raw('YEAR(created_at) year, MONTH(created_at) month'),
                            DB::raw('count(*) as total'),
                            DB::raw('SUM(total_ticket) as ticket'),
                            DB::raw('SUM(total_kendaraan) as kendaraan'),
                            DB::raw('count(IF(status_ticketing = 1, 1, NULL)) as offline'),
                            DB::raw('count(IF(status_ticketing = 0, 1, NULL)) as online'))
                        // ->groupby('year','month')
                        ->groupby('date')
                        ->where('id_lokasi', '=', $id)
                        ->get();
        // dd($datas);

        return view('administrator.ticketing.retribusi.detail-show')
                ->with('data', $data)
                ->with('datas', $datas);
      }

    // Pesan Online
      public function ticketOnline($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = LokasiWisata::where('lokasi_id', '=', $id)->first();
        $retribusi = TicketingHarga::where('lokasi_id', '=', $id)->first();
        return view('administrator.ticketing.online.create')
                ->with('data', $data)
                ->with('retribusi', $retribusi);
      }
      public function onlineStore(Request $request, $id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $uid=md5(Carbon::now());
        $tid=uniqid('Order');

        $ticket=new TicketOrdered();
        $ticket->id_lokasi=$request['lokasiId'];
        $ticket->nama_lokasi=$request['nama'];
        $ticket->id_ticket=$tid;
        $ticket->user_id=$request['rD'];
        $ticket->ticket_dewasa=$request['tD'];
        $ticket->retrib_dewasa=$request['rD'];
        $ticket->ticket_anak=$request['tA'];
        $ticket->retrib_anak=$request['rA'];
        $ticket->total_retrib=$request['rD']+$request['rA'];
        $ticket->payment_status=1;
        $ticket->save();

        return redirect()->to('/a/admin/ticketing');
      }

    // Isi Ticketing Pesan Online
      public function ticketOnlineCari($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = LokasiWisata::where('lokasi_id', '=', $id)->first();
        $retribusi = TicketingHarga::where('lokasi_id', '=', $id)->first();
        return view('administrator.ticketing.online.cari')
                ->with('data', $data)
                ->with('retribusi', $retribusi);
      }
      public function ticketOnlineHasil(Request $request)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = LokasiWisata::where('lokasi_id', '=', $request['lokasiId'])->first();
        $retribusi = TicketOrdered::where('id_lokasi', '=', $request['lokasiId'])
                  ->where('id_ticket', '=', $request['ticketId'])
                  ->first();
        return view('administrator.ticketing.online.hasil-cari')
                ->with('data', $data)
                ->with('retribusi', $retribusi);
      }
      public function ticketOnlineHasils(Request $request)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $data = LokasiWisata::where('lokasi_id', '=', $request['lokasiId'])->first();
        $retribusi = TicketDetailOrder::where('lokasi_id', '=', $request['lokasiId'])
                  ->where('order_id', '=', $request['ticketId'])
                  ->first();
        return view('administrator.ticketing.online.hasil-cari')
                ->with('data', $data)
                ->with('retribusi', $retribusi);
      }
      public function ticketOnlineIsi($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $ticket= TicketDetailOrder::where('order_id', '=', $id)->first();
        $data = LokasiWisata::where('lokasi_id', '=', $ticket->lokasi_id)->first();
        $retribusi = TicketingHarga::where('lokasi_id', '=', $ticket->lokasi_id)->first();
        return view('administrator.ticketing.online.ticketing')
                ->with('ticket', $ticket)
                ->with('data', $data)
                ->with('retribusi', $retribusi);
      }
      public function ticketOnlinePenjualan(Request $request, $id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $uid=md5(Carbon::now());

        $ticket=new Ticket();
        $ticket->ticketing_id=$uid;
        $ticket->id_lokasi=$request['lokasiId'];
        $ticket->nama_lokasi=$request['nama'];
        $ticket->ticket_dewasa=$request['tD'];
        $ticket->total_retrib_dewasa=$request['rD'];
        $ticket->ticket_anak=$request['tA'];
        $ticket->total_retrib_anak=$request['rA'];
        $ticket->total_ticket=$request['tD']+$request['tA'];
        $ticket->total_retrib_pengunjung=$request['rD']+$request['rA'];
        $ticket->total_bus_besar=$request['tBB'];
        $ticket->total_retrib_bus_besar=$request['rBB'];
        $ticket->total_bus=$request['tB'];
        $ticket->total_retrib_bus=$request['rB'];
        $ticket->total_mobil=$request['tMB'];
        $ticket->total_retrib_mobil=$request['rMB'];
        $ticket->total_motor=$request['tM'];
        $ticket->total_retrib_motor=$request['rM'];
        $ticket->total_kendaraan=$request['tBB']+$request['tB']+$request['tMB']+$request['tM'];
        $ticket->total_retrib_kendaraan=$request['rBB']+$request['rB']+$request['rMB']+$request['rM'];
        $ticket->total_retrib=$request['rTotal'];
        $ticket->operator=Auth::user()->name;
        $ticket->status_ticketing=0;
        $ticket->save();

        return redirect()->to('/a/admin/ticketing');
      }

    // Operator ticketing
      public function indexOp()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $op = UserTicketing::all();
        return view('administrator.ticketing.operator.index')
                  ->with('op', $op);
      }
      public function createOp()
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $lokasi = LokasiWisata::all();
        return view('administrator.ticketing.operator.create')
                ->with('lok', $lokasi);

      }
      public function storeOp(Request $request)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $password = $request['password'];

        $lok=LokasiWisata::where('lokasi_id', '=', $request['lokasi_id'])->first();

        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"];
        $salt = $hash["salt"];

        $op = new UserTicketing();
        $op->unique_id=$uuid;
        $op->name=$request['name'];
        $op->email=$request['username'];
        $op->phone=$request['phone'];
        $op->username=$request['username'];
        $op->password=$encrypted_password;
        $op->salt=$salt;
        $op->lokasi_id=$request['lokasi_id'];
        $op->nama_lokasi=$lok->lokasi_name;
        $op->save();


        dd($hash);

        // return redirect()->to('/ot');
        
      }
      public function showOp($id)
      {

      }
      public function editOp($id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
        $op = UserTicketing::find($id);
        $lokasi = LokasiWisata::all();
        return view('administrator.ticketing.operator.edit')
                ->with('op', $op)
                ->with('lok', $lokasi);
      }
      public function updateOp(Request $request, $id)
      {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

        $op = UserTicketing::find($id);
        $password = $request['possword'];
        if (!empty($password)) {
          $hash = $this->hashSSHA($password);
          $encrypted_password = $hash["encrypted"];
          $salt = $hash["salt"];

          $op->salt=$salt;
          $op->password=$encrypted_password;
        }

        $lok=LokasiWisata::where('lokasi_id', '=', $request['lokasi_id'])->first();

        $op->name=$request['name'];
        $op->email=$request['username'];
        $op->username=$request['username'];
        $op->phone=$request['phone'];
        $op->lokasi_id=$request['lokasi_id'];
        $op->nama_lokasi=$lok->lokasi_name;
        $op->update();
          dd($hash);

        return redirect()->to('/ot');
        
      }
      public function hashSSHA($password) {
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        // $hash = array("salt" => "oke", "encrypted" => "encrypt");
        return $hash;
        // dd($hash);
      }
      public function destroyOp($id)
      {

      }


    public function cekPass($email, $password)
    {
      dd($hash);
    }

    public function checkhashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
 
        return $hash;
    }

  // ==================================================================================
  // Member
  // ==================================================================================
    // Guide
    public function indexGuide()
    {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
      $guide = Guide::all();
      return view('administrator.member.guide.index')
              ->with('guide', $guide);
    }
    public function createGuide()
    {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
      return view('administrator.member.guide.create');
    }
    public function storeGuide(Request $request)
    {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
      $cGuide = Guide::orderBy('id', 'DESC')->first();
      $numberGuideNow=$cGuide->id++;
      $nowGuide = "GD".$numberGuideNow;

      $guide=new Guide();
      $guide->id_guide=$nowGuide;
      $guide->nama=$request['name'];
      $guide->NIK=$request['NIK'];
      $guide->umur=$request['usia'];
      $guide->jenis_kelamin=$request['jk'];
      $guide->telpon=$request['phone'];
      $guide->email=$request['email'];
      $guide->alamat=$request['alamat'];
      $guide->save();

      return redirect()->to('/guide');
    }
    public function showGuide($id)
    {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
      $guide = Guide::find($id);
      $allGuide = Guide::all();
      return view('administrator.member.guide.show')
              ->with('guide', $guide)
              ->with('allGuide', $allGuide);
    }
    public function editGuide($id)
    {if(Auth::user()->user_role!=0){return redirect()->to('/404');}
      $guide = Guide::find($id);
      return view('administrator.member.guide.edit')
              ->with('guide', $guide)
              ->with('allGuide', $allGuide);

    }
    public function updateGuide(Request $request, $id)
    {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

      $guide = Guide::find($id);
      $guide->nama=$request['name'];
      $guide->NIK=$request['NIK'];
      $guide->umur=$request['usia'];
      $guide->jenis_kelamin=$request['jk'];
      $guide->telpon=$request['phone'];
      $guide->email=$request['email'];
      $guide->alamat=$request['alamat'];
      $guide->update();

      return redirect()->to('/guide');

    }
    public function destroyGuide($id)
    {if(Auth::user()->user_role!=0){return redirect()->to('/404');}

      $guide = Guide::find($id);
      $guide->delete();

      return redirect()->to('/guide');

    }


  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }
}
