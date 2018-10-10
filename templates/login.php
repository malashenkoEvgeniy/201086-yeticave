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
  <form class="form container <?= $classname = !empty($errors) ? "form--invalid" : "";  ?>"  action="login.php" method="post"> <!-- form--invalid -->
   <?php $classname = !empty($errors['email']) ? "form__item--invalid" : "";  ?>
    <h2>Вход</h2>
    <div class="form__item <?=$classname;?>"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" value="<?php if(!empty($_REQUEST['email'])){ echo $_REQUEST['email']; } ?>" placeholder="Введите e-mail">
      <span class="form__error">Введите e-mail</span>
    </div>
    <div class="form__item form__item--last <?= $classname = !empty($errors['email']) ? "form__item--invalid" : "";  ?>">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль" >
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
      <!--<span class="form__error">Введите пароль</span>-->
    </div>
    <button type="submit" class="button">Войти</button>
  </form>
</main>
