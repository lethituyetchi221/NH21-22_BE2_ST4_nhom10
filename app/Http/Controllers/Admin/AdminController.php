<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Type_product;
use App\Models\Bill_detail;
use App\Models\Order;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Selling;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showReview()
    {
        $all_review = Review::orderBy('created_at', 'desc')->search()->paginate(9);
        $all_typeProduct = Type_product::all();
        return view('admin/review', compact('all_typeProduct', 'all_review'));
    }

    public function showSelling()
    {
        $all_selling = Selling::orderBy('quanty', 'desc')->search()->paginate(9);
        $all_typeProduct = Type_product::all();
        return view('admin/selling', compact('all_selling', 'all_typeProduct'));
    }

    public function showWishlistAdmin()
    {
        $all_wishlist = Wishlist::orderBy('created_at', 'desc')->search()->paginate(9);
        $all_typeProduct = Type_product::all();
        return view('admin/wishlist', compact('all_typeProduct', 'all_wishlist'));
    }
    public function addUser(Request $request)
    {
        if (count(User::where('email', '=', $request->email)->get()) == 0) {
            if ($request->password == $request->confirmPassword) {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->role = $request->role;
                $user->save();
                return  redirect()->back()->with('Success', 'Thêm tài khoản thành công');
            } else {
                return  redirect()->back()->with('Error', 'Mật khẩu không trùng khớp');
            }
        } else {
            return  redirect()->back()->with('Error', 'Email đã tồn tại');
        }
    }


    public function deleteUser($id)
    {
        if (Auth::user()->id == $id) {
            return  redirect()->back()->with('Error', 'Tài khoản đang đăng nhập, không thể xóa');
        } else {
            $bill = Bill_detail::where('user_id', '=', $id)->get();
            foreach ($bill as $item) {
                Order::where('bill_detail_id', '=', $item->id)->delete();
                Bill_detail::where('user_id', '=', $id)->delete();
            }

            User::where('id', '=', $id)->delete();

            return  redirect()->back()->with('Success', 'Xóa user thành công');
        }
    }

    public function showUser()
    {
        $all_user = User::orderBy('created_at', 'desc')->search()->paginate(9);
        $all_typeProduct = Type_product::all();
        return view('admin.user', compact('all_typeProduct', 'all_user'));
    }
    public function showOrder()
    {
        $all_typeProduct = Type_product::all();
        $all_order = Order::orderBy('created_at', 'desc')->search()->paginate(9);
        return view('admin.order', compact('all_typeProduct', 'all_order'));
    }
    public function deleteBill_admin($id)
    {
        $bill = Bill_detail::where('id', '=', $id)->first();
        if ($bill->status == 0) {
            $bill = Bill_detail::where('id', '=', $id)->delete();
            // $order = Order::where('bill_detail_id', '=', $id)->delete();
            $order =  Order::where('bill_detail_id', '=', $$id)->get();
            foreach ($order as $item) {
                $sell = Selling::where('product_id', $item->product_id)->first();
                $sell->quanty -= $item->qty;
                $sell->save();
            }
            Order::where('bill_detail_id', '=', $bill_id)->delete();

            return  redirect()->back()->with('Success', 'Xóa đơn hàng thành công');
        } else {
            return  redirect()->back()->with('Error', 'Không thể xóa đơn hàng');
        }
    }

    public function editBill_admin(Request $request, $id)
    {
        $bill = Bill_detail::where('id', '=', $id)->first();
        if ($request->status == 2 || $request->status == 3) {
            $bill->status = $request->status;
            $bill->delivery_date = DATE(NOW());
        } else {
            $bill->status = $request->status;
            $bill->delivery_date = null;
        }

        $bill->save();

        return redirect()->route('showBill')->with('Success', 'Cập nhật thành công');
    }
    public function showEditBill_admin($id)
    {
        $all_typeProduct = Type_product::all();
        $bill = Bill_detail::where('id', '=', $id)->first();
        $order = Order::where('bill_detail_id', '=', $id)->with('bill_details')->get();
        return view('admin.edit-bill', compact('all_typeProduct', 'bill', 'order'));
    }
    public function showBill()
    {
        $all_typeProduct = Type_product::all();
        $all_bill = Bill_detail::orderBy('create_date', 'desc')->search()->paginate(9);
        return view('admin.bill', compact('all_typeProduct', 'all_bill'));
    }
    public function deleteProtype($id)
    {
        $all_product_by_type_id = Product::where('type_id', '=', $id)->with('type_products')->get();

        if (count($all_product_by_type_id) == 0) {
            Type_product::where('id', '=', $id)->delete();
            return  redirect()->back()->with('Success', 'Xóa loại sản phẩm thành công');
        } else {
            return  redirect()->back()->with('Error', 'Loại sản phẩm tồn tại hàng, không thể xóa');
        }
    }
    public function editProtype($id, Request $request)
    {
        $protype = Type_product::where('type_name', '=', $request->name)->get();
        if (count($protype) == 0) {
            $protype = Type_product::where('id', '=', $id)->first();
            $protype->type_name = $request->name;
            $protype->save();
            return  redirect()->back()->with('Success', 'Chỉnh sửa thành công');
        } else {
            return  redirect()->back()->with('Error', 'Tên phân loại đã tồn tại');
        }
    }
    public function addProtype(Request $request)
    {
        $temp = Type_product::where('type_name', '=', $request->name)->get();
        if (count($temp) == 0) {
            $typeProduct = new Type_product();
            $typeProduct->type_name = $request->name;
            $typeProduct->save();
            return redirect()->back()->with('Success', 'Thêm thành công');
        } else {
            return  redirect()->back()->with('Error', 'Loại sản phẩm đã tồn tại, không thể thêm');
        }
    }
    public function showProtype()
    {
        $all_typeProduct = Type_product::all();
        $all_protype = Type_product::search()->paginate(9);
        return view('admin.protype', compact('all_typeProduct', 'all_protype'));
    }
    public function showProduct()
    {
        $all_typeProduct = Type_product::all();
        $all_product = Product::orderBy('create_date', 'desc')->search()->paginate(9);
        return view('admin.product', compact('all_typeProduct', 'all_product'));
    }
    public function editProduct($id, Request $request)
    {
        if ($request->has('file')) {

            $image = $request->file;
            $ext = $request->file->extension();
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'gif' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'PNG' || $ext == 'GIF' || $ext == 'JPEG') {

                $file_name = time() . '-' . 'product' . '.' . $ext;
                $product = Product::where('id', '=', $id)->first();

                $product->product_name = $request->name;
                $product->type_id = $request->protype;
                $product->description = $request->description;
                $product->image = $file_name;
                $product->price = $request->price;
                $product->is_featured = $request->featured;


                $product->save();
                $image->move(public_path('img/product'), $file_name);


                return redirect()->route('item', ['id' => $product->type_id])->with('Success', 'Cập nhật thành công');
            } else {
                return redirect()->back()->with('Error', 'Ảnh không hợp lệ (jpg, png, jpeg, gif)');
            }
        } else {
            return redirect()->back()->with('imageError', 'Ảnh không được bỏ trống');
        }
    }
    public function ShowEditProduct($id)
    {
        $all_typeProduct = Type_product::all();
        $product = Product::where('id', '=', $id)->first();
        return view('admin.edit-product', compact('all_typeProduct', 'product'));
    }
    public function deleteProduct($id)
    {
        if (count(Order::where('product_id', $id)->get()) == 0  && count(Review::where('product_id', $id)->get()) == 0 && count(Selling::where('product_id', $id)->get()) == 0 && count(Wishlist::where('product_id', $id)->get()) == 0) {
            Product::where('id', '=', $id)->delete();
            return  redirect()->back()->with('Success', 'Xóa thành công');
        } else {
            return  redirect()->back()->with('Error', 'Không thể xóa sản phẩm');
        }
    }
    public function addProduct(Request $request)
    {
        if ($request->has('file')) {

            $image = $request->file;
            $ext = $request->file->extension();
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'gif' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'PNG' || $ext == 'GIF' || $ext == 'JPEG') {
                $file_name = time() . '-' . 'product' . '.' . $ext;

                $product = new Product();
                $product->product_name = $request->name;
                $product->type_id = $request->protype;
                $product->description = $request->description;
                $product->image = $file_name;
                $product->price = $request->price;
                $product->is_featured = $request->featured;
                $product->create_date = DATE(NOW());


                $product->save();
                $image->move(public_path('img/product'), $file_name);

                return redirect()->back()->with('Success', 'Thêm mới thành công');
            } else {
                return redirect()->back()->with('Error', 'Ảnh không hợp lệ (jpg, png, jpeg, gif)');
            }
        } else {
            return redirect()->back()->with('Error', 'Ảnh không được bỏ trống');
        }
    }

    public function item($id)
    {
        $all_typeProduct = Type_product::all();
        $typeProduct = Type_product::where('id', '=', $id)->first();
        $all_product_by_type_id = Product::where('type_id', '=', $id)->with('type_products')->orderBy('create_date', 'desc')->search()->paginate(9);

        return view('admin.items', compact('all_product_by_type_id', 'all_typeProduct', 'typeProduct'));
    }
    public function showAdminIndex()
    {
        $all_typeProduct = Type_product::all();
        return view('admin.index', compact('all_typeProduct'));
    }

    public function ShowAddProduct()
    {
        $all_typeProduct = Type_product::all();

        return view('admin.add-product', compact('all_typeProduct'));
    }
    public function index($id)
    {
        $qty_product = count(Product::all());
        $qty_protype = count(Type_product::all());
        $qty_user = count(User::all());
        $qty_bill = count(Bill_detail::all());
        $qty_order = count(Order::all());
        $qty_selling = Selling::sum('quanty');
        $earnings = Bill_detail::whereIn('status', [2, 3])->sum('total');
        $all_typeProduct = Type_product::all();

        return view('admin/' . $id, compact('all_typeProduct', 'qty_product', 'qty_protype', 'qty_user', 'qty_bill', 'qty_order', 'qty_selling', 'earnings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
