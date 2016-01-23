@extends('store.store')

@section('content')
    <section id="cart_items">
    	<div class="container">
        @include('alerts.alerts')
    		<div class="table-responsive cart_info">
    			<table class="table table-condensed">
    				<thead>
    					<tr class="cart_menu">
    						<td class="image">Item</td>
    						<td class="description"></td>
                            <td class="color">Cor</th>
    						<td class="price">Price</td>
    						<td class="qtd">Qtd</td>
    						<td class="total">Total</td>
    						<td></td>
    					</tr>
    				</thead>

    				<tbody>

    				@forelse($cart->all() as $k=>$item)
    					<tr>
    						<td class="cart_product">
    							<a href="{{ route('store.product', ['id'=>$k]) }}">
    								Imagem
    							</a>
    						</td>
                           
    						<td class="cart_description">
    							<h4><a href="{{ route('store.product', ['id'=>$k]) }}">{{ $item['name'] }}</a></h4>
    							<p>Code: {{ $k }}</p>
    						</td>
                            
                            <td>
                                <i class="fa fa-square fa-2x" style="color:{{ $item['color'] }}"></i>
                            </td>

    						<td class="cart_price">
    							R$ {{ $item['price'] }}
    						</td>

    						<td class="cart_quantity">
    						<a href="{{ route('cart.add', ['id'=>$k]) }}" class="cart_quantity_delete"><span class="glyphicon glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>
                                {{ $item['qtd'] }}
                            <a href="{{ route('cart.remove', ['id'=>$k]) }}" class="cart_quantity_delete"><span class="glyphicon glyphicon glyphicon-minus-sign disabled" aria-hidden="true"></span></a>
    						</td>

    						<td class="cart_total">
    							<p class="cart_total_price">R$ {{ $item['price'] * $item['qtd'] }}</p>
    						</td>
    						<td class="cart_delete">
    							<a href="{{ route('cart.destroy', ['id'=>$k]) }}" class="cart_quantity_delete">Delete</a>
    						</td>
    					</tr>
                    @empty
                        <tr>
                            <td class="" colspan="6">
                                <br>
                                <center><p>No items found. Go buy something!</p></center>
                            </td>
                        </tr>
    				@endforelse

                    <tr class="cart_menu">
                        <td colspan="7">
                            <div class="pull-right">
                                <span>
                                    TOTAL: R$ {{ $cart->getTotal() }}
                                </span>

                                <a href="{{route('checkout.place')}}" class="btn btn-success">Go to checkout</a>
                            </div>
                        </td>
                    </tr>

    				</tbody>
    			</table>
    		</div>
            
            <!--/*{!! Form::label('cep', 'CEP:') !!}
            {!! Form::text('cep', null, ['class'=>'form-control']) !!}
            <button type="button" id="calculate" class="btn btn-danger btn-block">Calculate</button>
            <div id="loader" style="display:none;">Carregando opções de envio... Por favor, aguarde.</div>

            {!! Form::open(['route'=>'admin.products.store', 'method'=>'post']) !!}
            <div class="form-group">
                <select name="frete">            
                </select>
            </div>
            {!! Form::close() !!}
            */-->

    	</div>
    </section>
@endsection

@section('post-script')
    <script type="text/javascript">
    /*$(document).ready(function() {

        $("select[name=frete]").hide();

        //$('#cep').focusout(function(e){
        $('#calculate').click(function(e){

            var value=$.trim($("#cep").val());

            if (value  === '') {
                alert('Por favor, informe um CEP.');
                return false;
            }

            $("#loader").show();

            var cep = $('#cep').val(); //pego o valor do id selecionado
            $.get('/get-fretes/' + cep, function(frete){ //passo a url com o cep que eu peguei acima
                
                var erropac = frete.pac.erro.codigo;
                var errosedex = frete.sedex.erro.codigo;
                var errosedex10 = frete.sedex10.erro.codigo;
                var errosedexhoje = frete.sedexhoje.erro.codigo;

                $('select[name=frete]').empty(); // limpo ela com a função empty
                if(erropac == 0){
                    $('select[name=frete]').append($('<option>', {
                        value: 1,
                        text: "PAC: R$ " + frete.pac.valor + " Prazo de entega: " + frete.pac.prazo + "dia(s) úteis após a postagem"
                    }));
                } else {
                    $('select[name=frete]').append($('<option>', {
                        value: 1,
                        text: "PAC: " + frete.pac.erro.mensagem
                    }));
                }

                if(errosedex == 0){
                    $('select[name=frete]').append($('<option>', {
                        value: 2,
                        text: "SEDEX: R$ " + frete.sedex.valor + " Prazo de entega: " + frete.sedex.prazo + "dia(s) úteis após a postagem"
                    }));
                } else {
                    $('select[name=frete]').append($('<option>', {
                        value: 1,
                        text: "SEDEX: " + frete.sedex.erro.mensagem
                    }));
                }

                if(errosedexhoje == 0){
                    $('select[name=frete]').append($('<option>', {
                        value: 3,
                        text: "SEDEX 10: R$ " + frete.sedex10.valor + " Prazo de entega: " + frete.sedex10.prazo + "dia(s) úteis após a postagem"
                    }));
                }else {
                    $('select[name=frete]').append($('<option>', {
                        value: 1,
                        text: "SEDEX 10: " + frete.sedex10.erro.mensagem
                    }));
                }

                if(errosedex10 == 0){
                    $('select[name=frete]').append($('<option>', {
                        value: 4,
                        text: "SEDEX HOJE: R$ " + frete.sedexhoje.valor + " Prazo de entega: " + frete.sedexhoje.prazo + "dia(s) úteis após a postagem"
                    }));
                }else {
                    $('select[name=frete]').append($('<option>', {
                        value: 1,
                        text: "SEDEX HOJE: " + frete.sedexhoje.erro.mensagem
                    }));
                }

                $("#loader").hide();
                $("select[name=frete]").show();
            });
        });
    });*/
    </script>
@endsection