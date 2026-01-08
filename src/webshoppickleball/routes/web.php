<?php

use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

//payment vnpay
Route::get('/vnpay/redirect/{txn}', [PaymentController::class, 'redirectToVnpay'])->name('vnpay.redirect');
Route::get('/vnpay/return', [PaymentController::class, 'returnVnpay'])->name('vnpay.return');

//Auth
Route::get('/register', function () {
    return view('layouts.Auth.pages.register',['title' => 'Đăng ký']);
});

Route::get('/verify-otp', function () {
    return view('layouts.Auth.pages.verify-otp',['title' => 'Xác thực OTP']);
});

Route::get('/login', function () {
    return view('layouts.Auth.pages.login', ['title' => 'Đăng nhập']);
})->name('login');

Route::get('/forgot-password', function () {
    return view('layouts.Auth.pages.forgot-password', ['title' => 'Quên mật khẩu']);
});
Route::get('/reset-password', function () {
    return view('layouts.Auth.pages.reset-password', ['title' => 'Đặt lại mật khẩu']);
});

// routes web
Route::get('/', function () {
    return view('layouts.Frontend.pages.index',['title' => 'Trang chủ']);
});
Route::get('/dang-nhap', function () {
    return view('layouts.Frontend.pages.auth.login', ['title' => 'Đăng nhập']);
});
Route::get('/dang-ky', function () {
    return view('layouts.Frontend.pages.auth.register', ['title' => 'Đăng ký']);
});
Route::get('/xac-minh-otp', function () {
    return view('layouts.Frontend.pages.auth.verify', ['title' => 'Xác minh OTP']);
});
Route::get('/quen-mat-khau', function () {
    return view('layouts.Frontend.pages.auth.forgot', ['title' => 'Quên mật khẩu']);
});
Route::get('/dat-lai-mat-khau', function () {
    return view('layouts.Frontend.pages.auth.reset-password', ['title' => 'Đặt lại mật khẩu']);
});
Route::get('/dang-xuat', function () {
    return view('layouts.Frontend.pages.auth.logout', ['title' => 'Đăng xuất']);
});
Route::get('/thong-tin-ca-nhan', function () {
    return view('layouts.Frontend.pages.profile.profile',['title' => 'Thông tin cá nhân']);
});
Route::get('/lich-su-don-hang', function () {
    return view('layouts.Frontend.pages.profile.history-order',['title' => 'Lịch sử đơn hàng']);
});

Route::get('/chi-tiet-don-hang/{id}', [OrderController::class, 'getOrderDetail']);

Route::get('/dia-chi-giao-hang', function () {
    return view('layouts.Frontend.pages.profile.address',['title' => 'Địa chỉ giao hàng']);
});
Route::get('/san-pham', function () {
    return view('layouts.Frontend.pages.product.list-product',['title' => 'Sản phẩm']);
});
Route::get('/san-pham/{slug}', [ProductController::class, 'getProductBySlug']);

Route::get('/gio-hang', function () {
    return view('layouts.Frontend.pages.cart.cart',['title' => 'Giỏ hàng của bạn']);
});
Route::get('/thanh-toan', function () {
    return view('layouts.Frontend.pages.payment.payment',['title' => 'Thanh toán đơn hàng']);
});

Route::get('/thanh-toan-thanh-cong', function () {
    return view('layouts.Frontend.pages.payment.payment-success',['title' => 'Thanh toán đơn hàng thành công']);
})->name('payment.success');

Route::get('/thanh-toan-that-bai', function () {
    return view('layouts.Frontend.pages.payment.payment-failed',['title' => 'Thanh toán đơn hàng thất bại']);
})->name('payment.failed');

Route::get('/lien-he', function () {
    return view('layouts.Frontend.pages.contact.contact',['title' => 'Liên hệ chúng tôi']);
});
Route::get('/kho-voucher', function () {
    return view('layouts.Frontend.pages.voucher.list-voucher',['title' => 'Kho voucher']);
});

//routes admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', function () {
        return view('layouts.Backend.login',['title' => 'Đăng nhập']);
    })->name('login');

    //user
    Route::get('/user', function () {
        return view('layouts.Backend.pages.user.user',['title' => 'Quản lý người dùng']);
    });

    Route::get('/quan-ly-nguoi-dung', function () {
        return view('layouts.Admin.pages.user',['title' => 'Quản lý người dùng']);
    });

    Route::get('/manage', function () {
        return view('layouts.Backend.pages.user.manage',['title' => 'Quản lý QTV']);
    });
    Route::get('/quan-ly-QTV', function () {
        return view('layouts.Admin.pages.manage',['title' => 'Quản lý QTV']);
    });

    //category
    Route::get('/category', function () {
        return view('layouts.Backend.pages.category.category',['title' => 'Quản lý danh mục']);
    });

    Route::get('/quan-ly-danh-muc', function () {
        return view('layouts.Admin.pages.category',['title' => 'Quản lý danh mục']);
    });

    Route::get('/product', function () {
        return view('layouts.Backend.pages.product.product',['title' => 'Quản lý sản phẩm']);
    });

    Route::get('/quan-ly-san-pham', function () {
        return view('layouts.Admin.pages.product',['title' => 'Quản lý sản phẩm']);
    });
    Route::get('/quan-ly-don-hang', function () {
        return view('layouts.Admin.pages.order',['title' => 'Quản lý đơn hàng']);
    });

    Route::get('/attribute', function () {
        return view('layouts.Backend.pages.attribute.attribute',['title' => 'Quản lý bộ thuộc tính']);
    });

    Route::get('/quan-ly-thuoc-tinh', function () {
        return view('layouts.Admin.pages.attribute',['title' => 'Quản lý thuộc tính']);
    });

    Route::get('/attribute-value', function () {
        return view('layouts.Backend.pages.attribute.attribute-value',['title' => 'Quản lý bộ thuộc tính']);
    });

    Route::get('/quan-ly-gia-tri-thuoc-tinh', function () {
        return view('layouts.Admin.pages.attribute_value',['title' => 'Quản lý giá trị thuộc tính']);
    });

    Route::get('/discount', function () {
        return view('layouts.Backend.pages.discount.discount',['title' => 'Quản lý ưu đãi']);
    });

    Route::middleware('admin.role')->group(function () {
        
    });
});
