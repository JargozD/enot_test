<form method="post">
    <div class="col-6 mb-4">
        <label for="from1" class="form-label">RUB</label>
        <input type="text" name="from1" class="form-control" value="<?= $params['from1'] ?? '' ?>">
    </div>
    <div class="col-6 mb-4">
        <label for="to1" class="form-label">Currency</label>
        <select class="form-select" name="to1">
            <option <?= $params['to1'] ? '' : 'selected' ?>>Выберите валюту</option>
            <? foreach ($params['currencies'] as $currency) : ?>
                <option <?= ($params['to1'] == $currency['letter_code']) ? 'selected' : '' ?> value="<?= $currency['letter_code'] ?>"><?= $currency['letter_code'] ?></option>
            <? endforeach ?>
        </select>
    </div>

    <?php if ($params['errors1']) : ?>
        <div class="alert alert-danger" role="alert">
            <?= join(' ', $params['errors1']) ?>
        </div>
    <? endif ?>

    <?php if ($params['result1']) : ?>
        <div class="alert alert-success" role="alert">
            <?= $params['result1'] . ' ' . $params['to1'] ?>
        </div>
    <? endif ?>

    <button type="submit" name="forma1" class="btn btn-primary">Submit</button>

    <div class="col-6 my-4">
        <label for="to2" class="form-label">Currency</label>
        <select class="form-select" name="to2">
            <option <?= $params['to2'] ? '' : 'selected' ?>>Выберите валюту</option>
            <? foreach ($params['currencies'] as $currency) : ?>
                <option <?= ($params['to2'] == $currency['letter_code']) ? 'selected' : '' ?> value="<?= $currency['letter_code'] ?>"><?= $currency['letter_code'] ?></option>
            <? endforeach ?>
        </select>
    </div>
    <div class="col-6 my-4">
        <label for="from2" class="form-label">Введите количество выбранной валюты</label>
        <input type="text" name="from2" class="form-control" value="<?= $params['from2'] ?? '' ?>">
    </div>

    <?php if ($params['errors2']) : ?>
        <div class="alert alert-danger" role="alert">
            <?= join(' ', $params['errors2']) ?>
        </div>
    <? endif ?>

    <?php if ($params['result2']) : ?>
        <div class="alert alert-success" role="alert">
            <?= $params['result2'] . ' RUB' ?>
        </div>
    <? endif ?>

    <button type="submit" name="forma2" class="btn btn-primary">Submit</button>
</form>