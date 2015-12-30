@extends('app')

@section('content')

    <div class="container">
        <div class="col-lg-6 col-md-8 col-sm-12">
            {!! Form::open(['route' => 'costumer.order.store']) !!}
            <div class="row">
                <h3>Novo pedido</h3>
            </div>

            <div class="form-group">
                <div class="row ">
                    <label for="total">Total:</label>
                    <p id="js-total"></p>

                    <a href="#" id="js-btn-create-item" class="btn btn-success">Novo Item</a>
                </div>

                <br />

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <label class="panel-title">Pedidos</label>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td width="90%">
                                            <select name="items[0][product_id]" class="form-control" title="">
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} - {{ $product->price }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            {!! Form::text('items[0][quantity]', 1, ['class' => 'form-control']) !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer" style="position: relative; height: 53px;">
                            {!! Form::submit('Concluir pedido', ['class' => 'btn btn-primary', 'style' => 'position:absolute; right: 13px;']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('post-script')
    <script>
        jQuery(function(){
            var $btnCreateItem = jQuery('#js-btn-create-item');

            $btnCreateItem.click(function(evt){
                var lengthLines = jQuery('table tbody tr').length,
                    $row        = jQuery('table tbody tr:last'),
                    $newRow     = $row.clone();

                $newRow.find('td').each(function(){
                    var $td = jQuery(this),
                      input = $td.find('input, select'),
                       name = input.attr('name');

                    input.attr('name', name.replace((lengthLines - 1), lengthLines));
                });

                $newRow.find('input').val(1);
                $newRow.insertAfter($row);

                calculateTotal().calc();

                evt.preventDefault();
            });

            var $body = jQuery('body');
            $body.on('change', 'select', function(){ calculateTotal().calc(); });
            $body.on('keyup', 'input', function(){ calculateTotal().calc(); });

            var calculateTotal = (function(){
                return {
                    calc: function(){
                        var $labelAmount = jQuery('label[for="total"]'),
                            total        = 0,
                            amount       = 0,
                            count        = 0,
                            $tr          = jQuery('table tbody tr');

                        $tr.find(':selected, input').each(function(){
                            var $self = jQuery(this);

                            amount += $self.is('option') ? parseFloat($self.data('price')) : 0;
                            count  += $self.is('input') ? parseInt($self.val()) : 0;
                        });

                        if(amount * count !== 0)
                            total = amount * count;

                        $labelAmount.html('Total: R$' + total);
                    }
                };
            });

            calculateTotal().calc();
        });
    </script>
@endsection