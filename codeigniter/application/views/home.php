<div class="row clearfix">
    <div class="col-md-12 column">
        <div class="jumbotron">
            <h1>
                Dobrodošli na stranice knjižare!
            </h1>

            <p>
                Najveći izbor domaćih i stranih naslova!<br>
                Kako biste dobili mogućnost kupovanja knjiga, potrebno se registrirati!
            </p>

            <p class="text-center">
                <a class="btn btn-warning btn-lg" href="/registracija">Registracija!</a>
            </p>
        </div>
        <h3>
            Novi naslovi
        </h3>
        <div class="book_slider">
            <?php foreach($newest_books as $book) : ?>
                <div class="sliding_book">
                    <a href="/knjiga/prikaz/<?php echo $book->id ?>">
                        <img src="/assets/img/cover/<?php echo $book->cover ?>" class="cover" alt="Naslovnica knjige">
                    </a>
                        <h3 class="book_title"><?php echo $book->deed->title ?></h3>
                </div>
            <?php endforeach ?>
        </div>
        <h3>
            Najpopularniji naslovi
        </h3>
        <div class="book_slider">
            <?php foreach($popular_books as $book) : ?>
                <div class="sliding_book">
                    <a href="/knjiga/prikaz/<?php echo $book->id ?>">
                        <img src="/assets/img/cover/<?php echo $book->cover ?>" class="cover" alt="Naslovnica knjige">
                    </a>
                    <h3 class="book_title"><?php echo $book->deed->title ?></h3>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
