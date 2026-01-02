@extends('layouts.app')

@section('title', 'Edit Order')

@section('content')
@include('layouts.sidebar')
<main class="main-content">
    <div class="position-relative iq-banner">
        @include('layouts.navbar')

        <div class="conatiner-fluid content-inner mt-5 py-0">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Edit Order</h4>
                            </div>
                        </div>
                        <div class="card-body">

                            @include('forms._orderform', ['order' => $order])

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('script')

<script>

    $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
        });

    $(document).ready(function () {

        $("#addRow").click(function () {
            let row = `<tr>
                <td>
                    <select name="category_id[]" class="form-control category" required>
                        <option value="">Select</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td><select name="product_id[]" class="form-control product" required><option value="">Select Product</option></select></td>
                <td><input type="number" name="quantity[]" value="1" class="form-control qty"></td>
                <td><input type="text" name="price[]" class="form-control price" readonly></td>
                <td><input type="text" name="total[]" class="form-control total" readonly></td>
                <td><button type="button" class="btn btn-danger removeRow">X</button></td>
            </tr>`;

            $("#orderTable tbody").append(row);
        });

        $(document).on("change", ".category", function () {
            let category_id = $(this).val();
            let productSelect = $(this).closest('tr').find('.product'); console.log(productSelect);
            
            if(category_id){
                $.get('/get-products/' + category_id, function (products) {
                    productSelect.empty().append('<option value="">Select product</option>');
                    $.each(products, function (i, product) {
                        productSelect.append(`<option value="${product.id}" data-price="${product.price}">${product.name}</option>`);
                    });
                });
            }else{
                productSelect.empty().append('<option value="">Select product</option>');
            }
        });

        $(document).on("change", ".product", function () {
            let price = $(this).find(':selected').data('price');
            let row = $(this).closest('tr');
            row.find('.price').val(price);
            updateRowTotal(row);
        });

        $(document).on("keyup change", ".qty", function () {
            let row = $(this).closest('tr');
            updateRowTotal(row);
        });

        $(document).on("click", ".removeRow", function () {
            $(this).closest('tr').remove();
            updateGrandTotal();
        });

        function updateRowTotal(row) {
            let price = row.find('.price').val();
            let qty = row.find('.qty').val();
            row.find('.total').val(price * qty);
            updateGrandTotal();
        }

        function updateGrandTotal() {
            let sum = 0;
            $(".total").each(function () {
                sum += parseFloat($(this).val()) || 0;
            });

            $("#total_amount").val(sum);

            let discount = $("#discount").val() || 0;
            $("#final_amount").val(sum - discount);
        }

        $("#discount").on("keyup change", function () {
            updateGrandTotal();
        });

    });

</script>

@endpush
