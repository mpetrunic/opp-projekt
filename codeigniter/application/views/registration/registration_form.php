<div class="row clearfix">
		<div class="col-md-4 column">
		</div>
		<div class="col-md-4 column">
            <div class="page-header">
                <h1>Registracija</h1>
            </div>
            <?php if($error_message) : ?>
            <div class="alert alert-danger">
                Sljedeći podaci za registraciju su neispravni:<br>
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
			<form role="form" action="/registracija/provjeri" method="post">
				<div class="form-group">
					 <label for="username">Korisničko ime</label><input type="text" class="form-control" name="username" id="username" value="<?php echo $user->username ?>" />
				</div>
				<div class="form-group">
					 <label for="email">Email</label><input type="email" class="form-control" name="email" id="email" value="<?php echo $user->email ?>" />
				</div>
                <div class="form-group">
                    <label for="name">Ime</label><input type="text" class="form-control" name="name" id="name" value="<?php echo $user->name ?>" />
                </div>
                <div class="form-group">
                    <label for="surname">Prezime</label><input type="text" class="form-control" name="surname" id="surname" value="<?php echo $user->surname ?>" />
                </div>
                <div class="form-group">
                    <label for="nickname">Nadimak</label><input type="text" class="form-control" name="nickname" id="nickname" value="<?php echo $user->nickname ?>" />
                </div>
                <div class="form-group">
                    <label for="password">Lozinka</label><input type="password" class="form-control" name="password" id="password" />
                </div>
                <div class="form-group">
                    <label for="repeat_password">Ponovite lozinku</label><input type="password" name="repeat_password" class="form-control" name="repeat_password" id="repeat_password" />
                </div>
                <div class="form-group">
                    <a href="/"><button type="button" class="btn btn-warning pull-left margin-bot-15">Početna</button></a>
                    <button type="submit" class="btn btn-warning pull-right margin-bot-15">Registriraj</button>
                </div>
			</form>
		</div>
		<div class="col-md-4 column">
		</div>
</div>