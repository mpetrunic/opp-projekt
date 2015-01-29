<div class="container">
    <div class="row clearfix">
        <div class="col-md-3 column">
            <img id="cover" src="/assets/img/cover/<?php echo$book->cover ?>" />
        </div>
        <div class="col-md-9 column">
            <div class="page-header">
                <h1><?php echo $book->deed->title ?><span class="pull-right" style="margin-right: 20px"><?php echo $mark ?></span></h1>
            </div>
            <div class="col-md-8 column">
                <p>
                    <b>Autor:</b> <?php echo $book->deed->author->name." ".$book->deed->author->surname ?>, <?php echo $book->publication_year ?><br>
                    <b>Sadržaj :</b><br><?php echo $book->deed->content ?><br>
                    <b>Žanr:</b> <?php echo $book->deed->genre->name ?><br>
                    <b>Broj stranica:</b> <?php echo $book->page_number ?><br>
                    <b>Trenutna razina stoga kupnje:</b> <?php echo $current_purchase_level ?><br>
                </p>
            </div>

            <div class="col-md-2 column">
                <p class="pull-right">
                    <a class="btn btn-warning btn-lg" href="/knjiga/kupnja/<?php echo $book->id ?>">Kupi!</a>
                </p>
            </div>



            <div id="comments" class="col-md-7">
                <?php if(!$user_commented) : ?>
                    <form method="post" action="/knjiga/komentiraj/<?php echo $book->id ?>">
                        <?php if($error_messages) : ?>
                            <div class="alert alert-danger">
                                Sljedeći podaci za komentar su neispravni:<br>
                                <ul>
                                    <?php foreach($error_messages as $error) : ?>
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
                        <div class="page-header">
                            <h3>Ostavite komentar</h3>
                        </div>
                        <div class="form-group">
                            <input id="star-rating" name="rating">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" rows="4" name="comment" id="comment" placeholder="Komentiraj!"><?php echo $comment_content ?></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-warning pull-right">Komentiraj!</button>
                        </div>
                    </form>
                <?php endif ?>
                <div class="page-header">
                    <h3>Komentari</h3>
                </div>
                <div>
                    <?php if(empty($book->comment)) : ?>
                        <h4>
                            Još nema komentara!
                        </h4>
                    <?php else : ?>
                        <ul class="commentList">
                            <?php foreach($book->comments as $comment) : ?>
                            <li>
                                <span class="sub-text"><?php echo $comment->user->username ?></span>
                                <div class="commenterImage">
                                    <img src="/assets/img/unknown.gif" />
                                </div>
                                <div class="commentText">
                                    <p class=""><?php echo $comment->content ?></p> <span class="date sub-text"><?php echo $comment->created_on ?></span>

                                </div>
                            </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>