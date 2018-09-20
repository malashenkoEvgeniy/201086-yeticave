<?php
/**
 * Форматирует цену лота
 * @param {int} $number исходная цена
 * @return {int|string} форматированую цену
 */
function format_sum ($number) {
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