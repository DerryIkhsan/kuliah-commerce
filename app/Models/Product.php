<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    //
    protected $fillable = ['name', 'price', 'description', 'image_url'];

    public function reviews(){
        return $this->hasMany('App\Models\ProductReview', 'product_id', 'id')->select(['user_id', 'product_id', 'description as review']);
    }

    public function orderProducts($order_by){
        $query = "SELECT * FROM products ORDER BY created_at DESC";

        if($order_by == 'best_seller'){
            $query = "SELECT p.*, oi.quantity FROM products AS p
                LEFT JOIN(
                    SELECT product_id, SUM(quantity) AS quantity 
                    FROM order_items
                    GROUP BY product_id
                ) AS oi ON oi.product_id = p.id
                ORDER BY oi.quantity DESC";
        }
        elseif($order_by == 'terbaik'){
            $query = "SELECT *, IFNULL(rating_reviews, 0) AS rating
            FROM products p
            LEFT JOIN (
                SELECT product_id, IFNULL(ROUND(AVG(rating), 1), 0) as rating_reviews
                FROM product_reviews
                GROUP BY product_id
            ) AS pr ON pr.product_id = p.id
            ORDER BY rating DESC";
        }
        elseif($order_by == 'termurah'){
            $query = "SELECT * FROM products ORDER BY price ASC";
        }
        elseif($order_by == 'termahal'){
            $query = "SELECT * FROM products ORDER BY price DESC";
        }
        elseif($order_by == 'terbaru'){
            $query = "SELECT * FROM products ORDER BY created_at DESC";
        }

        return DB::select($query);
    }

    public function orderProductsAdmin($order_by, $uid){
        $query = "SELECT * FROM products WHERE products.user_id = '$uid' ORDER BY created_at DESC";

        if($order_by == 'best_seller'){
            $query = "SELECT p.*, oi.quantity 
            FROM products AS p
                LEFT JOIN(
                    SELECT product_id, SUM(quantity) AS quantity 
                    FROM order_items
                    GROUP BY product_id
                ) AS oi ON oi.product_id = p.id
                WHERE p.user_id = '$uid'
                ORDER BY oi.quantity DESC";
        }
        elseif($order_by == 'terbaik'){
            $query = "SELECT *, IFNULL(rating_reviews, 0) AS rating
            FROM products AS p
            LEFT JOIN (
                SELECT product_id, IFNULL(ROUND(AVG(rating), 1), 0) as rating_reviews
                FROM product_reviews
                GROUP BY product_id
            ) AS pr ON pr.product_id = p.id
            WHERE p.user_id = '$uid'
            ORDER BY rating DESC";
        }
        elseif($order_by == 'termurah'){
            $query = "SELECT * FROM products WHERE products.user_id = '$uid' ORDER BY price ASC";
        }
        elseif($order_by == 'termahal'){
            $query = "SELECT * FROM products WHERE products.user_id = '$uid' ORDER BY price DESC";
        }
        elseif($order_by == 'terbaru'){
            $query = "SELECT * FROM products WHERE products.user_id = '$uid' ORDER BY created_at DESC";
        }

        return DB::select($query);
    }
}
