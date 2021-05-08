<?php 
$title = "Dashboard Products";
$dir = dirname(__DIR__, 1 );
include($dir.'/head.php'); 
?>

<body>
    <!------------ Nav -------------->
    <?php include('admin_nav.php'); ?>
    <!------------ List of Products -------------->
    <div class="small-container cart-page">
        <div class="search-form">
            <form action="">
                <input type="text" class="search" placeholder="Search Product">
                <input type="submit" class="btn" value="Search"></input>
            </form>
        </div>
        <div class="row row-2">
            <h2>Products</h2>
            <!---------- jQuery Model Trigger ---------->
            <a href="#ex1" rel="modal:open" class="btn">Add new product</a>
        </div>
        <table>
            <tr>
                <th>Picture</th>
                <th>ID</th>
                <th>Name</th>
                <th>Inventory Count</th>
                <th>Quantity Sold</th>
                <th>Action</th>
            </tr>
            <tr class="order-list">
                <td><img src="https://storage.cloud.google.com/ecommerce-capstone/images/product-11.jpg" alt=""></td>
                <td>1</td>
                <td>Shoe</td>
                <td>123</td>
                <td>100</td>
                <td class="btn-action">
                    <a href="#ex2" rel="modal:open" class="btn">Edit</a>
                    <a href="#ex3" rel="modal:open" class="btn">Delete</a>
                </td>
            </tr>
            <tr class="order-list">
                <td><img src="https://storage.cloud.google.com/ecommerce-capstone/images/product-11.jpg" alt=""></td>
                <td>1</td>
                <td>Shoe</td>
                <td>123</td>
                <td>100</td>
                <td class="btn-action">
                    <a href="#ex2" rel="modal:open" class="btn">Edit</a>
                    <a href="#ex3" rel="modal:open" class="btn">Delete</a>
                </td>
            </tr>
            <tr class="order-list">
                <td><img src="https://storage.cloud.google.com/ecommerce-capstone/images/product-11.jpg" alt=""></td>
                <td>1</td>
                <td>Shoe</td>
                <td>123</td>
                <td>100</td>
                <td class="btn-action">
                    <a href="#ex2" rel="modal:open" class="btn">Edit</a>
                    <a href="#ex3" rel="modal:open" class="btn">Delete</a>
                </td>
            </tr>
        </table>
        <div class="page-btn pagination">
            <span>1</span>
            <span>2</span>
            <span>3</span>
            <span>4</span>
            <span>&#8594;</span>
        </div>
    </div>
    <!---------- Modal Add Content ---------->
    <div id="ex1" class="modal">
        <h2>Add a new product</h2>
        <form action="" class="add-product">
            <div class="table-row">
                <label for="name">Name</label>
                <input type="text" id="name">
            </div>
            <div class="table-row">
                <label for="description">Description</label>
                <textarea type="text" name="description" id="description"></textarea>
            </div>
            <div class="table-row">
                <label for="category">Categories</label>
                <details>
                    <summary class="category-list">
                        Categories<i class="fas fa-sort-down"></i>
                    </summary>
                    <div class="dropdown-wrapper">
                        <ul>
                            <li class="hover-tools">
                                <input type="text" name="category" value="Earbuds" class="category-input" readonly>
                                <i class="fas fa-pencil-alt edit"></i>
                                <i class="fas fa-trash delete"></i>
                            </li>
                            <li class="hover-tools">
                                <input type="text" name="category" value="Earbuds" class="category-input" readonly>
                                <i class="fas fa-pencil-alt edit"></i>
                                <i class="fas fa-trash delete"></i>
                            </li>
                            <li class="hover-tools">
                                <input type="text" name="category" value="Earbuds" class="category-input" readonly>
                                <i class="fas fa-pencil-alt edit"></i>
                                <i class="fas fa-trash delete"></i>
                            </li>
                            <li class="hover-tools">
                                <input type="text" name="category" value="Earbuds" class="category-input" readonly>
                                <i class="fas fa-pencil-alt edit"></i>
                                <i class="fas fa-trash delete"></i>
                            </li>
                        </ul>
                    </div>
                </details>
            </div>
            <div class="table-row">
                <label for="add-category">Add new category</label>
                <input type="text" id="add-category">
            </div>
        </form>
        <form action="" class="sortable-pictures">
            <div class="table-row">
                <label for="images">Images</label>
                <input type="submit" class="btn" id="images" value="Upload">
            </div>
            <div class="table-row">
                <ul class="sortable">
                    <li class="ui-state-default">
                        <span><i class="fas fa-grip-horizontal"></i></span>
                        <img src="https://storage.cloud.google.com/ecommerce-capstone/images/product-1-1.jpg" class="gallery small-img">
                        <span>product-1-1.jpg</span>
                        <label for="main">Main</label>
                        <input type="checkbox" name="main">
                        <i class="fas fa-trash delete-img"></i>
                    </li>
                    <li class="ui-state-default">
                        <span><i class="fas fa-grip-horizontal"></i></span>
                        <img src="https://storage.cloud.google.com/ecommerce-capstone/images/product-1-4.jpg" class="gallery small-img">
                        <span>product-1-4.jpg</span>
                        <label for="main">Main</label>
                        <input type="checkbox" name="main">
                        <i class="fas fa-trash delete-img"></i>
                    </li>
                    <li class="ui-state-default">
                        <span><i class="fas fa-grip-horizontal"></i></span>
                        <img src="https://storage.cloud.google.com/ecommerce-capstone/images/product-1-3.jpg" class="gallery small-img">
                        <span>product-1-3.jpg</span>
                        <label for="main">Main</label>
                        <input type="checkbox" name="main">
                        <i class="fas fa-trash delete-img"></i>
                    </li>
                    <li class="ui-state-default">
                        <span><i class="fas fa-grip-horizontal"></i></span>
                        <img src="https://storage.cloud.google.com/ecommerce-capstone/images/product-1-2.jpg" class="gallery small-img">
                        <span>product-1-2.jpg</span>
                        <label for="main">Main</label>
                        <input type="checkbox" name="main">
                        <i class="fas fa-trash delete-img"></i>
                    </li>
                </ul>
            </div>
            <div class="image-selections">
                <input type="submit" id="cancel" class="btn add-product-btn" value="Cancel">
                <input type="submit" id="preview" class="btn add-product-btn" value="Preview">
                <input type="submit" id="Update" class="btn add-product-btn" value="Update">
            </div>
        </form>
        <a href="#" id="close-modal" rel="modal:close">Close</a>
    </div>
    <!---------- Modal Edit Content ---------->
    <div id="ex2" class="modal">
        <h2>Edit product</h2>
        <form action="" class="add-product">
            <div class="table-row">
                <label for="name">Name</label>
                <input type="text" id="name">
            </div>
            <div class="table-row">
                <label for="description">Description</label>
                <textarea type="text" name="description" id="description"></textarea>
            </div>
            <div class="table-row">
                <label for="category">Categories</label>
                <details>
                    <summary class="category-list">
                        Categories<i class="fas fa-sort-down"></i>
                    </summary>
                    <div class="dropdown-wrapper">
                        <ul>
                            <li class="hover-tools">
                                <input type="text" name="category" value="Earbuds" class="category-input" readonly>
                                <i class="fas fa-pencil-alt edit"></i>
                                <i class="fas fa-trash delete"></i>
                            </li>
                            <li class="hover-tools">
                                <input type="text" name="category" value="Earbuds" class="category-input" readonly>
                                <i class="fas fa-pencil-alt edit"></i>
                                <i class="fas fa-trash delete"></i>
                            </li>
                            <li class="hover-tools">
                                <input type="text" name="category" value="Earbuds" class="category-input" readonly>
                                <i class="fas fa-pencil-alt edit"></i>
                                <i class="fas fa-trash delete"></i>
                            </li>
                            <li class="hover-tools">
                                <input type="text" name="category" value="Earbuds" class="category-input" readonly>
                                <i class="fas fa-pencil-alt edit"></i>
                                <i class="fas fa-trash delete"></i>
                            </li>
                        </ul>
                    </div>
                </details>
            </div>
            <div class="table-row">
                <label for="add-category">Add new category</label>
                <input type="text" id="add-category">
            </div>
        </form>
        <form action="" class="sortable-pictures">
            <div class="table-row">
                <label for="images">Images</label>
                <input type="submit" class="btn" id="images" value="Upload">
            </div>
            <div class="table-row">
                <ul class="sortable">
                    <li class="ui-state-default">
                        <span><i class="fas fa-grip-horizontal"></i></span>
                        <img src="https://storage.cloud.google.com/ecommerce-capstone/images/product-1-1.jpg" class="gallery small-img">
                        <span>product-1-1.jpg</span>
                        <label for="main">Main</label>
                        <input type="checkbox" name="main">
                        <i class="fas fa-trash delete-img"></i>
                    </li>
                    <li class="ui-state-default">
                        <span><i class="fas fa-grip-horizontal"></i></span>
                        <img src="https://storage.cloud.google.com/ecommerce-capstone/images/product-1-4.jpg" class="gallery small-img">
                        <span>product-1-4.jpg</span>
                        <label for="main">Main</label>
                        <input type="checkbox" name="main">
                        <i class="fas fa-trash delete-img"></i>
                    </li>
                    <li class="ui-state-default">
                        <span><i class="fas fa-grip-horizontal"></i></span>
                        <img src="https://storage.cloud.google.com/ecommerce-capstone/images/product-1-3.jpg" class="gallery small-img">
                        <span>product-1-3.jpg</span>
                        <label for="main">Main</label>
                        <input type="checkbox" name="main">
                        <i class="fas fa-trash delete-img"></i>
                    </li>
                    <li class="ui-state-default">
                        <span><i class="fas fa-grip-horizontal"></i></span>
                        <img src="https://storage.cloud.google.com/ecommerce-capstone/images/product-1-2.jpg" class="gallery small-img">
                        <span>product-1-2.jpg</span>
                        <label for="main">Main</label>
                        <input type="checkbox" name="main">
                        <i class="fas fa-trash delete-img"></i>
                    </li>
                </ul>
            </div>
            <div class="image-selections">
                <input type="submit" id="cancel" class="btn add-product-btn" value="Cancel">
                <input type="submit" id="preview" class="btn add-product-btn" value="Preview">
                <input type="submit" id="Update" class="btn add-product-btn" value="Update">
            </div>
        </form>
        <a href="#" id="close-modal" rel="modal:close">Close</a>
    </div>
    <!---------- Modal Delete Content ---------->
    <div id="ex3" class="modal">
        <h2>Are you sure you want to delete this product?</h2>
        <form action="" class="add-product">
            <div class="table-row">
                <input type="submit" id="yes" class="btn add-product-btn" value="Yes">
                <input type="submit" id="cancel" class="btn add-product-btn" value="Cancel">
            </div>
        </form>
    </div>
    <!---------- JS for toggle menu ---------->
    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px"
        function menuToggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px"
            }
            else {
                MenuItems.style.maxHeight = "0px"
            }
        }
    </script>
    <script>
        $('.edit').click(function () {
            $('.category-input').css('background-color', '#ccc');
            $('.category-input').attr("readonly", false);
        });
        $('.category-input').mouseleave(function () {
            $('.category-input').css('background-color', '#fff');
            $('.category-input').attr("readonly", true);
        });
        $(function () {
            $(".sortable").sortable();
            $(".sortable").disableSelection();
        });
    </script>
</body>

</html>