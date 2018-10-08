 <main class="container">
  <section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
      <?php foreach($categories as $category_name): ?>
        <li class="promo__item promo__item--boards">
          <a class="promo__link" href="category.php?alias=<?= $category_name['alias']?>"><?= $category_name['title']; ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
   <section class="lots">
    <div class="lots__header">
      <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
      <?php foreach($goods as $good):?>
        <li class="lots__item lot">
          <div class="lot__image">
            <img src="<?= $config['image_path'] . $good['image']; ?>" width="350" height="260" alt="<?= $good['name']; ?>">
          </div>
          <div class="lot__info">
            <span class="lot__category"><?= get_category_name_byid($categories, $good['category_id']); ?></span>
            <h3 class="lot__title">
              <a class="text-link" href="lot.php?id=<?= $good['id']; ?>"><?= $good['name_lot']; ?></a>
            </h3>
            <div class="lot__state">
              <div class="lot__rate">
                <span class="lot__amount">Стартовая цена</span>
                <span class="lot__cost"><?= format_sum($good['pricestart']); ?><b class="rub">р</b></span>
              </div>
              <div class="lot__timer timer">
                <?= get_time_overlot (); ?>
              </div>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
</main>
