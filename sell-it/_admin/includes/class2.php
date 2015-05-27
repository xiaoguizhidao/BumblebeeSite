<?php
session_start();
if(!isset($_SESSION['currency'])) {
$_SESSION['currency']=1;
}

function formatPrice($price,$cur) {
	$qr = "select * from currency where cur_id = ".$cur;
	$rd = mysql_query($qr);
	$cd = mysql_fetch_array($rd);
	$amt = $price * $cd['cur_rate'];
	return $cd['cur_sign'].$amt;
}

class cms {
	public $heading,$content,$pageimg,$pageid;
	function __construct($id) {
		self::setId($id);
		self::cmsData();
	}
	function cmsData() {
		$q = mysql_query("select * from pages where id='".$this->pageid."'");
		$pagedata = mysql_fetch_object($q);
		$this->heading = $pagedata->heading;
		$this->content = $pagedata->description;
		$this->pageimg = "page_image/".$pagedata->page_image;
	}
	function setId($id) {
		$this->pageid=$id;
	}
}


	
class catalog {
	public $categoryid, $categoryName, $productId,$categoryDescription,$categoryBanner;
	
	function __construct() {
		if($this->categoryid==NULL) {
			$qry = mysql_query("select category_id from categories order by sort asc limit 1");
			$r = mysql_fetch_array($qry);
			$this->categoryid = $r['category_id'];
			self::getCategoryDetail();
		}
		
	}
	
	function setCategoryId($category_id) {
		$this->categoryid=$category_id;
		self::getCategoryDetail();
	}
	
	function categoryExist() {
		$query = "select category from categories where category_id = ".$this->categoryid;
		$result = mysql_query($query);
		if(mysql_num_rows($result)>0) {
			return true;
		} else { 
			return false;
		}
	}
	
	function getCategoryDetail() {
		$query = "select * from categories where category_id = ".$this->categoryid;
		$result = mysql_query($query);
		$categoryData = mysql_fetch_array($result);
		$this->categoryName = $categoryData['category'];
		$this->categoryDescription =$categoryData['des'];
		$this->categoryBanner = "categories/left/".$categoryData['cat_left_image'];
	}
	
	function getCategoriesbyLimit($offSet,$limit) {
		$qry = "select category_id as id, cat_image as thumbnail, category as name from categories where parent = 0 order by sort asc limit $offSet, $limit";
		$result = mysql_query($qry);
		while($results = mysql_fetch_array($result)) {
			$categories[] = $results;
		}
		return $categories;
	}
	
	function getCategoryName($categoryid) {
		$query = "select category from categories where category_id = ".$categoryid;
		$result = mysql_query($query);
		$data = mysql_fetch_array($result);
		return $data['category'];
	}
	
	function getProducts() {
		$query = "select * from products where category_id = ".$this->categoryid;
		$result = mysql_query($query);
		while($prds = mysql_fetch_object($result)) {
			$products[] = $prds;
		}
		return $products;
	}
	
	function hasProducts() {
		$query = "select p_id from products where category_id = ".$this->categoryid." limit 1";
		$result = mysql_query($query);
		if(mysql_num_rows($result)>0) {
			return true;
		} else {
			return false;
		}
	}
	
	function showCategories() {
		$query = "select * from categories where parent = 0 order by sort asc";
		$result = mysql_query($query);
		while ($cats = mysql_fetch_object($result)) {
			$category[] = $cats;
		}
		return $category;
	}
	

	function setProductId($productId) {
		$this->productId = $productId;
	}
	
	function getProductData($product_id) {
		$qry = "select * from products where p_id=".$product_id;
		$result = mysql_query($qry);
		$data = mysql_fetch_object($result);
		return $data;
	}
	
	function hasSubCategories($categoryid) {
		$query = mysql_query("select category_id from categories where parent = $categoryid limit 1");
		if(mysql_num_rows($query)>0) {
			return true;
		} else {
			return false;
		}
	}
	
	function getSubCategories($categoryid) {
		$qry = "select category as name, cat_image as thumb,category_id as id from categories where parent = ".$categoryid." order by sort asc";
		$result = mysql_query($qry);
		while($results = mysql_fetch_array($result)) {
			$categories[] = $results;
		}
		return $categories;
	}
	
	function getProductThumbs() {
		$query = "select color_image from add_colors where p_id = ".$this->productId;
		$result = mysql_query($query);
		if(mysql_num_rows($result)>0) {
			while($thumb = mysql_fetch_array($result)) {
				$mythumb[] = $thumb;
			}
			return $mythumb;
		} else {
			return false;
		}
	}

	
}

class news {
	function latestNews($numOfnews) {
		$qry = "select * from news order by news_date asc limit ".$numOfnews;
		$result = mysql_query($qry);
		while ($newsrow = mysql_fetch_array($result)) {
		$news[] = $newsrow;
	}
	return $news;
}

function getNews() {
		$qry = "select * from news order by news_date asc";
		$result = mysql_query($qry);
		while ($newsrow = mysql_fetch_object($result)) {
		$news[] = $newsrow;
	}
	return $news;
}
}

function getSlides() {
	$query = "select slide_image from slider order by sort asc";
	$result = mysql_query($query);
	if(mysql_num_rows($result)>0) {
		while($slides = mysql_fetch_array($result)) {
			$slid[] = "slider_images/".$slides['slide_image'];
		}
		return $slid;
	} else {
		return false;
	}
}


class cart {
	function checkCart($pid,$sid) {
		$query = "select * from basket where session_id = '".$sid."' and p_id =".$pid;
		$result = mysql_query($query);
		if(mysql_num_rows($result)>0) {
			return true;
		} else {
			return false;
		}
	}
	
	
	function addToBasket($pid,$sid,$qty) {
		$query = "insert into basket (session_id,quantity,p_id) values('".$sid."','".$qty."','".$pid."')";
		if(mysql_query($query)) {
			return true;
		} else {
			return false;
		}
	}
	
	function updateCart($pid,$sid,$qty) {
		$query = "select quantity from basket where session_id = '".$sid."' and p_id ='".$pid."'";
		$result = mysql_query($query);
		$result2 = mysql_fetch_array($result);
		$cur_qty = $result2['quantity'];
		$new_qty = $cur_qty + $qty;
		$queryUpdate = "update basket set quantity = '".$new_qty."' where session_id = '".$sid."' and p_id ='".$pid."'";
		if(mysql_query($queryUpdate)) {
			return true;
		} else {
			return false;
		}
	}
	
	function updateCartQty($pid,$sid,$qty) {
		$queryUpdate = "update basket set quantity = '".$qty."' where session_id = '".$sid."' and p_id ='".$pid."'";
		if(mysql_query($queryUpdate)) {
			return true;
		} else {
			return false;
		}
	}
	
	function getCartItems($session_id) {
		$query = "select * from basket where session_id = '".$session_id."'";
		$result = mysql_query($query);
		if(mysql_num_rows($result)>0) {
			while($items = mysql_fetch_array($result)) {
				$basket[] = $items;
			}
			return $basket;
		} else {
			return false;
		}
	}
	
	function removeFromCart($pid,$sid) {
		$query = "delete from basket where session_id = '".$sid."' and p_id ='".$pid."'";
		if(mysql_query($query)) {
			return true;
		} else {
			return false;
		}
	}
	
	function emptyCart($session_id) {
		$query = "delete from basket where session_id = '".$session_id."'";
		if(mysql_query($query)) {
			return true;
		} else {
			return false;
		}
	}
	
}
?>