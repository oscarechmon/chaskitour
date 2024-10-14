<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ImagesProduct;
use App\Models\Includes;
use App\Models\Product;
use App\Models\Recommendations;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index()
    {
        $categories = Category::orderBy('id', 'desc')->where('status', 1)->get();
        $products = Product::orderBy('id', 'desc')
            ->get();
        return view('admin.products', compact('products', 'categories'));
    }
    function store(Request $request)
    {
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->product  = $request->product;
        $product->tour  = $request->tour;
        $product->itinerary = $request->itinerary;
        $product->daily_departures = $request->daily_departures;
        $product->price_per_person  = $request->price_per_person;
        if ($request->hasFile('main_image')) {
            $file_image_category = $request->file('main_image');
            $product_image_name = time() . '.' . $file_image_category->getClientOriginalExtension();
            $file_image_category->storeAs('public/product/images', $product_image_name);
            $product->main_image = $product_image_name;
        }
        if ($request->hasFile('main_video')) {
            $file_video_main_video = $request->file('main_video');
            $product_video_name = time() . '.' . $file_video_main_video->getClientOriginalExtension();
            $file_video_main_video->storeAs('public/product/videos', $product_video_name);
            $product->main_video = $product_video_name;
        }
        $product->status  = 1;
        $product->save();
        return back()->with('create', 'Publicación ha sido creado con éxito!');
    }
    function productSelected($id)
    {
        $product = Product::where('id', $id)
            ->where('status', 1)
            ->first(); // Cambiamos de get() a first()

        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    }
    public function articleSelected($id)
    {
        $article = Product::where('id', $id)->first();
        return response()->json($article);
    }
    function update(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->category_id = $request->category_id;
        $product->product  = $request->product;
        $product->tour  = $request->tour;
        $product->itinerary = $request->itinerary;
        $product->daily_departures = $request->daily_departures;
        $product->price_per_person  = $request->price_per_person;
        if ($request->hasFile('main_image')) {
            $file_image_category = $request->file('main_image');
            $product_image_name = time() . '.' . $file_image_category->getClientOriginalExtension();
            $file_image_category->storeAs('public/product/images', $product_image_name);
            $product->main_image = $product_image_name;
        }
        if ($request->hasFile('main_video')) {
            $file_video_main_video = $request->file('main_video');
            $product_video_name = time() . '.' . $file_video_main_video->getClientOriginalExtension();
            $file_video_main_video->storeAs('public/product/videos', $product_video_name);
            $product->main_video = $product_video_name;
        }
        $product->status  = 1;
        $product->save();
        return back()->with('update', 'Publicación ha sido modificado con éxito!');
    }
    public function disable(Request $request)
    {
        $article = Product::findOrFail($request->id);
        $article->status = 0;
        $article->save();
        return back()->with('articledisable', 'Producto inhabilitado');
    }
    public function destroyProduct($id)
    {
        ImagesProduct::where('product_id',$id)->delete();
        Recommendations::where('product_id',$id)->delete();
        Includes::where('product_id', $id)->delete();
        Product::destroy($id);

        return back()->with('articledisable', 'Producto eliminado');
    }
    public function enable(Request $request)
    {
        $article = Product::findOrFail($request->id);
        $article->status = 1;
        $article->save();
        return back()->with('articleenable', 'Artículo habilitado');
    }
    public function selectedImageProduct($id)
    {
        $images = ImagesProduct::where('product_id', $id)
            ->where('status', 1)
            ->get();
        return response()->json($images);
    }

    public function uploadImageProduct(Request $request)
    {
        $image_product = new ImagesProduct();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('product', $imageName, 'public');
            $image_product->url_image = $imageName;
            $image_product->product_id = $request->product_id;
            $image_product->status = 1;
            $image_product->save();
            $data = [
                'image_url' => asset('storage/product/' . $imageName),
                'fecha' => $image_product->created_at->format('Y-m-d H:i:s'),
                'product_id' => $request->product_id,
            ];

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'La imagen se ha subido correctamente.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No se ha enviado ninguna imagen.'
        ]);
    }
    public function disableImage(Request $request)
    {
        $image_product = ImagesProduct::findOrFail($request->id);
        $image_product->status = '0';
        $image_product->save();
        return response()->json(['success' => true]);
    }
    public function destroyImage($id)
    {
        $image_product = ImagesProduct::findOrFail($id);
        $image_product->delete();

        return response()->json(['success' => true]);
    }
    public function deleteRecommendation($id)
    {
        $recommendation = Recommendations::findOrFail($id);
        $recommendation->delete();

        return response()->json(['success' => true]);
    }
    public function destroyService($id)
    {
        $include = Includes::findOrFail($id);
        $include->delete();

        return response()->json(['success' => true]);
    }
    public function selectImageProduct($id)
    {
        $images = ImagesProduct::where('product_id', $id)
            ->where('status', 1)
            ->get();
        return response()->json($images);
    }

    public function selectedInclude($id)
    {
        $includes = Includes::where('product_id', $id)
            ->where('status', 1)
            ->get();
        return response()->json($includes);
    }
    public function storeInclude(Request $request)
    {
        $include = new Includes();
        $include->product_id = $request->product_id;
        $include->includes = $request->includes;
        $include->estado = $request->estado;
        $include->status = 1;
        $include->save();
        $data = [
            'includes' => $request->includes,
            'estado' => $request->estado,
            'fecha' => $include->created_at->format('Y-m-d H:i:s'),
            'product_id' => $request->product_id,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Registrado con éxito.'
        ]);
    }
    public function storeRecommendation(Request $request)
    {
        $recommendation = new Recommendations();
        $recommendation->product_id = $request->product_id;
        $recommendation->recommendation = $request->recommendation;
        $recommendation->status = 1;
        $recommendation->save();
        $data = [
            'recommendations' => $request->recommendation,
            'fecha' => $recommendation->created_at->format('Y-m-d H:i:s'),
            'product_id' => $request->product_id,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Registrado con éxito.'
        ]);
    }
    public function disableInclude(Request $request)
    {
        $includes = Includes::findOrFail($request->id);
        $includes->status = '0';
        $includes->save();
        return response()->json(['success' => true]);
    }
    public function selectedRecommendation($id)
    {
        $images = Recommendations::where('product_id', $id)
            ->where('status', 1)
            ->get();
        return response()->json($images);
    }
    public function disableRecommendation(Request $request)
    {
        $recommendation = Recommendations::findOrFail($request->id);
        $recommendation->status = '0';
        $recommendation->save();
        return response()->json(['success' => true]);
    }
}
