<form action="{{ isset($order) ? route('order.update', $order->id) : route('order.store') }}"
      method="POST">
    @csrf
    @isset($order)
        @method('post')
    @endisset

    <div class="p-4 fw-bold">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <label>User:</label>
                <select name="user" class="form-control" required>
                    <option value="">Select user</option>
                    @foreach($user as $row)
                        <option value="{{ $row->id }}"
                            {{ old('user', $order->user_id ?? '') == $row->id ? 'selected' : '' }}>
                            {{ $row->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Date of ordering</label>
                <input type="text"
                       class="form-control datepicker"
                       name="ordering_date"
                       value="{{ old('ordering_date', $order->ordering_date ?? '') }}">
            </div>
        </div>
    </div>

    <table class="table" id="orderTable">
        <thead>
            <tr>
                <th>Category</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
                <th>
                    <button type="button" id="addRow" class="btn btn-success">+</button>
                </th>
            </tr>
        </thead>

        <tbody>
            @if(isset($order))
                @foreach ($order->items as $item)
                    <tr>
                        <td>
                            <select name="category_id[]" class="form-control category" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $item->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <select name="product_id[]" class="form-control product" required>
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}"
                                        data-price="{{ $p->price }}"
                                        {{ $item->product_id == $p->id ? 'selected' : '' }}>
                                        {{ $p->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <td><input type="number" name="quantity[]" value="{{ $item->quantity }}" class="form-control qty"></td>
                        <td><input type="text" name="price[]" value="{{ $item->price }}" class="form-control price" readonly></td>
                        <td><input type="text" name="total[]" value="{{ $item->total }}" class="form-control total" readonly></td>
                        <td><button type="button" class="btn btn-danger removeRow">X</button></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>
                        <select name="category_id[]" class="form-control category" required>
                            <option value="">Select</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <select name="product_id[]" class="form-control product" required>
                            <option value="">Select product</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}" data-price="{{ $p->price }}">
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>

                    <td><input type="number" name="quantity[]" value="1" class="form-control qty"></td>
                    <td><input type="text" name="price[]" class="form-control price" readonly></td>
                    <td><input type="text" name="total[]" class="form-control total" readonly></td>
                    <td><button type="button" class="btn btn-danger removeRow">X</button></td>
                </tr>
            @endif
        </tbody>
    </table>

    <hr>

    <div class="d-flex">
        <div class="w-25 ms-auto px-5">
            <label>Total Amount:</label>
            <input type="text" id="total_amount" name="total_amount"
                   value="{{ old('total_amount', $order->total_amount ?? 0) }}"
                   class="form-control" readonly>

            <label>Discount:</label>
            <input type="number" id="discount" name="discount"
                   value="{{ old('discount', $order->discount ?? 0) }}"
                   class="form-control">

            <label>Final Amount:</label>
            <input type="text" id="final_amount" name="final_amount"
                   value="{{ old('final_amount', $order->final_amount ?? 0) }}"
                   class="form-control" readonly>

            <button class="btn btn-primary mt-3">
                {{ isset($order) ? 'Update' : 'Save' }}
            </button>

            @isset($order)
                <a href="{{ route('order.index') }}" class="btn btn-secondary mt-3">Back</a>
            @endisset
        </div>
    </div>
</form>
