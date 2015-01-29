<div class="container">
    <div class="row clearfix">
        <div class="col-md-3 column">
            <img id="cover" src="/assets/img/cover/<?php echo$book->cover ?>" />
        </div>
        <div class="col-md-9 column">
            <div class="page-header">
                <h1>Certifikat o kupnji: <small>[kupnja_knjige: certifikat]</small></h1>
            </div>
            <div class="col-md-11 column">
                <p>
                    <h4><b><?php echo $book->deed->title ?></b></h4>
                    <b>Autor:</b> <?php echo $book->deed->author->name." ".$book->deed->author->surname ?>, <?php echo $book->publication_year ?><br><br>
                </p>
                <p>
                    <b>Prodavač: </b>[kupnja_knjige: kupljen_od]<br>
                    <b>Kupac: </b>[kupnja_knjige: korisnik_id][korisnik: ime][korisnik: prezime]<br><br>
                </p>
                <button type="button" class="btn btn-warning">Skini PDF knjige</button>
                <button type="button" class="btn btn-warning">PDF certifikat</button>
            </div>
        </div>
    </div>
</div>

<style>
    #cover {
        padding-left: 10px;
        padding-right: 20px;
        width: 250px;
        height: auto;
    }
    #title {
        margin-bottom: 2px;
    }
    #author {
        margin-top: 2px;
        padding-left: 2em;
        padding-bottom: 30px;
        color: #585858;
    }
    #comments {
        clear: both;
        padding-top: 70px;
        padding-bottom: 3em;
    }
</style>