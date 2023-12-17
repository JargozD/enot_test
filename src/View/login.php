<form method="post">
    <div class="col-6">
        <label for="login" class="form-label">Login</label>
        <input type="text" name="login" class="form-control" value="<?= $params['login'] ?? '' ?>">
    </div>
    <div class="col-6 mb-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" value="<?= $params['password'] ?? '' ?>">
    </div>

    <?php if ($params['errors']) : ?>
        <div class="alert alert-danger" role="alert">
            <?= join(' ', $params['errors']) ?>
        </div>
    <? endif ?>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/registration" class="btn btn-secondary">Registration</a>
</form>