<?php if (!empty($errors)) : ?>
    <form class="form form--add-lot container form--invalid" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
<?php else : ?>
    <form class="form form--add-lot container" action="add.php" method="post" enctype="multipart/form-data">
<?php endif; ?>

    <h2>Добавление лота</h2>
    <div class="form__container-two">

        <?php if (isset($errors['lot-name'])) : ?>
            <div class="form__item form__item--invalid"> <!-- form__item--invalid -->
        <?php else : ?>
            <div class="form__item">
        <?php endif; ?>
            <label for="lot-name">Наименование</label>
            <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=print_var($_POST, 'lot-name'); ?>"> <!--required-->
            <span class="form__error"><?print_var($errors, 'lot-name', 'description');?></span>
        </div>



        <?php if (isset($errors['category'])) : ?>
            <div class="form__item form__item--invalid"> <!-- form__item--invalid -->
        <?php else : ?>
            <div class="form__item">
        <?php endif; ?>
        <label for="category">Категория</label>
        <select id="category" name="category" value="<?=print_var($_POST, 'category');?>">
            <?php if (print_var($_POST, 'category') === ''): ?>
                <option value="-1" selected>Выберите категорию</option>
            <?php else : ?>
               <option value="-1">Выберите категорию</option>
            <?php endif; ?>


            <?php foreach ($categories as $key => $value): ?>
                <?php if (isset($_POST['category']) && (int)print_var($_POST, 'category') === $key): ?>
                    <option value="<?=$key;?>" selected><?=$value;?></option>
                <?php else: ?>
                    <option value="<?=$key;?>"><?=$value;?></option>
                <?php endif; ?>
            <?php endforeach; ?>
            </select>
        <span class="form__error"><?print_var($errors, 'category', 'description');?></span>
      </div>
    </div>

        <?php if (isset($errors['message'])) : ?>
            <div class="form__item form__item--wide form__item--invalid"> <!-- form__item--invalid -->
        <?php else : ?>
            <div class="form__item form__item--wide">
        <?php endif; ?>
                <label for="message">Описание</label>
                <textarea id="message" name="message" placeholder="Напишите описание лота"><?=print_var($_POST, 'message');?></textarea>
                <span class="form__error"><?=print_var($errors, 'message', 'description');?></span>
            </div>

        <?php if (isset($errors['lot-photo'])) : ?>
            <div class="form__item form__item--file form__item--invalid"> <!--form__item--uploaded-->
        <?php else: ?>
            <div class="form__item form__item--file">
        <?php endif; ?>
            <label>Изображение</label>
            <div class="preview">
                <button class="preview__remove" type="button">x</button>
                <div class="preview__img">
                    <img src="<?=print_var($errors,  'lot-photo', 'image_path');?>" width="113" height="113" alt="Изображение лота">
                </div>
            </div>
            <div class="form__input-file">
                <input class="visually-hidden" type="file" id="photo2" name="lot-photo" value="">
                <label for="photo2">
                    <span>+ Добавить</span>
                </label>
                <span class="form__error"><?=print_var($errors, 'lot-photo', 'description');?></span>
            </div>
        </div>

    <div class="form__container-three">
    <?php if (isset($errors['lot-rate'])) : ?>
            <div class="form__item form__item--small form__item--invalid">
            <?php else : ?>
            <div class="form__item form__item--small">
            <?php endif; ?>
                <label for="lot-rate">Начальная цена</label>
                <input id="lot-rate" name="lot-rate" placeholder="0" value="<?=print_var($_POST, 'lot-rate');?>"> <!--type="number" required-->
                <span class="form__error"><?=print_var($errors, 'lot-rate', 'description');?></span>
            </div>

            <?php if (isset($errors['lot-step'])) : ?>
            <div class="form__item form__item--small form__item--invalid">
            <?php else : ?>
            <div class="form__item form__item--small">
            <?php endif; ?>
                <label for="lot-step">Шаг ставки</label>
                <input id="lot-step" name="lot-step" placeholder="0" value="<?=print_var($_POST, 'lot-step');?>"> <!--type="number" required-->
                <span class="form__error"><?=print_var($errors, 'lot-step', 'description');?></span>
            </div>

            <?php if (isset($errors['lot-date'])) : ?>
            <div class="form__item form__item--invalid">
            <?php else : ?>
            <div class="form__item">
            <?php endif; ?>
                <label for="lot-date">Дата завершения</label>
                <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="20.05.2017" value="<?=print_var($_POST, 'lot-date');?>"> <!--required-->
                <span class="form__error"><?=print_var($errors, 'lot-date', 'description');?></span>
            </div>
    </div>

  <?php if(isset($errors)) : ?>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <ul>
      <?php foreach ($errors as $err => $val) : ?>
        <li><strong>Поле '<?= $dict[$err]; ?>': </strong><?= $val['description']; ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

    <button type="submit" class="button">Добавить лот</button>
  </form>
