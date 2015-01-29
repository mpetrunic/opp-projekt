<div class="container">
    <div class="row clearfix">
        <div class="col-md-3 column">
            <img id="cover" src="/assets/img/cover/<?php echo $book->cover ?>" />
        </div>
        <div class="col-md-9 column">
            <div class="page-header">
                <h1><?php echo $book->deed->title ?></h1>
            </div>
            <div class="col-md-11 column">
                <p>
                    <b>Autor:</b> <?php echo $book->deed->author->name." ".$book->deed->author->surname ?>, <?php echo $book->publication_year ?><br>
                    <b>Žanr:</b> <?php echo $book->deed->genre->name ?><br>
                    <b>Broj stranica:</b> <?php echo $book->page_number ?><br><br><br>
                </p>
                <p>
                <h3><b>Najniža cijena: </b><?php echo $book->get_lowest_price() ?> kn</h3><br>
                <h4><b>Prodavač: </b><?php echo $book->current_seller ?></h4><br>
                <b>Broj postojećih kupnji te knjige: </b><?php echo $book->purchase->result_count() ?><br>
                <b>Razina stoga prodaje: </b><?php echo $book->get_current_purchase_level()+1 ?><br>
                </p>
                <p class="text-center">
                    <?php if($user->has_book($book->id)) { ?>
                        <div class="alert alert-info">Već ste kupili knjigu</div>
                    <?php } elseif($book->deleted) { ?>
                        <div class="alert alert-danger">Knjiga je uklonjena iz prodaje!</div>
                    <?php } else { ?>
                        <a class="btn btn-warning btn-lg" href="/knjiga/kupi/<?php echo $book->id ?>">Kupi knjigu</a>
                    <?php } ?>
                </p>
            </div>
        </div>
    </div>
</div>
