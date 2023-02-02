<?php

function totalCart()
{
  $cart = session()->get('cart');
  $quantity = 0;
  if ($cart) {
    foreach ($cart as $key) {
      $quantity += $key['quantityProduct'];
    }
  }
  return $quantity;
}
function totalPriceAllCart()
{
  $cart = session()->get('cart');
  $total = 0;
  if ($cart) {
    foreach ($cart as $key) {
      $total += $key['quantityProduct'] * (float)$key['priceProduct'];
    }
  }
  return  $total;
}