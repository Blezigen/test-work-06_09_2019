@extends('layouts.app')

@section('content')

<section class="container">
    <div class="row">
        <div class="col-md-12">
            <h1> Товары </h1>
            <form action="/" method="post">
                <div class="container">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2" for="edit-states1-id">BsMultiSelect</label>
                        <div class="col-sm-10">
                            <select name="States1" id="edit-states1-id" class="form-control test"  multiple="multiple" style="display: none;">
                                <option value="AL">Alabama</option>
                                <option value="AK" disabled>Alaska</option>
                                <option value="AZ" >Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option selected value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District Of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI" hidden selected>Hawaii Hidden</option>
                                <option value="ID" hidden>Idaho Hidden</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option selected value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
    <div class="row">
        <?php foreach ($products as $product) : ?>
        <div class="col-md-12 product-card" id="product-<?= $product->id ?>">
            <div class="row">
                <div class="col-md-12 product-title"><?= $product->name ?></div>
            </div>
            <div class="row">
                <div class="col-md-4 product-image">
                    <img src="/storage/<?= $product->image ?>" style="width: 100%;" alt="<?= $product->name ?>">
                    <p class="card-text product-price"><?= $product->price ?> РУБ.</p>
                </div>
                <div class="col-md-8 product-desc">
                    <span>О товаре</span>
                    <pre class="card-text"><?= $product->description ?></pre>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
@endsection

@section('endScript')
    <script>
        $(document).ready(function(){
            let multiSelects = $("select[multiple='multiple']").bsMultiSelect();
        });
    </script>
@endsection