<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Brochure;
use App\Models\Category;
use App\Models\ImagesArticle;
use App\Models\ImagesProduct;
use App\Models\Includes;
use App\Models\Lead;
use App\Models\Product;
use App\Models\Recommendations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaginasController extends Controller
{
    function inicio()
    {
        // $article = Article::orderBy('id', 'desc')->where('status', 1)->get();
        $products = Product::where('status',1)->get();
        return view('blog.inicio', compact('products'));
    }
    function brochure()
    {
        $brochures = Brochure::orderBy('id', 'desc')->get();
        return view('blog.brochure', compact('brochures'));
    }
    function nosotros()
    {
        return view('blog.nosotros');
    }
    function preguntas() {}
    function contactanos()
    {
        return view('blog.contactanos');
    }
    function detalle(Request $request, $id)
    {
        $recommendations = Recommendations::orderBy('id','desc')->get();
        $product = Product::where('id', $id)->first();
        $images_product = ImagesProduct::where('status', 1)->where('product_id', $id)->get();
        $includes = Includes::where('status', 1)->where('product_id', $id)->get();
        return view('blog.detalle', compact('product', 'images_product','includes','recommendations'));
    }
 
    public function sendEmail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'message' => 'required|string|max:1000',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe proporcionar un correo electrónico válido.',
            'phone.required' => 'El número de teléfono es obligatorio.',
            'message.required' => 'El mensaje es obligatorio.',
        ]);

        $lead = new Lead();
        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->phone = $request->phone;
        $lead->save();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message, 
        ];
        
        Mail::send('blog.template-email', $data, function ($message) use ($data) {
            $message->to($data['email'])
                ->subject('Nuevo mensaje de contacto');
            $message->from(config('mail.from.address'), config('mail.from.name'));
        });
        
        return redirect()->route('contactanos')->with('success', 'Tu solicitud ha sido enviada con éxito. Pronto responderemos a tu solicitud.');
    
    }
    function product(Request $request,$id){
        $products = Product::orderBy('id', 'desc')->where('status', 1)->
        where('id_category',$id)->get();
        return view ('blog.productos',compact('products'));
    }
}
