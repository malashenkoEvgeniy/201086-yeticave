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
  <section class="lot-item container">
    <h2><?= $goods['name_lot']; ?></h2>
    <div class="lot-item__content">
      <div class="lot-item__left">
        <div class="lot-item__image">
          <img src="<?= $config['image_path'] . $goods['image']; ?>" width="730" height="548" alt="<?= $goods['name_lot']; ?>">
        </div>
        <p class="lot-item__category">Категория: <span><?= get_category_name_byid($categories, $goods['category_id']); ?></span></p>
        <p class="lot-item__description"><?= $goods['description']; ?></p>
      </div>
      <div class="lot-item__right">
       <?php if($is_auth): ?>
        <div class="lot-item__state">
          <div class="lot-item__timer timer">
            10:54:12
          </div>
          <div class="lot-item__cost-state">
            <div class="lot-item__rate">
              <span class="lot-item__amount">Текущая цена</span>
              <span class="lot-item__cost"><?= $goods['pricestart']; ?></span>
            </div>
            <div class="lot-item__min-cost">
              Мин. ставка <span><?= format_sum($goods['pricestart'] + $goods['step']); ?><b class="rub">р</b></span>
            </div>
          </div>
          <form class="lot-item__form <?= $classname = !empty($errors) ? "form--invalid" : "";  ?>" action="lot.php" method="POST">
            <p class="lot-item__form-item <?= $classname = !empty($errors['cost']) ? "form__item--invalid" : "";  ?>">
              <label for="cost">Ваша ставка</label>
              <input id="cost" type="number" name="cost" value="<?php if(!empty($_REQUEST['cost'])){ echo $_REQUEST['cost']; } ?>" placeholder="<?=($goods['pricestart'] + $goods['step']);?>">
            </p>
           <?php if (!empty($errors)): ?>
            <div class="form__errors">
              <p>Пожалуйста, исправьте следующие ошибки:</p>
              <ul>
                <?php foreach($errors as $err => $val): ?>
                <li><strong><?=$dict[$err];?>:</strong> <?=$val;?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
            <button type="submit" class="button">Сделать ставку</button>
          </form>
        </div>
        <?php endif; ?>
        <div class="history">
          <h3>История ставок (<span>10</span>)</h3>
          <table class="history__list">
           <?php foreach($bets as $bets_item): ?>
            <tr class="history__item">
              <td class="history__name"><?= $bets_item['user_id']; ?></td>
              <td class="history__price"><?= $bets_item['price']; ?></td>
              <td class="history__time"><?= $bets_item['ts']; ?></td>
            </tr>
            <? endforeach; ?>
          </table>
        </div>
      </div>
    </div>
  </section>
</main>
