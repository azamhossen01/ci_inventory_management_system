<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<?php if($this->session->flashdata('success')){ ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
<?php } ?>
<?php if($this->session->flashdata('error')){ ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
<?php } ?>