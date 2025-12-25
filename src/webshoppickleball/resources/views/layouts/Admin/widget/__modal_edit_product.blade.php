<!-- Modal Container -->
<div
    class="relative w-full max-w-4xl bg-surface-light dark:bg-surface-dark rounded-xl shadow-2xl z-50 flex flex-col max-h-[90vh] overflow-hidden border border-border-light dark:border-border-dark animate-in fade-in zoom-in-95 duration-200">
    <!-- Header -->
    <div
        class="flex items-center justify-between px-6 py-4 border-b border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark sticky top-0 z-10">
        <div>
            <h2 class="text-xl font-bold tracking-tight">Chỉnh sửa sản phẩm</h2>
        </div>
        <button
            class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 transition-colors text-gray-500 dark:text-gray-400">
            <span class="btn_close_edit_modal material-symbols-outlined">close</span>
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
            <input type="hidden" id="product_id_edit" />
            <input
                type="file"
                id="image_input_edit"
                multiple
                accept="image/png,image/jpeg,image/webp"
                class="hidden"
            />
            <!-- Upload box -->
            <div
                id="upload_box_edit"
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
                id="image_preview_edit"
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
                <input id="product_name_edit"
                    class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                    placeholder="Ví dụ: Vợt Pickleball Carbon Pro X1" type="text" />
            </div>
            <!-- Category -->
            <div class="col-span-1">
                <label class="block text-sm font-medium mb-2 text-text-light dark:text-text-dark">Danh mục <span
                        class="text-red-500">*</span></label>
                <div class="relative">
                    <select id="category_select_edit"
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
                    <input id="price_main_edit"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark pl-8 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                        placeholder="0" type="text" />
                </div>
            </div>
            <!-- Description -->
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium mb-2 text-text-light dark:text-text-dark">Mô tả sản
                    phẩm</label>
                <div class="relative">
                    <textarea id="product_description_edit"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 min-h-[140px] resize-y transition-shadow"
                        placeholder="Nhập chi tiết về thông số kỹ thuật, chất liệu..."></textarea>
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
            <div id="attribute_wrapper_edit" class="space-y-4">
                
            </div>
        </section>
    </div>
    <!-- Sticky Footer -->
    <div
        class="px-6 py-4 border-t border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark flex justify-end gap-3 sticky bottom-0 z-10">
        <button
            class="btn_close_edit_modal px-6 py-2.5 rounded-lg border border-border-light dark:border-border-dark text-text-light dark:text-text-dark font-semibold text-sm hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
            Hủy bỏ
        </button>
        <button id="btn_save_product_edit"
            class="px-6 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-black font-bold text-sm shadow-lg shadow-primary/20 transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">save</span>
            Lưu sản phẩm
        </button>
    </div>
</div>
<script>
    $('.btn_close_edit_modal').on('click', function(){
        $('#modal_edit_product').addClass('hidden');
    });
    let productImageEdit = [];
    /* Click upload */
    $('#upload_box_edit').on('click', function () {
        $('#image_input_edit').click();
    });

    /* Chọn ảnh */
    $('#image_input_edit').on('change', function (e) {
        const files = Array.from(e.target.files);

        files.forEach(file => {
            if (!file.type.startsWith('image/')) return;
            if (file.size > 5 * 1024 * 1024) return;

            addImageEdit(file);
        });

        this.value = '';
    });

    /* Thêm ảnh */
    function addImageEdit(file) {
        productImageEdit.push(file);
        const url = URL.createObjectURL(file);
        const index = $('#image_preview_edit > div').length; // index tổng thể

        $('#image_preview_edit').append(`
            <div class="relative w-24 h-24 rounded-lg overflow-hidden border border-border-light dark:border-border-dark shrink-0 group" data-index="${index}" data-type="new">
                <div class="absolute top-1 right-1 w-6 h-6 flex items-center justify-center bg-black/60 text-white rounded-full cursor-pointer" onclick="removeImageEdit(this)">
                    <span class="material-symbols-outlined text-[16px]">close</span>
                </div>
                <img src="${url}" class="w-full h-full object-cover"/>
            </div>
        `);
    }

    // xoá ảnh
    function removeImageEdit(el) {
        const item = el.closest('[data-index]');
        const type = item.dataset.type;
        const index = Number(item.dataset.index);

        if(type === 'new') {
            productImageEdit.splice(index, 1);
        } else {
            productImageOld.splice(index, 1);
        }

        item.remove();
        reIndexImagesEdit();
    }

    // cập nhật lại index
    function reIndexImagesEdit() {
        $('#image_preview_edit > div').each(function(i){
            $(this).attr('data-index', i);
        });
    }

    function getSelectedAttributesEdit() {
        let attribute_ids = [];
        let attribute_value_ids = [];

        $('#attribute_wrapper_edit .attribute-block').each(function () {
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

    function renderAttributeCheckboxEdit(attributes) {
        const wrapper = $('#attribute_wrapper_edit');
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
                    <div class="flex flex-wrap gap-2">
                        ${valuesHtml}
                    </div>
                </div>
            `);
        });
    }

    function getAllAttributeEdit() {
        $.ajax({
            url: '/api/attribute?per_page=20&page=1',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function (res) {
                const attributes = res.data?.data || [];

                renderAttributeCheckboxEdit(attributes);
            },
            error: function (err) {
                console.error('Không thể tải thuộc tính:', err);
            }
        });
    }

    function getAllCategoryEdit(){
        $.ajax({
            url: '/api/category?per_page=20&page=1',
            method: 'GET',
            contentType: 'application/json',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                const $select = $('#category_select_edit');
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

    function fillProductEditModal(product) {
        $('#product_id_edit').val(product.id);
        $('#product_name_edit').val(product.name);
        $('#price_main_edit').val(product.price);
        $('#product_description_edit').val(product.description || '');
        $('#category_select_edit').val(product.category_id);

        // reset
        $('#image_preview_edit').empty();
        productImageEdit = [];
        productImageOld = [];

        // ảnh cũ
        const images = JSON.parse(product.image || '[]');
        images.forEach(imgPath => {
            productImageOld.push(imgPath);
            const index = $('#image_preview_edit > div').length;

            $('#image_preview_edit').append(`
                <div class="relative w-24 h-24 rounded-lg overflow-hidden border border-border-light dark:border-border-dark shrink-0 group" data-index="${index}" data-type="old">
                    <div class="absolute top-1 right-1 w-6 h-6 flex items-center justify-center bg-black/60 text-white rounded-full cursor-pointer" onclick="removeImageEdit(this)">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                    </div>
                    <img src="/storage/${imgPath}" class="w-full h-full object-cover"/>
                </div>
            `);
        });

        // check attribute
        $('#attribute_wrapper_edit .attribute-block').each(function() {
            const attributeId = $(this).data('attribute-id');
            $(this).find('input[type="checkbox"]').each(function() {
                const valueId = Number($(this).val());
                const found = product.attribute_values.some(v => v.id === valueId && v.attribute_id === attributeId);
                $(this).prop('checked', found);
            });
        });
    }

    $(document).on('click', '.btn-edit', function () {
        const id = $(this).data('id');
        $.ajax({
            url: '/api/product/' + id,
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                const product = res.data;
                fillProductEditModal(product);
                $('#modal_edit_product').removeClass('hidden');
            }
        });
    });

    function submitProductEdit() {
        const formData = new FormData();

        formData.append('name', $('#product_name_edit').val());
        formData.append('description', $('#product_description_edit').val());
        formData.append('category_id', $('#category_select_edit').val());
        formData.append('price_main', $('#price_main_edit').val());

        // images[]
        productImageEdit.forEach((file, index) => {
            formData.append('image[]', file);
        });

        // attributes
        const attrs = getSelectedAttributesEdit();

        attrs.attribute_ids.forEach(id => {
            formData.append('attribute_ids[]', id);
        });

        attrs.attribute_value_ids.forEach((group, i) => {
            group.forEach(valueId => {
                formData.append(`attribute_value_ids[${i}][]`, valueId);
            });
        });

        // console.log('📦 FORM DATA PREVIEW');
        // for (let pair of formData.entries()) {
        //     console.log(pair[0], pair[1]);
        // }

        Swal.fire({
            title: 'Đang xử lý...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            onOpen: () => Swal.showLoading()
        });
        $.ajax({
            url: '/api/product/' + $('#product_id_edit').val(),
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            data: formData,
            processData: false,
            contentType: false,
            success(res) {
                Swal.close();
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Cập nhật sản phẩm thành công!',
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    $('#modal_edit_product').addClass('hidden');
                    getAllParentProduct();
                }, 1500);
            },
            error(err) {
                console.error('❌ Lỗi cập nhật sản phẩm', err.responseJSON || err);
            }
        });
    }

    $('#btn_save_product_edit').on('click', function() {
        submitProductEdit();
    });

    $(document).ready(function(){
        getAllAttributeEdit();
        getAllCategoryEdit();
    });
</script>