<?php
namespace App\Repositories\Admin;

interface AdminInterface{
    public function signIn($data);
    public function logOut();
    public function searchProduct($data);
    public function totalsCustomer();
    public function totalsOrders();
    public function totalsMoney();
    public function totalsSaleProducts();
}
