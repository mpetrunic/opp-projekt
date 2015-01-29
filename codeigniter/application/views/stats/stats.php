<div class="row clearfix">
    <div class="col-md-4 column">
    </div>
    <div class="col-md-4 column">
        <div class="page-header">
            <h1>Statistika</h1>
        </div>
        <b>Ukupni broj naslova: </b> <?php echo $total_books ?><br>
        <b>Ukupni ostvarenih kupnji: </b> <?php echo $total_purchases ?><br>
        <b>Ukupni prihod od kupnji: </b> <?php echo number_format($total_income, 2, ",", ".") ?> kn<br>
        <b>Ukupni prihod od provizija: </b> <?php echo number_format($total_provision, 2, ",", ".") ?> kn<br>
    </div>
    <div class="col-md-4 column">
    </div>
</div>
