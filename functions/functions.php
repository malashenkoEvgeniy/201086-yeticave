<?php
/**
 * Форматирует цену лота
 * @param {int} $number исходная цена
 * @return {int|string} форматированую цену
 */
function format_sum($number) {
  $sum = ceil($number);
  if ($sum < 1000) {
    return $sum;
  } else {
    return number_format($sum, 0, '.', ' ');
  }
}

/**
 * Функция шаблонизатор
 * @param {string} $name шаблон {string} $data данные для шаблона
 * @return {string} Итоговый HTML-код
 */
function include_template($name, $data) {
  $name = 'templates/' . $name;
  if (!is_readable($name)) {
    return '';
  }
  ob_start();
  extract($data);
  require_once $name;
  return ob_get_clean();
}

/**
 * Функция отсчета времени до конца действия лота
 * @param 'date'
 * @return {string} Время до конца лота
 */
function get_time_overlot($target_stamp = '23:59:59') {
  $target_time = strtotime($target_stamp) + 1;
  $rezult = ($target_time - time());
  $hour = ($rezult - $rezult % 3600) / 3600;
  $el = $rezult % 3600;
  $min = floor($el / 60);
  return $hour.' : '.$min;
}

/**
 * Функция принимает масив категорий и айди категории
 * @param {array}
 * @return {string} Название категории
 */
function get_category_name_byid($categories, $category_id) {
  foreach ($categories as $categories_item) {
    if ($categories_item['id'] == $category_id) {
      return $categories_item['title'];
    }
  }
}
/**
 * Функция принимает соеденение и запрос
 * @param {resourse}
 * @return {string} массив данных
 */
function get_array_in_base($link, $query) {
  $result = mysqli_query($link, $query) or die(mysqli_error($link));
  return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
