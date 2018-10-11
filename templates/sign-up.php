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
  <form class="form container <?= $classname = !empty($errors) ? "form--invalid" : "";  ?>" enctype="multipart/form-data" action="sign-up.php" method="post"> <!-- form--invalid -->
   <?php $classname = !empty($errors['email']) ? "form__item--invalid" : "";  ?>
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item <?=$classname;?>"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" value="<?php if(!empty($_REQUEST['email'])){ echo $_REQUEST['email']; } ?>" placeholder="Введите e-mail" >
      <span class="form__error">Введите e-mail</span>
    </div>
    <?php $classname = !empty($errors['password']) ? "form__item--invalid" : "";  ?>
    <div class="form__item <?=$classname;?>">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" value="<?php if(!empty($_REQUEST['password'])){ echo $_REQUEST['password']; } ?>" placeholder="Введите пароль" >
      <span class="form__error">Введите пароль</span>
    </div>
    <?php $classname = !empty($errors['name_user']) ? "form__item--invalid" : "";  ?>
    <div class="form__item <?=$classname;?>">
      <label for="name">Имя*</label>
      <input id="name" type="text" name="name_user" value="<?php if(!empty($_REQUEST['name_user'])){ echo $_REQUEST['name_user']; } ?>" placeholder="Введите имя" >
      <span class="form__error">Введите имя</span>
    </div>
    <?php $classname = !empty($errors['contact_details']) ? "form__item--invalid" : "";  ?>
    <div class="form__item <?=$classname;?>">
      <label for="message">Контактные данные*</label>
      <textarea id="message" name="contact_details" placeholder="Напишите как с вами связаться"><?php if(!empty($_REQUEST['contact_details'])){ echo $_REQUEST['contact_details']; } ?></textarea>
      <span class="form__error">Напишите как с вами связаться</span>
    </div>
    <div class="form__item form__item--file form__item--last <?=$classname;?>">
      <label>Аватар</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="avatar"  id="photo2" value="<?php if(!empty($_FILES['avatar'])){ echo $_FILES['avatar']; } ?>">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
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
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="#">Уже есть аккаунт</a>

  </form>
</main>
