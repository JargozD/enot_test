<form method="post">
    <div class="col-6">
        <label for="login" class="form-label">Login</label>
        <input type="text" name="login" class="form-control" value="<?= $params['login'] ?? '' ?>">
    </div>
    <div class="col-6">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" value="<?= $params['password'] ?? '' ?>">
    </div>
    <div class="col-6 mb-4">
        <label for="password2" class="form-label">Repeat Password</label>
        <input type="password" name="password2" class="form-control" value="<?= $params['password2'] ?? '' ?>">
    </div>

    <?php if ($params['errors']) : ?>
        <div class="alert alert-danger" role="alert">
            <?= join(' ', $params['errors']) ?>
        </div>
    <? endif ?>

    <button type="submit" class="btn btn-primary">Registration</button>
</form>