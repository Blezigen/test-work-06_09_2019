<style>
    .functions-box li.item:hover {
        background-color: #f7f7f7;
        border-radius: 5px;
        border-bottom: 2px solid #d5d5d5;
        margin-bottom: 0;
        cursor: pointer;
    }

    .functions-box li.item:active {
        background-color: #fbfbfb;
        border-radius: 5px;
        border-bottom: 2px solid #d5d5d5;
        margin-bottom: 0;
        cursor: pointer;
    }
    .functions-box li.item {
        margin-bottom: 2px;
    }
    .functions-box li.item:hover:last-of-type {
        border-bottom-width: 2px !important;
    }
</style>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">{{ __("Dashboard function") }}</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body functions-box" >
        <ul class="products-list product-list-in-box">

        <li class="item col-md-12" id="update-currency" >
            <div class="product-img">
                <i class="fa fa-refresh fa-2x ext-icon"></i>
            </div>
            <div class="product-info">
                Update currency exchange rate<br>
                From the <a href="https://cbr.ru/">CBR.RU</a>
            </div>
        </li>

        <!-- /.item -->
        </ul>
    </div>

    <!-- /.box-footer -->
</div>

<script>
    $(document).ready(function () {
       $("#update-currency").on("click", function () {
            $.ajax({
                method: "GET",
                url: "/admin/update/currency",
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                data: [],
                beforeSend: function () {
                    $("#update-currency i").toggleClass("fa-spin", true);
                }
            })
            .done(function (data) {
                $("#update-currency i").toggleClass("fa-spin", false);
                if (data.execute === "success") {
                    toastr.success('Update success!', "Currency")
                }
                else
                    toastr.error("Update filed!", "Currency")
            });
       });
    });
</script>