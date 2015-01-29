<div class="row clearfix">
    <div class="col-md-4 column">
    </div>
    <div class="col-md-4 column">
        <div class="page-header">
            <h1>Nova knjiga</h1>
        </div>
        <?php if($error_message) : ?>
            <div class="alert alert-danger">
                Sljedeći podaci za dodavanje knjige su neispravni:<br>
                <ul>
                    <?php foreach($error_message as $error) : ?>
                        <li>
                            <?php echo $error ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        <?php endif; ?>
        <?php if($success_message) : ?>
            <div class="alert alert-success">
                <?php echo $success_message ?>
            </div>
        <?php endif; ?>
        <form enctype="multipart/form-data" role="form" action="/knjiga/spremi" method="post">
            <div class="form-group">
                <label for="title">Naslov</label><input type="text" class="form-control" name="title" placeholder="Naslov knjige" id="title" value="<?php echo $book->deed->title ?>" />
            </div>
            <div class="form-group">
                <label for="content">Kratki sadržaj</label><textarea class="form-control" name="content" placeholder="Kratki sadržaj" id="content" ><?php echo $book->deed->content ?></textarea>
            </div>
            <div class="form-group">
                <label for="author">Autor</label>
                <input type="text" class="form-control" name="author_name" id="author_name" placeholder="Ime autora" value="<?php echo $book->deed->author->name ?>" />
                <br>
                <input type="text" class="form-control" name="author_surname" id="author_surname" placeholder="Prezime autora" value="<?php echo $book->deed->author->surname ?>" />
            </div>
            <div class="form-group">
                <label for="genre">Žanr</label><input type="text" class="form-control" name="genre" id="genre" placeholder="Ime žanra" value="<?php echo $book->deed->genre->name ?>" />
            </div>
            <div class="form-group">
                <label for="publication_year">Godina izdanja</label><input type="text" class="form-control" name="publication_year" placeholder="Godina izdanja" id="publication_year" value="<?php echo $book->publication_year ?>" />
            </div>
            <div class="form-group">
                <label for="cover">Slika naslovnice</label>
                <p class="help-block">Slika može imati maksimalno 2MB i maksimalnih dimenzija 1024x768 px. Dopušteni tipovi su .jpg|.png|.gif</p>
                <input type="file" class="file_upload" name="cover">
            </div>
            <div class="form-group">
                <label for="page_number">Broj stranica</label><input type="number" min="0" name="page_number" placeholder="Broj stranica knjige" class="form-control" id="page_number" value="<?php echo $book->page_number ?>"/>
            </div>
            <div class="form-group">
                <label for="price">Cijena</label><input type="text" name="price" class="form-control" placeholder="Cijena knjige" id="price" value="<?php echo $book->price ?>" />
            </div>
            <div class="form-group">
                <label for="max_purchase_level">Broj razina stoga kupnje</label><input type="number" min="1" name="max_purchase_level" placeholder="Broj razina stoga kupnje" class="form-control" id="max_purchase_level" value="<?php echo $book->max_purchase_level ?>"/>
            </div>
            <div class="form-group">
                <label for="cover">Knjiga</label>
                <p class="help-block">Knjiga može imati maksimalno 2MB i mora biti tipa *.pdf</p>
                <input type="file" class="file_upload" name="book_file">
            </div>
            <div class="form-group">
                <a href="/"><button type="button" class="btn btn-warning pull-left margin-bot-15">Početna</button></a>
                <button type="submit" class="btn btn-warning pull-right margin-bot-15">Spremi</button>
            </div>
        </form>
    </div>
    <div class="col-md-4 column">
    </div>
</div>