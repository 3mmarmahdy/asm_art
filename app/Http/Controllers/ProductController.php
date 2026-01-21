<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException; // استدعاء كلاس الأخطاء

class ProductController extends Controller
{
    // 1. عرض الصفحة الرئيسية
    public function index()
    {
        $products = Product::with('category')->latest()->get(); 
        return view('products.index', compact('products'));
    }

    // 2. صفحة الإضافة
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // 3. حفظ المنتج
   public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'required|image|max:5120',
            'category_id' => 'required|exists:categories,id',
        ]);

        // تحويل الصورة إلى كود Base64
        $path = $request->file('image')->getRealPath();
        $logo = file_get_contents($path);
        $base64 = base64_encode($logo);
        $finalImage = 'data:image/' . $request->file('image')->extension() . ';base64,' . $base64;

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'image' => $finalImage,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'تم إضافة المنتج بنجاح');
    }

    // 4. عرض التفاصيل
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // 5. صفحة التعديل
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // 6. تحديث المنتج (تم تعديل التوجيه هنا)
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->getRealPath();
            $logo = file_get_contents($path);
            $base64 = base64_encode($logo);
            $data['image'] = 'data:image/' . $request->file('image')->extension() . ';base64,' . $base64;
        }

        $product->update($data);

        // التعديل الذي طلبته: الانتقال للصفحة الرئيسية مع رسالة نجاح
        return redirect()->route('products.index')->with('success', 'تم تعديل المنتج بنجاح');
    }

    // 7. حذف المنتج (تمت إضافة الحماية من الأخطاء هنا)
    public function destroy(Product $product)
    {
        try {
            // حذف الصورة أولاً
            if ($product->image && str_starts_with($product->image, 'storage/')) {
                $oldPath = str_replace('storage/', '', $product->image);
                Storage::disk('public')->delete($oldPath);
            }

            $product->delete();
            
            return redirect()->route('products.index')->with('success', 'تم حذف المنتج بنجاح');

        } catch (QueryException $e) {
            // إذا كان الخطأ بسبب وجود طلبات مرتبطة (رمز الخطأ 23000)
            if ($e->getCode() == 23000) {
                return redirect()->back()->with('error', 'لا يمكن حذف هذا المنتج لأنه مرتبط بطلبات شراء سابقة.');
            }
            
            return redirect()->back()->with('error', 'حدث خطأ غير متوقع أثناء الحذف.');
        }
    }

    // 8. البحث
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::with('category')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return view('products.index', compact('products'));
    }
}