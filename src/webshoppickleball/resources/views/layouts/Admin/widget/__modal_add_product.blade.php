<!-- Modal Container -->
<div
    class="relative w-full max-w-4xl bg-surface-light dark:bg-surface-dark rounded-xl shadow-2xl z-50 flex flex-col max-h-[90vh] overflow-hidden border border-border-light dark:border-border-dark animate-in fade-in zoom-in-95 duration-200">
    <!-- Header -->
    <div
        class="flex items-center justify-between px-6 py-4 border-b border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark sticky top-0 z-10">
        <div>
            <h2 class="text-xl font-bold tracking-tight">Thêm Sản phẩm Mới</h2>
        </div>
        <button
            class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 transition-colors text-gray-500 dark:text-gray-400">
            <span class="btn_close_modal material-symbols-outlined">close</span>
        </button>
    </div>
    <!-- Scrollable Body -->
    <div class="overflow-y-auto custom-scrollbar flex-1 p-6 space-y-8" style="overflow-anchor: none;">
        <!-- Image Upload Section -->
        <section>
            <h3 class="text-base font-semibold mb-3 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">image</span>
                Hình ảnh sản phẩm
            </h3>
            <!-- Input file (ẩn) -->
            <input
                type="file"
                id="image_input"
                multiple
                accept="image/png,image/jpeg,image/webp"
                class="hidden"
            />
            <!-- Upload box -->
            <div
                id="upload_box"
                class="flex flex-col items-center justify-center gap-4 rounded-xl
                    border-2 border-dashed border-primary/30 dark:border-primary/20
                    bg-background-light dark:bg-background-dark/50
                    px-6 py-10 hover:border-primary
                    transition-colors cursor-pointer group">
                <div
                    class="flex h-16 w-16 items-center justify-center
                        rounded-full bg-primary/10
                        group-hover:bg-primary/20 transition-colors">
                    <span class="material-symbols-outlined text-primary text-3xl">
                        cloud_upload
                    </span>
                </div>
                <div class="text-center">
                    <p class="text-base font-bold">Tải ảnh lên</p>
                    <p class="text-sm text-gray-500 mt-1">
                        Kéo thả ảnh vợt, bóng hoặc trang phục vào đây
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        PNG, JPG, WEBP tối đa 5MB
                    </p>
                </div>
            </div>
            <!-- Preview -->
            <div
                id="image_preview"
                class="flex gap-4 mt-4 overflow-x-auto pb-2">
            </div>
        </section>

        <!-- General Info Section -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-base font-semibold mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">edit_document</span>
                    Thông tin chung
                </h3>
            </div>
            <!-- Product Name -->
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium mb-2 text-text-light dark:text-text-dark">Tên sản phẩm <span
                        class="text-red-500">*</span></label>
                <input id="product_name"
                    class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                    placeholder="Ví dụ: Vợt Pickleball Carbon Pro X1" type="text" />
            </div>
            <!-- Category -->
            <div class="col-span-1">
                <label class="block text-sm font-medium mb-2 text-text-light dark:text-text-dark">Danh mục <span
                        class="text-red-500">*</span></label>
                <div class="relative">
                    <select id="category_select"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-shadow pr-10">
                        <option disabled="" selected="" value="">Chọn danh mục</option>
                    </select>
                </div>
            </div>
            <div class="col-span-1">
                <label class="block text-sm font-medium mb-2 text-text-light dark:text-text-dark">Giá bán (VNĐ)
                    <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 text-sm">₫</span>
                    <input id="price_main"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark pl-8 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                        placeholder="0" type="text" />
                </div>
            </div>
            <!-- Description -->
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium mb-2 text-text-light dark:text-text-dark">Mô tả sản
                    phẩm</label>
                <div class="relative">
                    <textarea id="product_description"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 min-h-[140px] resize-y transition-shadow"
                        placeholder="Nhập chi tiết về thông số kỹ thuật, chất liệu..."></textarea>
                </div>
            </div>
            <div class="col-span-1">
                <label class="block text-sm font-medium mb-2 text-text-light dark:text-text-dark">Phù hợp với người chơi<span
                        class="text-red-500">*</span></label>
                <div class="relative">
                    <select id="level_select"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-shadow pr-10">
                        <option disabled selected value="">Chọn trình độ người chơi</option>
                        <option value="all">Tất cả trình độ</option>
                        <option value="beginner">Người mới</option>
                        <option value="basic">Trình độ cơ bản</option>
                        <option value="intermediate">Trình độ trung bình</option>
                        <option value="pro">Trình độ Pro</option>
                    </select>
                </div>
            </div>
            <div class="col-span-1">
                <label class="block text-sm font-medium mb-2 text-text-light dark:text-text-dark">Phù hợp với lối chơi<span
                        class="text-red-500">*</span></label>
                <div class="relative">
                    <select id="play_style_select"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-shadow pr-10">
                        <option disabled selected value="">Chọn phong lối chơi</option>
                        <option value="all">Tất cả lối chơi</option>
                        <option value="power">Tấn công</option>
                        <option value="control">Kiểm soát</option>
                        <option value="balance">Cân bằng</option>
                    </select>
                </div>
            </div>
        </section>
        <hr class="border-border-light dark:border-border-dark opacity-50" />
        <!-- Variants / Attributes -->
        <section>
            <h3 class="text-base font-semibold mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">category</span>
                Thuộc tính &amp; Biến thể
            </h3>
            <div id="attribute_wrapper" class="space-y-4">
                
            </div>
        </section>
    </div>
    <!-- Sticky Footer -->
    <div
        class="px-6 py-4 border-t border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark flex justify-end gap-3 sticky bottom-0 z-10">
        <button
            class="btn_close_modal px-6 py-2.5 rounded-lg border border-border-light dark:border-border-dark text-text-light dark:text-text-dark font-semibold text-sm hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
            Hủy bỏ
        </button>
        <button id="btn_save_product"
            class="px-6 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-black font-bold text-sm shadow-lg shadow-primary/20 transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">save</span>
            Lưu sản phẩm
        </button>
    </div>
</div>

<script>
    let productImages = [];
    /* Click upload */
    $('#upload_box').on('click', function () {
        $('#image_input').click();
    });

    /* Chọn ảnh */
    $('#image_input').on('change', function (e) {
        const files = Array.from(e.target.files);

        files.forEach(file => {
            if (!file.type.startsWith('image/')) return;
            if (file.size > 5 * 1024 * 1024) return;

            addImage(file);
        });

        this.value = '';
    });

    /* Thêm ảnh */
    function addImage(file) {
        const index = productImages.length;
        productImages.push(file);

        const url = URL.createObjectURL(file);

        $('#image_preview').append(`
            <div
                class="relative w-24 h-24 rounded-lg overflow-hidden
                    border border-border-light dark:border-border-dark
                    shrink-0 group"
                data-index="${index}">

                <div
                    class="absolute top-1 right-1 w-6 h-6
                        flex items-center justify-center
                        bg-black/60 text-white
                        rounded-full cursor-pointer"
                    onclick="removeImage(this)">
                    <span class="material-symbols-outlined text-[16px]">close</span>
                </div>

                <img src="${url}" class="w-full h-full object-cover"/>
            </div>
        `);

    }

    /* Xoá ảnh */
    function removeImage(el) {
        const item = el.closest('[data-index]');
        const index = Number(item.dataset.index);

        productImages.splice(index, 1);
        item.remove();

        reIndexImages();

    }

    function reIndexImages() {
        $('#image_preview [data-index]').each(function (i) {
            $(this).attr('data-index', i);
        });
    }

    function getSelectedAttributes() {
        let attribute_ids = [];
        let attribute_value_ids = [];

        $('#attribute_wrapper .attribute-block').each(function () {
            const attributeId = $(this).data('attribute-id');

            const values = [];
            $(this).find('input[type="checkbox"]:checked').each(function () {
                values.push($(this).val());
            });

            if (values.length > 0) {
                attribute_ids.push(attributeId);
                attribute_value_ids.push(values);
            }
        });

        return {
            attribute_ids,
            attribute_value_ids
        };
    }

    function renderAttributeCheckbox(attributes) {
        const wrapper = $('#attribute_wrapper');
        wrapper.empty();

        attributes.forEach(attribute => {
            let valuesHtml = '';

            attribute.attribute_values.forEach(value => {
                valuesHtml += `
                    <label class="cursor-pointer relative">
                        <input
                            type="checkbox"
                            value="${value.id}"
                            class="peer absolute opacity-0 pointer-events-none"
                        />
                        <span class="px-4 py-2 rounded-lg border-2 border-border-light
                            bg-background-light text-sm font-medium
                            peer-checked:bg-primary/20
                            peer-checked:border-primary transition-colors">
                            ${value.name}
                        </span>
                    </label>
                `;
            });

            wrapper.append(`
                <div class="attribute-block flex flex-col gap-2" data-attribute-id="${attribute.id}">
                    <label class="text-sm font-medium">${attribute.name}</label>
                    <div class="flex flex-wrap gap-x-2 gap-y-5">
                        ${valuesHtml}
                    </div>
                </div>
            `);
        });
    }

    function getAllAttribute() {
        $.ajax({
            url: '/api/attribute?per_page=20&page=1',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function (res) {
                const attributes = res.data?.data || [];

                renderAttributeCheckbox(attributes);
            },
            error: function (err) {
                console.error('Không thể tải thuộc tính:', err);
            }
        });
    }

    function getAllCategory(){
        $.ajax({
            url: '/api/category?per_page=20&page=1',
            method: 'GET',
            contentType: 'application/json',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                const $select = $('#category_select');
                // reset option
                $select.html('<option value="" disabled selected>Chọn danh mục</option>');

                // nếu API dùng data
                if (res.data.data && res.data.data.length) {
                    res.data.data.forEach(function (item) {
                        $select.append(`
                            <option value="${item.id}">
                                ${item.name}
                            </option>
                        `);
                    });
                }
            },
            error: function(err) {
                console.error('Không thể tải danh sách sản phẩm:', err);
            }
        });
    }

    function resetAddProductForm() {
        // Reset input text / textarea
        $('#product_name').val('');
        $('#product_description').val('');
        $('#price_main').val('');

        // Reset select
        $('#category_select').prop('selectedIndex', 0);

        // Reset images
        productImages = [];
        $('#image_preview').empty();
        $('#image_input').val('');

        // Reset attributes
        $('#attribute_wrapper input[type="checkbox"]').prop('checked', false);
    }


    function submitProduct() {
        const formData = new FormData();

        formData.append('name', $('#product_name').val());
        formData.append('description', $('#product_description').val());
        formData.append('category_id', $('#category_select').val());
        formData.append('price_main', $('#price_main').val());

        // images[]
        productImages.forEach((file, index) => {
            formData.append('image[]', file);
        });

        // attributes
        const attrs = getSelectedAttributes();

        attrs.attribute_ids.forEach(id => {
            formData.append('attribute_ids[]', id);
        });

        attrs.attribute_value_ids.forEach((group, i) => {
            group.forEach(valueId => {
                formData.append(`attribute_value_ids[${i}][]`, valueId);
            });
        });

        formData.append('level', $('#level_select').val());
        formData.append('play_style', $('#play_style_select').val());

        $.ajax({
            url: '/api/product',
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                showLoader();
            },
            success(res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Sản phẩm đã được tạo thành công',
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    $('#modal_add_product').addClass('hidden');
                    resetAddProductForm();
                    getAllParentProduct(currentPage); 
                }, 1500);
            },
            error(err) {
                console.error('❌ Lỗi tạo sản phẩm', err.responseJSON || err);
            },
            complete: function () {
                hideLoader();
            }
        });
    }

    $('#btn_save_product').on('click', function(){
        submitProduct();
    });

    $('.btn_close_modal').on('click', function(){
        $('#modal_add_product').addClass('hidden');
    });

    $(document).ready(function(){
        getAllAttribute();
        getAllCategory();
    });
</script>