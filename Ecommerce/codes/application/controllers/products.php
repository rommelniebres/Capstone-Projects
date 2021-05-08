<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	/*  DOCU: This loads the view file of the products page
		and also initially displat all products and categories
        Owner: Rommel
    */
    public function index()
	{
        $products['products'] = $this->product->display_all_products();
		$products['categories'] = $this->product->display_all_categories();
		$this->load->view('products/products.php', $products);
	}
	/*  DOCU: This loads the view file of a single product and also the similar products
        Owner: Rommel
    */
	public function product($id)
	{
		$products['products'] = $this->product->search_by_id($id);
		$products['url'] = $this->product->url_by_id($id);
		$products['similars'] = $this->product->search_by_category($products['products'][0]['category_id']);
		$this->load->view('products/product_details.php', $products);
	}
	/*  DOCU: This search the product based on the name that the use inputs
        Owner: Rommel
    */
	public function search()
	{
		$data = $this->input->post('search');
		$products['products'] = $this->product->search_products($data);
		$products['categories'] = $this->product->display_all_categories();
		$this->load->view('products/products.php', $products);
	}
	/*  DOCU: This search the product based on the same category of the current
		displayed product
        Owner: Rommel
    */
	public function category($id)
	{
		$products['products'] = $this->product->search_by_category($id);
		$products['categories'] = $this->product->display_all_categories();
		$this->load->view('products/products.php', $products);
	}
}	