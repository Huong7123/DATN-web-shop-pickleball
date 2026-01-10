@extends('layouts.Frontend.master')
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div
        class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat rounded-xl items-start justify-end px-4 pb-10 @[480px]:px-10"
        data-alt="A pickleball player in mid-action, hitting the ball with a powerful swing."
        style='background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.5) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuBtQEXhpk3hJVF737RbbpO6PsIlxwGiV6szTsiQqCHAC52rzCSLpAM0uZllq8_PQdF_tWu7oxDop0syFCRqbJp76RkJlCm52tcpXC-qVgMT1Eyt7VA-nZlxHG8VK-SdGxGSGXCCMvq-n1nKZ2htAWy935FfH5MSQRNDkJEOAZn7ElMOl3kl_Sts8o96nezZ05Av4NbaWmZQ6aYgXJDRtGQ2Z3uyIqwAFeBIeoir8tj5C7DNuOnu1e2e1d9NPPMhAWluhKk7HXfwMsfC");'>
        <div class="flex flex-col gap-2 text-left max-w-xl">
            <h1
                class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em]">
                Nâng Tầm Trận Đấu Của Bạn
            </h1>
            <h2
                class="text-white text-sm font-normal leading-normal @[480px]:text-base @[480px]:font-normal @[480px]:leading-normal">
                Khám phá bộ sưu tập vợt và phụ kiện pickleball mới nhất để chinh phục mọi trận đấu.
            </h2>
        </div>
        <button id="btn_buy"
            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-primary text-gray-900 text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base @[480px]:font-bold @[480px]:leading-normal @[480px]:tracking-[0.015em] hover:bg-opacity-90 transition-colors">
            <span class="truncate">Mua Ngay</span>
        </button>
    </div>
</div>
<section class="py-8">
    <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 sm:px-6 lg:px-10 pb-3 pt-5">
        Sản Phẩm Mới
    </h2>
    <div id="wrap_product_body" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4 sm:p-6 lg:p-10">
    </div>
</section>
<section
    class="px-4 sm:px-6 lg:px-10 py-20 bg-white dark:bg-gray-900/30 rounded-3xl mx-4 sm:mx-6 lg:mx-10 shadow-sm border border-primary/5">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col items-center text-center mb-16">
            <span class="text-primary font-bold tracking-widest uppercase text-sm mb-4">Câu
                Chuyện Của Chúng Tôi</span>
            <h2
                class="text-4xl md:text-5xl font-black text-gray-900 dark:text-white mb-6 leading-tight">
                Về Pickleball Pro</h2>
            <div class="w-20 h-1.5 bg-primary rounded-full mb-8"></div>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl leading-relaxed">
                Khởi nguồn từ niềm đam mê mãnh liệt với bộ môn thể thao năng động này,
                Pickleball Pro không chỉ là một cửa hàng dụng cụ. Chúng tôi là người bạn đồng
                hành, là nơi hội tụ và lan tỏa tinh thần thể thao tích cực đến cộng đồng người
                chơi Việt Nam.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-20">
            <div class="relative group">
                <div
                    class="absolute -inset-4 bg-primary/10 rounded-2xl blur-lg transition group-hover:bg-primary/20">
                </div>
                <div class="relative aspect-[4/3] w-full bg-center bg-no-repeat bg-cover rounded-2xl shadow-xl overflow-hidden"
                    data-alt="Cộng đồng Pickleball"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA4sK1hMRONQN3ti-PaX0tZMjiTaGyVyLKyMc8qTk2lw57J3s2CD1H92BweNmBBSjbXSTDwL1i8Vjmop9YmorxPl7OuOYWAmRY-giKH6jg_Fk2cYip37CQpzLYQOK_IHdq0gVHglTZAqhHgoT6oVszrmXCHjPmfAJf1UlH9J8w6q5hX8mxmUC5UR23TBR-q36d8Wv8NupD_159kzdu4m1cdqmNK7itRUdWBNs9XE2-onCe4Z43vOYyBuGMtwzcri_T267ZD_-hjD5ip");'>
                </div>
            </div>
            <div class="flex flex-col gap-8">
                <div>
                    <h3
                        class="text-2xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">target</span>
                        Sứ Mệnh Của Chúng Tôi
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Mang đến những dụng cụ Pickleball tiêu chuẩn quốc tế với giá thành hợp
                        lý nhất. Chúng tôi cam kết giúp mọi người chơi, từ người mới bắt đầu đến
                        các vận động viên chuyên nghiệp, khai phá tối đa tiềm năng bản thân và
                        tận hưởng trọn vẹn từng khoảnh khắc trên sân đấu.
                    </p>
                </div>
                <div>
                    <h3
                        class="text-2xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">visibility</span>
                        Tầm Nhìn Chiến Lược
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Trở thành biểu tượng của sự chuyên nghiệp và uy tín trong lĩnh vực cung
                        cấp đồ tập Pickleball tại Việt Nam. Chúng tôi hướng tới việc xây dựng
                        một hệ sinh thái thể thao bền vững, nơi mỗi sản phẩm bán ra đều đóng góp
                        vào sự phát triển của cộng đồng.
                    </p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            <div
                class="bg-primary/5 dark:bg-primary/10 p-8 rounded-2xl border border-primary/10 hover:border-primary/30 transition-all text-center">
                <div
                    class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-primary">verified_user</span>
                </div>
                <h4 class="font-bold text-gray-900 dark:text-white mb-2">Chất Lượng Tuyệt Đối
                </h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">100% sản phẩm chính hãng,
                    được kiểm định nghiêm ngặt trước khi đến tay khách hàng.</p>
            </div>
            <div
                class="bg-primary/5 dark:bg-primary/10 p-8 rounded-2xl border border-primary/10 hover:border-primary/30 transition-all text-center">
                <div
                    class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-primary">groups</span>
                </div>
                <h4 class="font-bold text-gray-900 dark:text-white mb-2">Gắn Kết Cộng Đồng</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">Hỗ trợ các giải đấu phong
                    trào và tạo không gian giao lưu cho người chơi khắp cả nước.</p>
            </div>
            <div
                class="bg-primary/5 dark:bg-primary/10 p-8 rounded-2xl border border-primary/10 hover:border-primary/30 transition-all text-center">
                <div
                    class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-primary">support_agent</span>
                </div>
                <h4 class="font-bold text-gray-900 dark:text-white mb-2">Dịch Vụ Tận Tâm</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">Đội ngũ tư vấn am hiểu sâu
                    sắc về kỹ thuật, luôn sẵn sàng hỗ trợ bạn chọn dụng cụ phù hợp nhất.</p>
            </div>
        </div>
        <!-- <div class="mt-16 flex justify-center">
            <button
                class="flex items-center gap-2 px-10 py-4 bg-primary text-gray-900 font-bold rounded-full hover:scale-105 transition-transform shadow-lg shadow-primary/20">
                <span>Gia nhập cộng đồng ngay</span>
                <span class="material-symbols-outlined">arrow_forward</span>
            </button>
        </div> -->
    </div>
</section>

<script>
    $('#btn_buy').on('click', function () {
        window.location.href = '/san-pham';
    });

    // Hàm định dạng tiền tệ Việt Nam
    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(amount).replace('₫', 'đ');
    }

    function getAllProduct(page = 1) {
        $.ajax({
            url: '/api/product',
            method: 'GET',
            data: {
                page: page,
                per_page: 4,
            },
            headers: {
                // Nếu API công khai có thể không cần Token, nhưng tôi giữ lại theo code của bạn
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            beforeSend: function () {
                if (typeof showLoader === "function") showLoader();
            },
            success: function(res) {
                // Dữ liệu sản phẩm nằm trong res.data.data dựa trên JSON bạn gửi
                const products = res.data.data; 
                const $container = $('#wrap_product_body');
                
                $container.html('');
                
                if (products && products.length > 0) {
                    products.forEach(product => {
                        $container.append(renderCardProduct(product));
                    });
                } else {
                    $container.html('<p class="text-center col-span-full text-gray-500">Chưa có sản phẩm nào.</p>');
                }
            },
            error: function(err) {
                console.error('Không thể tải danh sách sản phẩm:', err);
            },
            complete: function () {
                if (typeof hideLoader === "function") hideLoader();
            }
        });
    }

    function renderCardProduct(item) {
        let imageUrl = '/images/no-image.png';
        
        // Xử lý chuỗi JSON image
        try {
            if (item.image) {
                const images = JSON.parse(item.image);
                if (Array.isArray(images) && images.length > 0) {
                    // Lấy ảnh đầu tiên trong mảng
                    imageUrl = '/storage/' + images[0];
                }
            }
        } catch (e) {
            console.warn("Lỗi parse ảnh cho sản phẩm:", item.name);
        }

        return `
        <div class="flex flex-col gap-3 pb-3 group cursor-pointer" onclick="window.location.href='/san-pham/${item.slug}'">
            <div
                class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-lg overflow-hidden transition-transform duration-300 group-hover:scale-105 shadow-sm border border-gray-100 dark:border-gray-800"
                style='background-image: url("${imageUrl}");'>
            </div>
            <div class="px-1">
                <p class="text-gray-900 dark:text-white text-xl font-semibold leading-tight mb-1 truncate">
                    ${item.name}
                </p>
                <p class="text-primary font-bold text-lg leading-normal">
                    ${formatCurrency(item.price)}
                </p>
            </div>
        </div>
        `;
    }

    $(document).ready(function () {
        getAllProduct();
    });
</script>
@endsection