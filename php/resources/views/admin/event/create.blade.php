@extends('adminlte::page')

@section('title', 'Event Detail')

@section('content_header')
    <h1>活動內容新增</h1>
@stop

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel='stylesheet'">
    <style>
        .list-group .list-group-item {
            margin-left: 15px;
        }
        .list-group-item .form-group {
            padding:0 15px;
            /* margin:0 15px; */
            margin-bottom:0;
            /* margin-left:15px; */
        }
        .list-group-item .form-control {
            padding-right:0px;
        }
        .list-group-item .product-group {
            margin-top:7px;
        }
        .product-group span.label {
            height:34px;
            padding:9px 12px;
            font-size:12px;
            margin-right: 1px;
        }
    </style>
@endpush

@section('content')
    @if (session('message'))
        <div class="alert alert-{{ session('class') }}" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-primary">
                    <div class="panel-heading">活動新增</div>
                    <div class="panel-body">
                        <form action="{{ route('admin.event.store') }}" class="form-horizontal" method="post" id="form_add_event_products">
                            @csrf

                            <div class="form-group has-feedback {{ $errors->has('coupon') ? 'has-error' : '' }}">
                                <label for="coupon" class="col-sm-2 control-label">折扣碼</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="coupon" id="coupon" {{ $options['can_edit'] === true ? '' : 'disabled' }} value="{{ old('coupon') }}">
                                    <span class="glyphicon form-control-feedback"></span>
                                    @if ($errors->has('coupon'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('coupon') }}</strong>
                                        </span>
                                    @endif
                                    
                                </div>
                            </div>

                            <div class="form-group has-feedback {{ $errors->has('content') ? 'has-error' : '' }}">
                                <label for="content" class="col-sm-2 control-label">活動設定</label>
                                <div class="col-sm-10">
                                    <div class="panel panel-primary">
                                        <div class="panel-body">

                                            <div class="form-group has-feedback {{ $errors->has('content.description') ? 'has-error' : '' }}">
                                                <label for="content_description" class="col-sm-2 control-label">活動說明</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="content[description]" id="content_description" placeholder="請輸入活動說明文字" value="{{ old('content.description') }}">
                                                    <span class="glyphicon form-control-feedback"></span>
                                                    @if ($errors->has('content.description'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('content.description') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- BLKFRI2019 --}}
                                            <div class="form-group">
                                                <label for="content_default_sale" class="col-sm-2 control-label">統一折扣</label>
                                                <div class="col-sm-3">
                                                    <div class="radio-inline">
                                                        <label for="is_default_sale">
                                                            <input type="radio" name="content[options][is_default_sale]" id="is_default_sale" value="1"> 啟用
                                                        </label>
                                                    </div>
                                                    <div class="radio-inline">
                                                        <label for="is_default_sale">
                                                            <input type="radio" name="content[options][is_default_sale]" id="is_default_sale" checked value="0"> 關閉
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-sm-1" style="padding-top:7px;">
                                                    <span class="glyphicon glyphicon-exclamation-sign" data-toggle="tooltip" data-placement="top" title="所有新增的產品預設都會套用預設折扣比率，若要個別設定請關閉不要啟用"></span>
                                                </div>

                                                <div class="col-sm-2"> 
                                                    <button type="button" class="btn btn-warning" id="add_product" data-toggle="modal" data-target="#modal_add_product">
                                                        新增產品
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="form-group set_default_sale" style="display:none;">
                                                <label for="content_description" class="col-sm-2 control-label">
                                                    折扣幅度
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="content[options][default_sale_value]" id="default_sale_value" placeholder="輸入折扣值 EX:0.8" step="0.1" min="0" max="10" value="0.8" />
                                                </div>
                                            </div>

                                            {{-- <div class="form-group">
                                                <label for="content_fullfill_requirement" class="col-sm-2 control-label">
                                                    一次購足
                                                </label>
                                                
                                                <div class="col-sm-3">
                                                    <div class="radio-inline">
                                                        <label for="is_fullfill_requirement">
                                                            <input type="radio" name="content[options][is_fullfill_requirement]" id="is_fullfill_requirement" value="1"> 需要
                                                        </label>
                                                    </div>
                                                    <div class="radio-inline">
                                                        <label for="is_fullfill_requirement">
                                                            <input type="radio" name="content[options][is_fullfill_requirement]" id="is_fullfill_requirement" checked value="0"> 不需
                                                        </label>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-sm-1" style="padding-top:7px;">
                                                    <span class="glyphicon glyphicon-exclamation-sign" data-toggle="tooltip" data-placement="top" title="所有新增的產品都須一起購買才能套用預設折扣比率，若要個別設定請選擇不需"></span>
                                                </div>
                                            </div> --}}
                                        </div>

                                        <div class="form-group has-feedback {{ $errors->has('content.products') ? 'has-error' : '' }}">
                                            {{-- <label for="" class="col-sm-1 control-label"></label> --}}
                                            <div class="col-sm-11">
                                                <ul class="list-group">
                                            
                                                </ul>
                                                @if ($errors->has('content.products'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('content.products') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group has-feedback {{ $errors->has('started_at') ? 'has-error' : '' }}">
                                <label for="updated_at" class="col-sm-3 control-label">開始時間</label>
                                <div class="col-sm-8">
                                    <div class="input-group timepicker">
                                        <input type="text" class="form-control" name="started_at" id="started_at" value="{{ old('started_at') }}">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    @if ($errors->has('started_at'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('started_at') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('expired_at') ? 'has-error' : '' }}">
                                <label for="updated_at" class="col-sm-3 control-label">結束時間</label>
                                <div class="col-sm-8">
                                    <div class="input-group timepicker">
                                        <input type="text" class="form-control" name="expired_at" id="expired_at" value="{{ old('expired_at') }}">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    
                                    @if ($errors->has('expired_at'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('expired_at') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comment" class="col-sm-3 control-label">備註</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="comment" id="comment" {{ $options['can_edit'] === true ? '' : 'disabled' }} value="{{ old('comment') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-3 control-label">有效狀態</label>
                                <div class="col-sm-8">
                                    @inject('status', 'App\Presenters\StatusPresenter')
                                    {!! $status->getStatus(null, 'radio', $options['can_edit'] ?? false) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-8">
                                    <a href="{{ route('admin.events.show') }}" class="btn btn-primary">返回</a>
                                    <button type="submit" class="btn btn-danger" {{ $options['can_edit'] === true ? '' : 'disabled' }}>新增</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_add_product" tabindex="-1" role="dialog" style="border-radius:4px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius:4px;">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">選擇欲新增的活動產品</h4>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" id="form_add_product">
                        <div class="form-group">
                            <label for="category_id" class="control-label col-sm-3">產品類型:</label>
                            <div class="col-sm-8">
                                <select class="form-control col-sm-8" name="product[category_id]" id="category_id" data-type="category_id">

                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="sub_category_id" class="control-label col-sm-3">產品分類:</label>
                            <div class="col-sm-8">
                                <select class="form-control col-sm-8" name="product[sub_category_id]" id="sub_category_id" data-type="sub_category_id">
                                    
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="product_id" class="control-label col-sm-3">產品選擇:</label>
                            <div class="col-sm-8">
                                <select class="form-control col-sm-8" name="product[product_id]" id="product_id" data-type="product_id">
                                    
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" disabled id="submit_add_product">確認</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/zh-tw.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        //當啟用統一折扣時，統一所有產品得折扣值
        const saleValueSync = event => {
            const inputValue = event.target.value
            const addProductsDiscountElem = document.querySelectorAll('li.list-group-item input[name*="[discount]"]')
            const addProductsPriceElem = document.querySelectorAll('li.list-group-item input[name*="[price]"]')

            if (addProductsDiscountElem && addProductsDiscountElem.length > 0) {
                addProductsDiscountElem.forEach(item => item.value = inputValue)
                addProductsPriceElem.forEach(item => {
                    item.value = parseFloat(inputValue) * parseFloat(item.dataset.product_price).toFixed(0)
                })
            }
        }

        const calculateSalePriceByDiscount = event => {
            const discount = event.target.value || 0
            const productPrice = event.target.dataset.product_price || 0

            let salePrice = 0
            if (discount > 0 && productPrice > 0) {
                salePrice = parseFloat(discount) * parseFloat(productPrice)
            }

            event.target.parentNode.nextElementSibling.querySelector('input[name*="[price]"]').value = salePrice
        }

        const calculateSaleValueByPrice = event => {
            const salePrice = event.target.value || 0
            const productPrice = event.target.dataset.product_price || 0
            
            let discount = 0
            if (salePrice > 0 && productPrice > 0) {
                discount = parseFloat(salePrice) / parseFloat(productPrice)
            }

            event.target.parentNode.previousElementSibling.querySelector('input[name*="[discount]"]').value = discount.toFixed(2)
        }

        //取得產品 category options
        const getCategoryOptions = () => {
            const selectElem = $('#category_id')
            selectElem.html('<option value="">請稍後...</option>')

            fetch('{{ route("admin.categories.data") }}')
                .then(response => {
                    return response.json()
                })
                .then(result => {
                    const options = Object(result).reduce((carry, item) => {
                        const categoryId = item.value || ''
                        const categoryName = item.text || ''
                        const isSelected = categoryId !== '' && categoryId === 2 ? 'selected' : ''
                        if (categoryName !== '' && categoryId !== '') {
                            carry += `<option value="${categoryId}" ${isSelected}>${categoryName}</option>`
                        }
                        return carry
                    },'')

                    selectElem.html(options)
                })
        }

        //取得產品 sub_category options
        const getSubCategoryOptions = () => {
            const selectElem = $('#sub_category_id')
            selectElem.html('<option value="">請稍後...</option>')

            fetch('{{ route("admin.subCategories.data") }}')
                .then(response => {
                    return response.json()
                })
                .then(result => {
                    const options = Object(result).reduce((carry, item) => {
                        const subCategoryId = item.value || ''
                        const subCategoryName = item.text || ''
                        const isSelected = subCategoryId !== '' && subCategoryId === 1 ? 'selected' : ''
                        if (subCategoryName !== '' && subCategoryId !== '') {
                            carry += `<option value="${subCategoryId}" ${isSelected}>${subCategoryName}</option>`
                        }
                        return carry
                    },'')

                    selectElem.html(options)
                })
        }

        //取得產品 product options
        const getProductOptions = (categoryId = 1, subCategoryId = 1) => {
            const url = `{{ url("admin/events/getProduct") }}/${categoryId}/${subCategoryId}`
            const selectElem = $('#product_id')
            const submitBtn = $('#submit_add_product')

            selectElem.html('<option value="">請稍後...</option>')
            submitBtn.attr('disabled', true)
            
            fetch(url)
                .then(response => {
                    return response.json()
                })
                .then(result => {
                    const options = Object(result).reduce((carry, item) => {
                        const productId = item.id || ''
                        const productName = item.name || ''
                        const productPrice = item.price_web || 0
                        if (productName !== '' && productId !== '') {
                            carry += `<option value="${productId}" data-price="${productPrice}">${productName}</option>`
                        }
                        return carry
                    },'')

                    selectElem.html(options)
                    submitBtn.attr('disabled',false)
                })
        }

        //取得要新增的產品得產品名稱顯示
        const getOptionTextValue = selector => {
            const selectElem = document.querySelector(selector)
            const selectElemId = parseInt(selectElem.value) || 0
            const selectElemText = selectElemId !== 0 
                ? selectElem.options[selectElem.options.selectedIndex].text
                : ''
            const selectElemPrice = selectElemId !== 0 && selectElem.options[selectElem.options.selectedIndex].hasAttribute('data-price')
                ? selectElem.options[selectElem.options.selectedIndex].dataset.price
                : 0

            return [ selectElemId, selectElemText, selectElemPrice ]
        }

        //檢查要先增得產品是否已經重複
        const checkProductDuplicated = data => {
            const [ productId, productName ] = data
            const existedProducts = Object.values(document.querySelectorAll('li.list-group-item')).map(item => 
                parseInt(item.querySelector('input[name*=product_id]').value)
            ) || []

            if (existedProducts.length > 0 && existedProducts.indexOf(productId) !== -1) {

                let alertElem = `<div class="alert alert-danger alert-dismissible fade in" role="alert">`
                alertElem += `<button type="button" class="close" data-dismiss="alert" aria-label="Close">`
                alertElem += `<span aria-hidden="true">×</span></button> `
                alertElem += `<p> ${productName} 已經存在，請重新選擇欲加入的產品~!</p></div>` 

                document.querySelector('.modal-body').insertAdjacentHTML('beforebegin', alertElem)

                setTimeout(() => {
                    $('.alert').alert('close')
                }, 3000)

                return true
            }

            return false
        }

        //產生要新增的產品元件
        const generateProductItem = data => {
            const { product, options } = data
            const { categoryId, categoryText, subCategoryId, subCategoryText, productId, productText, ...others } = product
            const [ isDefaultSale, defaultSaleValue ] = options

            const { discount, productPrice } = others
            
            const isSaleValueEditable = isDefaultSale === 1 && defaultSaleValue !== 0 ? 'readonly' : '';
            const isSaleValueSentable = isDefaultSale === 1 && defaultSaleValue !== 0 ? 'disabled' : '';

            let setProductDiscountValue = typeof defaultSaleValue !== 'undefined' && parseFloat(defaultSaleValue) > 0 ? defaultSaleValue : 0
            let setProductOriginPrice = typeof productPrice !== 'undefined' && parseFloat(productPrice) > 0 ? productPrice : 0
            let setProductDiscountPrice = 0

            
            if (typeof discount !== 'undefined' && parseFloat(discount) > 0) {
                setProductDiscountValue = discount
                setProductDiscountPrice = parseFloat(setProductOriginPrice) * parseFloat(setProductDiscountValue)
            }
            console.log(others)

            let addProductItem = `<li class="list-group-item">`
            addProductItem += `<div class="form-group content_product_${productId}">`
            addProductItem += `<div class="row">`
            addProductItem += `<div class="col-sm-6 product-group">`
            // addProductItem += `<span class="label label-info">${categoryText}</span>`
            addProductItem += `<span class="label label-info">${subCategoryText}</span>`
            addProductItem += `<span class="label label-info">${productText}</span>`
            addProductItem += `<span class="label label-info">${setProductOriginPrice}</span>`
            addProductItem += `</div>`
            addProductItem += `<div class="col-sm-4">`
            addProductItem += `<input type="hidden" class="form-control" name="content[products][${productId}][category_id]" id="content_product_${productId}_category_id" value="${categoryId}">`
            addProductItem += `<input type="hidden" class="form-control" name="content[products][${productId}][category_name]" id="content_product_${productId}_category_name" value="${categoryText}">`
            addProductItem += `<input type="hidden" class="form-control" name="content[products][${productId}][sub_category_id]" id="content_product_${productId}_sub_category_id" value="${subCategoryId}">`
            addProductItem += `<input type="hidden" class="form-control" name="content[products][${productId}][sub_category_name]" id="content_product_${productId}_sub_category_name" value="${subCategoryText}">`
            addProductItem += `<input type="hidden" class="form-control" name="content[products][${productId}][product_id]" id="content_product_${productId}_product_id" value="${productId}">`
            addProductItem += `<input type="hidden" class="form-control" name="content[products][${productId}][product_name]" id="content_product_${productId}_product_name" value="${productText}">`
            addProductItem += `<input type="hidden" class="form-control" name="content[products][${productId}][product_price]" id="content_product_${productId}_product_price" value="${productPrice}">`
            addProductItem += `<div class="row">`
            addProductItem += `<div class="col-sm-6"><input type="number" class="form-control" name="content[products][${productId}][discount]" id="content_product_${productId}_discount" ${isSaleValueEditable} placeholder="成數" data-product_price="${productPrice}" value="${setProductDiscountValue}" step="0.1" min="0" max="1" /></div>`
            addProductItem += `<div class="col-sm-6"><input type="number" class="form-control" name="content[products][${productId}][price]" id="content_product_${productId}_price" ${isSaleValueEditable} placeholder="價格" data-product_price="${productPrice}" value="${setProductDiscountPrice}" /></div>`
            addProductItem += `</div></div>`
            addProductItem += `<div class="col-sm-2">`
            addProductItem += `<button class="btn btn-danger remove_product" data-target="content_product_${productId}">移除</button>`
            addProductItem += `</div>`
            addProductItem += `</div></div></li>`
            
            return addProductItem
        }

        const pastedExistedEventInfos = data => {
            data = JSON.parse(data.replace(/&quot;/g,'"'))

            const content_description_elem = document.querySelector('#content_description')
            const content_products_container = document.querySelector('ul.list-group')

            const default_sale_elem = document.querySelector('.set_default_sale')
            const default_sale_input = document.querySelector('#default_sale_value')

            if (typeof data === 'object' && data.hasOwnProperty('description')) {
                const oldDescription = '{{ old("content.description") }}'
                if (oldDescription !== '') {
                    content_description_elem.value = oldDescription
                } else {
                    content_description_elem.value = data.description
                }
            }

            if (typeof data === 'object' && data.hasOwnProperty('products') && data.hasOwnProperty('options')) {
                const { is_default_sale, default_sale_value } = data.options
                document.querySelectorAll('input[name*=is_default_sale]').forEach(item => {
                    item.checked = item.value === is_default_sale ? true : false

                    if (parseInt(is_default_sale) === 1) {
                        default_sale_elem.style.display = 'block'
                        default_sale_input.value = default_sale_value
                    }
                })

                Object.values(data.products).forEach(product => {
                    console.log(product)
                    const { 
                        category_id: categoryId, category_name: categoryText, 
                        sub_category_id: subCategoryId, sub_category_name: subCategoryText,
                        product_id: productId, product_name: productText 
                    } = product
                    const discount = product && product.hasOwnProperty('discount') ? product.discount : 0
                    const productPrice = product && product.hasOwnProperty('product_price') ? product.product_price : 0

                    const params = {
                        product: { categoryId, categoryText, subCategoryId, subCategoryText, productId, productText, discount, productPrice },
                        options: [ is_default_sale, default_sale_value ]
                    }
                    const addProductItem = generateProductItem(params)
                    content_products_container.insertAdjacentHTML('beforeend', addProductItem)
                })
            }
        }
    </script>
    <script>       
        //init get modal select options
        $('#modal_add_product').on('show.bs.modal', e => {
            ~async function() {
                await getCategoryOptions()
                await getSubCategoryOptions()
                await getProductOptions()
            }()
        })

        setTimeout(() => {
            $('.alert').alert('close')
        }, 3000)

        //datetime picker
        document.querySelectorAll('.timepicker').forEach(item => {
            const value = item.querySelector('input[name*=at]').value || ''
            if (value !== '') {
                $(item).datetimepicker({
                    format : 'YYYY-MM-DD HH:mm',
                    minDate: new Date(value)
                })
            } else {
                $(item).datetimepicker({
                    format : 'YYYY-MM-DD HH:mm',
                    minDate: new Date()
                })
            }
        })

        //display default value input column
        document.querySelectorAll('input[name*="is_default_sale]"]').forEach(el => {
            const defaultSaleElem = document.querySelector('.set_default_sale')
            const saleInputelem = document.querySelector('#default_sale_value')
            
            el.addEventListener('change', e => {
                const addProductsDiscountElem = document.querySelectorAll('li.list-group-item input[name*="[discount]"]')
                const addProductsPriceElem = document.querySelectorAll('li.list-group-item input[name*="[price]"]')
                
                if (parseInt(e.target.value) === 1) {
                    defaultSaleElem.style.display = 'block'
                    
                    saleInputelem.focus()
                    if (addProductsDiscountElem && addProductsDiscountElem.length > 0) {
                        addProductsDiscountElem.forEach(item => {
                            item.readOnly = true
                            item.disabled = true
                        })
                        addProductsPriceElem.forEach(item => {
                            item.readOnly = true
                            item.disabled = true
                        })
                    }
                } else {
                    defaultSaleElem.style.display = 'none'
                    saleInputelem.blur()

                    if (addProductsDiscountElem && addProductsDiscountElem.length > 0) {
                        addProductsDiscountElem.forEach(item => {
                            item.readOnly = false
                            item.disabled = false
                        })
                        addProductsPriceElem.forEach(item => {
                            item.readOnly = false
                            item.disabled = false
                        })
                    }
                }
            })
        })

        //modify discount value by change and input event
        document.querySelector('input[name*=default_sale_value]').addEventListener('change', e => saleValueSync(e))
        document.querySelector('input[name*=default_sale_value]').addEventListener('input', e => saleValueSync(e))

        //remove add product list-item
        document.addEventListener('click', e => {
            if (e.target && e.target.classList.contains('remove_product')) {
                e.preventDefault()

                const target = e.target.dataset.target
                const targetEl = document.querySelector(`.${target}`).parentNode || ''
                if (targetEl !== '') {
                    targetEl.remove()
                }
            }
        })

        document.addEventListener('change', e => {           
            if (e.target && e.target.getAttribute('name').indexOf('[discount]') > 0) {
                e.preventDefault()
                
                calculateSalePriceByDiscount(e)
            }
        })

        document.addEventListener('input', e => {
            if (e.target && e.target.getAttribute('name').indexOf('[discount]') > 0) {
                e.preventDefault()

                calculateSalePriceByDiscount(e)
            }

            if (e.target && e.target.getAttribute('name').indexOf('[price]') > 0) {
                e.preventDefault()
                
                calculateSaleValueByPrice(e)
            }
        })

        //insert add product
        document.querySelector('#submit_add_product').addEventListener('click', e => {
            e.preventDefault()

            const isDefaultSaleElem = document.querySelector('input[name*=is_default_sale]:checked')
            const defaultSaleValueElem = document.querySelector('input[name*=default_sale_value')

            const addProductsContainer = document.querySelector('ul.list-group')
            const addProductsElems = document.querySelectorAll('li.list-group-item')
            
            const isDefaultSale = parseInt(isDefaultSaleElem.value) || 0
            const defaultSaleValue = parseFloat(defaultSaleValueElem.value) || 0
            const discount = parseFloat(defaultSaleValueElem.value) || 0

            
            const [ categoryId, categoryText ] = getOptionTextValue('select[name*=category_id]')
            const [ subCategoryId, subCategoryText ] = getOptionTextValue('select[name*=sub_category_id]')
            const [ productId, productText, productPrice ] = getOptionTextValue('select[name*=product_id]')
            
            const isDulicated = checkProductDuplicated([ productId, productText ])
            if (isDulicated === true) {
                console.log(`重複 ${productId} ${productText}`)
                return 
            }

            const params = {
                product: { categoryId, categoryText, subCategoryId, subCategoryText, productId, productText, discount, productPrice },
                options: [ isDefaultSale, defaultSaleValue ]
            }
            const addProductItem = generateProductItem(params)
            addProductsContainer.insertAdjacentHTML('beforeend', addProductItem)

            $('#modal_add_product').modal('hide')
        })

        //listen modal category change
        document.querySelector('#category_id').addEventListener('change', e => {
            const subCategoryId = document.querySelector('#sub_category_id').value || ''
            const categoryId = e.target.value || ''

            if (categoryId !== '' && subCategoryId !== '') {
                getProductOptions(categoryId, subCategoryId)
            }
        })

        //listen modal sub_category change
        document.querySelector('#sub_category_id').addEventListener('change', e => {
            const categoryId = document.querySelector('#category_id').value || ''
            const subCategoryId = e.target.value || ''

            if (categoryId !== '' && subCategoryId !== '') {
                getProductOptions(categoryId, subCategoryId)
            }
        })
    </script>
@endpush