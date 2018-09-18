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
  $result = '';
  if (!file_exists($name)) {
    return $result;
  }
  ob_start();
  extract($data);
  require_once $name;
  $result = ob_get_clean();
  return $result;
}
