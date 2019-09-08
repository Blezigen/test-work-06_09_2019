@extends('layouts.app')

@section('content')

<section class="container">
    <div class="row">
        <div class="col-md-12">

        </div>

    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: center;">
            <h1>Products</h1>
        </div>
    </div>
    <form method="POST" action="{{ route("api.products")  }}" class="row" id="update-products" style="margin-bottom: 10px;">
        <div class="col-md-12">
            <label for="currency">{{__("Select currencies")}}</label>
        </div>
        <div class="col-md-12">
            <select name="currency[]" id="currency" class="form-control"  multiple="multiple" style="display: none;">
                @foreach($currencies as $currency=>$value)
                    @if($currency == "RUB")
                        <option value="{{$currency}}" selected>[{{$currency}}] {{$value["name"]}}</option>
                    @else
                        <option value="{{$currency}}">[{{$currency}}] {{$value["name"]}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </form>
    <div class="row" id="product_cards">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th rowspan="2">Article</th>
                        <th rowspan="2">Photo</th>
                        <th rowspan="2">Name</th>
                        <th rowspan="2">Description</th>
                        <th id="currency-table-part-column" colspan="1">Prices</th>
                    </tr>
                    <tr id="currency-table-part">
                    </tr>
                </thead>
                <tbody id="products">
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@section('endScript')
    <script>
        var $multiSelects = $("select[multiple='multiple']");
        function install(){
            $multiSelects.bsMultiSelect();
        }
        install();


        function printCurrency(prices){
            $("#currency-table-part-column").attr("colspan",prices.length);

            let data = "";

            $.each( prices, function( key, value ) {
                data = data + "<td title=\""+value.name+"\" data-currency=\""+key+"\">["+key+"]<br>"+value.symbol+"</td>";
            });

            return data;
        }

        function printProductPrice(prices){
            $("#currency-table-part-column").attr("colspan",prices.length);

            let data = "";

            $.each( prices, function( key, value ) {
                data = data + "<td class='product-price' title=\""+value.name+"\" data-currency=\""+key+"\">"+value.value+"</td>";
            });

            return data;
        }


        function printProduct(data){
            let priceList =  printProductPrice(data.prices);

            return "<tr id=\"product-"+data.id+"\">\n" +
                "                <td>"+data.article+"</td>\n" +
                "                <td><img src=\"/storage/"+data.image+"\" style=\"width: 100%;\" alt=\""+data.name+"\"></td>\n" +
                "                <td>"+data.name+"</td>\n" +
                "                <td><pre>"+data.description+"</pre></td>\n" + priceList +
                "            </tr>";

        }


        $('#update-products').on("submit", function () {

            $.ajax({
                method: "POST",
                url: "{{ route("api.products") }}",
                data:  {
                    cur:$('#currency').val().join(',')
                }
            }).done(function(data) {
                $("#products").html("");
                if ( data.products.length > 0 ) {
                    $.each(data.products, function (key, value) {
                        let dataTemp = data.products[key];
                        $("#currency-table-part-column").attr("colspan", Object.keys(dataTemp.prices).length);
                        $("#currency-table-part").html(printCurrency(dataTemp.prices));

                        let temp = $("#products").html();
                        $("#products").html(temp + printProduct(data.products[key]));
                    });
                }
                else {
                    $("#currency-table-part-column").attr("colspan", 1);
                    $("#currency-table-part").html("");
                    $("#products").html("<tr><td colspan='5'> Product list is empty ... </td></tr>");
                }
            });
            return false;
        });

        $('#currency').change(function (){
            $('#update-products').submit();
        });

        $('#update-products').submit();

    </script>
@endsection