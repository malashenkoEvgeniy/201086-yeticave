
  <main>
    <nav class="nav">
      <ul class="nav__list container">
        <?php foreach($categories as $category_name): ?>
        <li class="promo__item promo__item--<?= $category_name['alias']?>">
          <a class="promo__link" href="category.php?alias=<?= $category_name['alias']?>"><?= $category_name['title']; ?></a>
        </li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <div class="container">
      <section class="lots">
        <h2>Результаты поиска по запросу «<span><?= $_GET['q']; ?></span>»</h2>
        <ul class="lots__list">
         <?php foreach($goods as $good):?>
          <li class="lots__item lot">
            <div class="lot__image">
              <img src="<?= $config['image_path'] . $good['image']; ?>" width="350" height="260" alt="<?= $good['name']; ?>">
            </div>
            <div class="lot__info">
              <span class="lot__category"><?= get_category_name_byid($categories, $good['category_id']); ?></span>
              <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?= $good['id']; ?>"><?= $good['name_lot']; ?></a></h3>
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
      <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
      </ul>
    </div>
  </main>
