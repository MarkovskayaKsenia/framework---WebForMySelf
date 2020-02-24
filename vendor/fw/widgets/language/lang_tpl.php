<select name="lang" id="lang">
    <option value="<?= $this->language['code'] ?>"><?= $this->language['title'] ?></option>
    <?php foreach ($this->languages as $key => $value): ?>
        <?php if ($this->language['code'] != $key): ?>
            <option value="<?= $key ?>"><?= $value['title'] ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>
