<?php

class ProductModel{
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_patitasfelices_tienda;charset=utf8','root','');
    }

    function getAllProducts($sort = null, $order = null, $limit = null, $offset = null, $attribute = null, $value = null){
        $sql = 'SELECT id_product, name, description, category_name, type_name, color, size, price, stock, image, badge, on_sale FROM product JOIN category ON product.category_fk = category.id_category JOIN type ON product.type_fk = type.id_type';
        if($sort != null){
            $sql .= ' ORDER BY ' . $sort;
            if($order != null){
                $sql .= ' ' . $order;
            }
        }
        if($limit != null){
            $sql .= ' LIMIT ' . $limit;
        }
        if($offset != null){
            $sql .= ' OFFSET ' . $offset;
        }
        if($attribute && $value){
            $sql .= " WHERE " .$attribute." = '$value'";
        }
        echo $sql;
        $query = $this->db->prepare($sql);
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    function getProduct($id){
        $query = $this->db->prepare('SELECT id_product, name, description, category_name, type_name, color, size, price, stock, image, badge, on_sale FROM product, category, type WHERE product.id_product=? AND (category_fk= id_category AND type_fk=id_type)');
        $query->execute([$id]);
        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product;
    }

    function addProduct($name, $description, $color, $size, $price, $stock, $category_fk, $type_fk, $badge, $on_sale, $image = null){
        $pathImg = null;

        if($image){
            $pathImg = $this->uploadImage($image);
        }

        $query = $this->db->prepare('INSERT INTO product(name, description, color, size, price, stock, category_fk, type_fk, image, badge, on_sale) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $query->execute([$name, $description, $color, $size, $price, $stock, $category_fk, $type_fk, $pathImg, $badge, $on_sale]);

        return $this->db->lastInsertId();
    }

    private function uploadImage($image){
        $target = 'img/products/' . uniqid("",true) . '.' . strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        move_uploaded_file($image, $target);
        return $target;
    }

    function editProduct($id, $name, $description, $color, $size, $price, $stock, $category_fk, $type_fk, $badge, $on_sale, $image = null){
        $pathImg = null;
        if($image){
            $pathImg = $this->uploadImage($image);
            $query = $this->db->prepare('UPDATE product SET name = ?, description = ?, color = ?, size = ?, price = ?, stock = ?, category_fk = ?, type_fk = ?, image = ?, badge = ?, on_sale = ? WHERE product.id_product = ?');
            $query->execute([$name, $description, $color, $size, $price, $stock, $category_fk, $type_fk, $pathImg, $badge, $on_sale, $id]);
        }
        else{
            $query = $this->db->prepare('UPDATE product SET name = ?, description = ?, color = ?, size = ?, price = ?, stock = ?, category_fk = ?, type_fk = ?, badge = ?, on_sale = ? WHERE product.id_product = ?');
            $query->execute([$name, $description, $color, $size, $price, $stock, $category_fk, $type_fk, $badge, $on_sale, $id]);
        }
    }

    function deleteProduct($id){
        $query = $this->db->prepare('DELETE FROM `product` WHERE `product`.`id_product` = ?');
        $query->execute([$id]);
    }

    function getProductByCategory($id_category){
        $query = $this->db->prepare('SELECT id_product, name, description, category_name, type_name, color, size, price, stock, image, badge, on_sale FROM product, category, type WHERE (category_fk= id_category AND type_fk=id_type) AND (category_fk=?)');
        $query->execute([$id_category]);
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }
    function getProductByType($id_type){
        $query = $this->db->prepare('SELECT id_product, name, description, category_name, type_name, color, size, price, stock, image, badge, on_sale FROM product, category, type WHERE (category_fk= id_category AND type_fk=id_type) AND (type_fk=?)');
        $query->execute([$id_type]);
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }
}