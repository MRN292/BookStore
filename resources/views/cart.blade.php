@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
  <head>
    <title>Cart Page</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="cart-container">
      <h1>My Cart</h1>
      <table>
        <thead>
          <tr>
            <th>Book Name</th>
            <th>Author</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>The Alchemist</td>
            <td>Paulo Coelho</td>
            <td>$10.99</td>
            <td>1</td>
            <td>$10.99</td>
          </tr>
          <tr>
            <td>The Great Gatsby</td>
            <td>F. Scott Fitzgerald</td>
            <td>$8.99</td>
            <td>2</td>
            <td>$17.98</td>
          </tr>
          <tr>
            <td colspan="4" class="text-right">Total</td>
            <td>$28.97</td>
          </tr>
        </tbody>
      </table>
      <div class="cart-buttons">
        <button>Continue Shopping</button>
        <button>Checkout</button>
      </div>
    </div>
  </body>
</html>

@endsection
