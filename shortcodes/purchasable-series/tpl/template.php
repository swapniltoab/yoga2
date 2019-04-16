<div class="container desktop-series" style="padding: 50px 20px">

    <?php foreach($serieses as $series):
        $currency = $series['price']['currency'] == 'USD' ? '$' : $series['price']['currency'];?>
    <div class="row show-series">
        <div class="col-md-6 series-info">
            <h2><?php echo $series['name'] ?></h2>
            <span><?php echo $series['description'] ?></span>
        </div>

        <div class="col-md-3 series-price">
            <span><?php echo $currency . $series['price']['amount'] ?></span>
        </div>

        <div class="col-md-3 series-button">
            <a href="/checkout/?seriesId=<?php echo $series['id'] ?>" data-series-id="<?php echo $series['id'] ?>" class="btn" >Buy This Series</a>
        </div>
    </div>
    <hr>
    <?php endforeach; ?>

</div>

<div class="container mobile-series" style="padding: 50px 20px">

    <?php foreach($serieses as $series):
        $currency = $series['price']['currency'] == 'USD' ? '$' : $series['price']['currency'];?>
    <div class="row show-series">
        <div class="col-md-6">
            <div class="series-info">
                <h2><?php echo $series['name'] ?></h2>
                <span><?php echo $series['description'] ?></span>
            </div>
            <div class="series-price">
                <span><?php echo $currency . $series['price']['amount'] ?></span>
            </div>
        </div>

        <div class="col-md-3 series-button">
            <a href="/checkout/?seriesId=<?php echo $series['id'] ?>" data-series-id="<?php echo $series['id'] ?>" class="btn" >Buy This Series</a>
        </div>
    </div>
    <hr>
    <?php endforeach; ?>

</div>