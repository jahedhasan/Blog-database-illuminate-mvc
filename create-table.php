<?php
/*
Post.php
posts 
  title 
  content 
  user_id
  category_id
User.php
users 
  name 
  email
  password
Category.php
categories 
  name
Comment.php
comments
  name 
  email
  text 
  post_id
*/
require 'vendor/autoload.php';
use Illuminate\Database\Capsule\Manager;
Manager::schema()->dropIfExists('comments');
Manager::schema()->dropIfExists('posts');
Manager::schema()->dropIfExists('categories');
Manager::schema()->dropIfExists('users');
Manager::schema()->create('users', function ($t) {
  $t->increments('id');
  $t->string('name');
  $t->string('image')->nullable();
  $t->string('email')->unique();
  $t->string('password');
  $t->timestamps();
});
Manager::schema()->create('categories', function ($t) {
  $t->increments('id');
  $t->string('name');
  $t->timestamps();
});
Manager::schema()->create('posts', function ($t) {
  $t->increments('id');
  $t->string('title');
  $t->text('content');
  $t->integer('user_id')->unsigned();
  $t->integer('category_id')->unsigned();
  $t->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
  $t->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
  $t->timestamps();
});
Manager::schema()->create('comments', function ($t) {
  $t->increments('id');
  $t->string('name');
  $t->string('email');
  $t->text('text');
  $t->integer('post_id')->unsigned();
  $t->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
  $t->timestamps();
});
