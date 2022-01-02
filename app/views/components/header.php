<link rel="stylesheet" type="text/css" href="styles/navigation.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<header class="header">
<nav class="mainnavigation">
<input type="checkbox" id="menu-toggle"/>
  <label id="trigger" for="menu-toggle"></label>
  <label id="burger" for="menu-toggle"></label>
  <ul id="menu">
    <li>
      <a href="/">
        <div class="customitem item1">
          <b><p class="navp">Home</p></b>
        </div>
      </a>
    </li>
    <li>
      <a href="/product">
        <div class="customitem item2">
          <b><p class="navp">Products</p></b>
        </div>
      </a>
    </li>
    <li>
      <a href="/login">
        <div class="customitem item3">
          <?php      
              if (isset($_SESSION['user'])) {
                echo "<b><p class='navp'>My account</p></b>";
              } else {
                echo "<b><p class='navp'>Login/Register</p></b>";
              }
          ?>
        </div>
      </a>
    </li>
  </ul>
  <ul id="menuright">
    <li>
      <a href="/login">
        <i class="fas fa-user fa-lg"></i>
      </a>
    </li>
    <li>
      <a href="/shoppingcart">
        <i class="fas fa-shopping-cart fa-lg"></i>
        <?php      
            if (isset($_SESSION['shoppingcart'])) {
              $shoppingCart = unserialize($_SESSION['shoppingcart']);
              echo count($shoppingCart->getCartProducts());
            }
        ?>
      </a>
    </li>
  </ul>
</nav>
</header>
