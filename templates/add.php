<main>
  <nav class="nav">
    <ul class="nav__list container">
      <?php foreach($categories as $category_name): ?>
      <li class="nav__item">
        <a href="category.php?alias=<?= $category_name['alias']?>"><?= $category_name['title']; ?></a>
      </li>
    <?php endforeach; ?>
    </ul>
  </nav>
  <form class="form form--add-lot container form--invalid" enctype="multipart/form-data" action="add.php" method="post"> <!-- form--invalid -->
   <?php $classname = !empty($errors['lot-name']) ? "form__item--invalid" : "";  ?>
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item <?=$classname;?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" value="<?php if(!empty($_REQUEST['lot-name'])){ echo $_REQUEST['lot-name']; } ?>" placeholder="Введите наименование лота" >
        <span class="form__error">Введите наименование лота</span>
      </div>
      <div class="form__item <?=$classname;?>">
        <label for="category">Категория</label>
        <select id="category" name="category" >
          <option>Выберите категорию</option>
          <?php foreach($categories as $category_name): ?>
          <option><?= $category_name['title']; ?><option>
          <?php endforeach; ?>
        </select>
        <span class="form__error">Выберите категорию</span>
      </div>
    </div>
    <div class="form__item form__item--wide <?=$classname;?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота"><?php if(!empty($_REQUEST['message'])){ echo $_REQUEST['message']; } ?> </textarea>
      <span class="form__error">Напишите описание лота</span>
    </div>
    <div class="form__item form__item--file <?=$classname;?>"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" name='file-lot' id="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small <?=$classname;?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" value="<?php if(!empty($_REQUEST['lot-rate'])){ echo $_REQUEST['lot-rate']; } ?>" placeholder="0" >
        <span class="form__error">Введите начальную цену</span>
      </div>
      <div class="form__item form__item--small <?=$classname;?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" value="<?php if(!empty($_REQUEST['lot-step'])){ echo $_REQUEST['lot-step']; } ?>" placeholder="0" >
        <span class="form__error">Введите шаг ставки</span>
      </div>
      <div class="form__item <?=$classname;?>">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?php if(!empty($_REQUEST['lot-date'])){ echo $_REQUEST['lot-date']; } ?>" >
        <span class="form__error">Введите дату завершения торгов</span>
      </div>
    </div>
    <?php if (isset($errors)): ?>
      <div class="form__errors">
        <p>Пожалуйста, исправьте следующие ошибки:</p>
        <ul>
          <?php foreach($errors as $err => $val): ?>
          <li><strong><?=$dict[$err];?>:</strong> <?=$val;?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <!--<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>-->
    <button type="submit" class="button">Добавить лот</button>
  </form>
</main>
